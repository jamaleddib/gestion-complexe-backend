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
    Schema::table('reservations', function (Blueprint $table) {
        $table->dropColumn(['date_debut', 'date_fin']);
        $table->date('date');
        $table->time('heure_debut');
        $table->time('heure_fin');
    });
    }

    public function down(): void
    {
    Schema::table('reservations', function (Blueprint $table) {
        $table->dropColumn(['date', 'heure_debut', 'heure_fin']);
        $table->date('date_debut');
        $table->date('date_fin');
    });
    }
};
