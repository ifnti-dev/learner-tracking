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
        Schema::create('seances', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');
            $table->string('description');
            $table->date('date');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->enum('type_seance', ['ENLIGNE', 'PRESENTIEL']);
            $table->foreignId('user_id')->constrained('users')->onDelete('set null');
            $table->foreignId('promotion_id')->constrained('promotions')->onDelete('set null');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seances');
    }
};
