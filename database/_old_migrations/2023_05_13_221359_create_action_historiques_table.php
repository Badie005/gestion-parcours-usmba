<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Renommé le fichier depuis 2025_05_13_221359 à 2023_05_13_221359
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('action_historiques', function (Blueprint $table) {
            $table->id('id_action');
            $table->foreignId('id_etudiant')->constrained('etudiant', 'id_etudiant')->onDelete('cascade');
            $table->string('type_action', 50);
            $table->string('description');
            $table->json('donnees_additionnelles')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_historiques');
    }
};
