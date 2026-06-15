<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'prenom' => 'Super',
            'email' => 'admin@complexe.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Client',
            'prenom' => 'Test',
            'email' => 'client@complexe.com',
            'password' => Hash::make('client123'),
            'role' => 'user',
        ]);
    }
}
