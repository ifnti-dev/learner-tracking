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
        Schema::create('apprenants', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("prenom");
            $table->string("telephone")->unique();
            $table->string("email")->unique();
            $table->enum('sexe',['M','F']);
            $table->string("adresse");
            $table->date("date_naissance");
            $table->string("etablissement");
            $table->string("niveau_de_base");
            $table->foreignId('promotion_id')->nullable()->constrained('promotions')->onDelete('set null');
            $table->foreignId('candidat_id')->nullable()->constrained('candidats')->onDelete('set null');
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apprenants');
    }
};
