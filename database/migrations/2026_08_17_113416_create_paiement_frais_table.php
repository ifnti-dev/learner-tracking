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
        Schema::create('paiement_frais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apprenant_niveau_id')->nullable()->constrained('apprenant_niveaux')->onDelete('set null');
            $table->boolean('prise_en_charge')->default(false);
            $table->decimal('montant')->default(0);
            $table->boolean('verse')->default(false);
            $table->string('piece_justificatif')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiement_frais');
    }
};
