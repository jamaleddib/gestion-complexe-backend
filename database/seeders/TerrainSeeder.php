<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Terrain;

class TerrainSeeder extends Seeder
{
    public function run(): void
    {
        Terrain::create(['nom' => 'Terrain Foot A', 'prix' => 200, 'type' => 'Football']);
        Terrain::create(['nom' => 'Terrain Foot B', 'prix' => 250, 'type' => 'Football']);
        Terrain::create(['nom' => 'Terrain Basket 1', 'prix' => 150, 'type' => 'Basketball']);
        Terrain::create(['nom' => 'Terrain Tennis 1', 'prix' => 100, 'type' => 'Tennis']);
    }
}
