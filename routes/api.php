<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TerrainController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TicketController;

// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes protégées (utilisateur connecté)
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Terrains - lecture pour tous les connectés
    Route::get('/terrains', [TerrainController::class, 'index']);

    // Réservations - utilisateur
    Route::get('/mes-reservations', [ReservationController::class, 'mesReservations']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::post('/reservations/{reservation}/payer', [ReservationController::class, 'payer']);
    Route::get('/reservations/{reservation}/ticket', [TicketController::class, 'telecharger']);

    // Routes Admin uniquement
    Route::middleware('admin')->group(function () {

        // Gestion terrains
        Route::post('/terrains', [TerrainController::class, 'store']);
        Route::put('/terrains/{terrain}', [TerrainController::class, 'update']);
        Route::delete('/terrains/{terrain}', [TerrainController::class, 'destroy']);

        // Gestion réservations
        Route::get('/reservations', [ReservationController::class, 'index']);
        Route::put('/reservations/{reservation}/statut', [ReservationController::class, 'updateStatut']);

        // Gestion clients
        Route::get('/clients', [ClientController::class, 'index']);
        Route::put('/clients/{user}', [ClientController::class, 'update']);
        Route::delete('/clients/{user}', [ClientController::class, 'destroy']);
    });
});
