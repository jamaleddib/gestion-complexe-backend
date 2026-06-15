<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketController extends Controller
{
    public function telecharger(Reservation $reservation, Request $request)
    {
        if ($reservation->id_client !== $request->user()->id) {
            return response()->json(['message' => 'Accès interdit'], 403);
        }

        if ($reservation->paiement !== 'paye') {
            return response()->json(['message' => 'Le ticket n\'est disponible qu\'après paiement.'], 422);
        }

        $reservation->load('terrain', 'client');

        $pdf = Pdf::loadView('ticket', compact('reservation'));

        return $pdf->download('ticket-reservation-' . $reservation->id . '.pdf');
    }
}
