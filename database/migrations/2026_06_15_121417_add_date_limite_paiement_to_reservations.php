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
        $table->timestamp('date_limite_paiement')->nullable();
        $table->enum('statut', ['en_attente', 'acceptee', 'refusee', 'expiree'])->default('en_attente')->change();
    });
    }

    public function down(): void
    {
    Schema::table('reservations', function (Blueprint $table) {
        $table->dropColumn('date_limite_paiement');
    });
    }


};
