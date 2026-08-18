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
        Schema::create('document_pedagogique_emprunt', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_pedagogique_id')->nullable()->constrained('document_pedagogiques')->onDelete('set null');
            $table->foreignId('emprunt_id')->nullable()->constrained('emprunts')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_pedagogique_emprunt');
    }
};
