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
        Schema::create('emprunts', function (Blueprint $table) {
            $table->id();
            $table->date('date_emprunt')->nullable()->default('now()');
            $table->date('date_restitution')->nullable();
            $table->date('date_restitution_prevue');
            $table->boolean('est_restitue')->default(false);
            $table->foreignId('apprenant_id')->nullable()->constrained('apprenants')->onDelete('set null');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprunts');
    }
};
