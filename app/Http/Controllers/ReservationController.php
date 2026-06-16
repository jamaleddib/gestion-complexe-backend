<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // USER : voir ses propres réservations
    public function mesReservations(Request $request)
    {
        $reservations = Reservation::with('terrain')
            ->where('id_client', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($reservations);
    }

    // USER : créer une réservation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_terrain' => 'required|exists:terrains,id',
            'date' => 'required|date|after_or_equal:today',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
        ]);

        $conflit = Reservation::where('id_terrain', $validated['id_terrain'])
            ->where('date', $validated['date'])
            ->where('statut', '!=', 'refusee')
            ->where(function ($query) use ($validated) {
                $query->where('heure_debut', '<', $validated['heure_fin'])
                      ->where('heure_fin', '>', $validated['heure_debut']);
            })
            ->exists();

        if ($conflit) {
            return response()->json([
                'message' => 'Ce terrain est déjà réservé sur ce créneau.',
            ], 422);
        }

        $reservation = Reservation::create([
            'id_client' => $request->user()->id,
            'id_terrain' => $validated['id_terrain'],
            'date' => $validated['date'],
            'heure_debut' => $validated['heure_debut'],
            'heure_fin' => $validated['heure_fin'],
        ]);

        return response()->json($reservation, 201);
    }

    // USER : payer une réservation acceptée
    public function payer(Reservation $reservation, Request $request)
{
    if ($reservation->id_client !== $request->user()->id) {
        return response()->json(['message' => 'Accès interdit'], 403);
    }

    if ($reservation->statut !== 'acceptee') {
        return response()->json([
            'message' => 'Cette réservation doit être acceptée avant le paiement.',
        ], 422);
    }

    if ($reservation->paiement === 'paye') {
        return response()->json(['message' => 'Cette réservation est déjà payée.'], 422);
    }

    if ($reservation->date_limite_paiement && now()->greaterThan($reservation->date_limite_paiement)) {
        $reservation->update(['statut' => 'expiree']);

        return response()->json([
            'message' => 'Le délai de paiement de 24h est dépassé. Réservation expirée.',
        ], 422);
    }

    $validated = $request->validate([
        'mode_paiement' => 'required|in:carte,especes',
    ]);

    $reservation->update([
        'paiement' => 'paye',
        'mode_paiement' => $validated['mode_paiement'],
    ]);

    return response()->json($reservation);
}

    // ADMIN : voir toutes les réservations
    public function index()
    {
        $reservations = Reservation::with(['terrain', 'client'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($reservations);
    }

    // ADMIN : accepter ou refuser une réservation
    public function updateStatut(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'statut' => 'required|in:acceptee,refusee',
        ]);

        if ($validated['statut'] === 'acceptee') {
            $validated['date_limite_paiement'] = now()->addDay();
        }

        $reservation->update($validated);

        return response()->json($reservation);
    }
}
