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
    Schema::create('terrains', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('photo')->nullable();
        $table->decimal('prix', 8, 2);
        $table->string('type')->nullable();
        $table->timestamps();
    });
    }

    public function down(): void
    {
    Schema::dropIfExists('terrains');
    }
};
