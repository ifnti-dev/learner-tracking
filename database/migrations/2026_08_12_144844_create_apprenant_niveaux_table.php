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
        Schema::create('apprenant_niveaux', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('apprenant_id')->constrained('apprenants')->onDelete('set null');
            $table->foreignId('niveau_id')->constrained('niveaux')->onDelete('set null');
            $table->foreignId('annee_id')->constrained('annees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apprenant_niveaux');
    }
};
