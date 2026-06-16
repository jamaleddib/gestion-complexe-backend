<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
    'id_client', 'id_terrain', 'date', 'heure_debut', 'heure_fin',
    'statut', 'paiement', 'date_limite_paiement', 'mode_paiement'];
    protected $casts = ['date_limite_paiement' => 'datetime',];
    public function client()
    {
        return $this->belongsTo(User::class, 'id_client');
    }

    public function terrain()
    {
        return $this->belongsTo(Terrain::class, 'id_terrain');
    }
}
