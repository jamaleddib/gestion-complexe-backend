<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terrain extends Model
{
    protected $fillable = ['nom', 'photo', 'prix', 'type'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_terrain');
    }
}
