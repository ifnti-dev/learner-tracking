<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\TypeNiveau;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bulletins', function (Blueprint $table) {
            $table->id();
            $table->string('bulletin1')->nullable();
            $table->string('bulletin2')->nullable();
            $table->string('bulletin3')->nullable();
            $table->string('releveCEPD')->nullable();
            $table->string('releveBEPC')->nullable();
            $table->string('releveBAC1')->nullable();
            $table->string('releveBAC2')->nullable();
            $table->enum('status',["complet","incomplet"])->default('complet');
            $table->string('type_niveau')->default(TypeNiveau::TRIMESTRIEL->value);
            $table->string('annee_scolaire');
            $table->json('data1')->nullable();
            $table->json('data2')->nullable();
            $table->json('data3')->nullable();
            $table->json('dataCEPD')->nullable();
            $table->json('dataBEPC')->nullable();
            $table->json('dataBAC1')->nullable();
            $table->json('dataBAC2')->nullable();

            $table->foreignId('niveau_id')->nullable()->constrained('niveaux')->onDelete('set null');
            $table->foreignId('apprenant_id')->nullable()->constrained('apprenants')->onDelete('set null');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulletins');
    }
};
