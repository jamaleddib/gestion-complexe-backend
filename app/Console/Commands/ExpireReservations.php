<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Illuminate\Console\Command;

class ExpireReservations extends Command
{
    protected $signature = 'reservations:expire';
    protected $description = 'Expire les réservations acceptées dont le délai de paiement (24h) est dépassé';

    public function handle()
    {
        $count = Reservation::where('statut', 'acceptee')
            ->where('paiement', 'non_paye')
            ->where('date_limite_paiement', '<', now())
            ->update(['statut' => 'expiree']);

        $this->info("{$count} réservation(s) expirée(s).");
    }
}
