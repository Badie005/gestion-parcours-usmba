"<?php

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
        Schema::create('resultats_academiques', function (Blueprint $table) {
            $table->id();
            $table->string('num_inscription');
            $table->enum('semestre', ['S1', 'S2', 'S3', 'S4']);
            $table->string('code_module', 10);
            $table->string('titre_module');
            $table->decimal('note', 4, 2)->nullable();
            $table->decimal('coefficient', 3, 2)->default(1.00);
            $table->enum('statut', ['validé', 'non_validé', 'rattrapage'])->nullable();
            $table->timestamps();
            
            $table->foreign('num_inscription')
                  ->references('num_inscription')
                  ->on('etudiants')
                  ->onDelete('cascade');
                  
            // Index pour optimiser les requêtes fréquentes
            $table->index(['num_inscription', 'semestre']);
            
            // Contrainte d'unicité pour éviter les doublons
            $table->unique(['num_inscription', 'semestre', 'code_module'], 'unique_resultat_academique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultats_academiques');
    }
};
