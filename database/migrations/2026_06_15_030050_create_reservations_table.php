<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_client')->constrained('users')->onDelete('cascade');
        $table->foreignId('id_terrain')->constrained('terrains')->onDelete('cascade');
        $table->date('date_debut');
        $table->date('date_fin');
        $table->enum('statut', ['en_attente', 'acceptee', 'refusee'])->default('en_attente');
        $table->enum('paiement', ['non_paye', 'paye'])->default('non_paye');
        $table->timestamps();
    });
    }

    public function down(): void
    {
    Schema::dropIfExists('reservations');
    }
};
