<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\TypeSeance;
use App\Enums\Etat;
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
            $table->string('type_seance')->default(TypeSeance::PRESENTIEL->value);
            $table->string('etat')->default(Etat::PLANIFIER);
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('promotion_id')->nullable()->constrained('promotions')->onDelete('set null');
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
