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
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->string('justification');
            $table-> boolean("est_justifie")->default(false);
            $table->foreignId('apprenant_id')->nullable()->constrained('apprenants')->onDelete('set null');
            $table->foreignId('seance_id')->nullable()->constrained('seances')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
