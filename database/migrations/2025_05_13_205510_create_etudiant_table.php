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
        Schema::create('etudiant', function (Blueprint $table) {
            $table->id('num_inscription');
            $table->string('nom_fr', 50);
            $table->string('prenom_fr', 50);
            $table->string('nom_ar', 50)->nullable();
            $table->string('prenom_ar', 50)->nullable();
            $table->string('email_academique', 100)->unique();
            $table->string('password');
            $table->string('date_naissance', 50)->nullable();
            $table->text('adresse')->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('code_deug', 50);
            $table->string('code_licence', 50)->nullable();
            $table->boolean('choix_confirme')->default(false);
            $table->timestamp('date_choix')->nullable();
            $table->string('annee', 50)->nullable();
            $table->string('aux', 50)->nullable();
            $table->integer('nb_val_ac_s1')->nullable();
            $table->integer('nb_val_ac_s2')->nullable();
            $table->integer('nb_val_ac_s3')->nullable();
            $table->integer('nb_val_ac_s4')->nullable();
            $table->boolean('fonctionnaire')->default(false);
            $table->boolean('impression_carte')->default(false);
            $table->char('duplicata_carte', 1)->nullable();
            $table->string('impression_deug', 50)->nullable();
            $table->string('la_poutre', 50)->nullable();
            $table->string('admission_deug', 50)->nullable();
            $table->string('exclu', 50)->nullable();
            $table->string('rd', 50)->nullable();
            $table->string('reinscription', 50)->nullable();
            $table->string('lieu_naissance_fr', 100)->nullable();
            $table->string('lieu_naissance_ar', 100)->nullable();
            $table->string('sexe', 10)->nullable();
            $table->string('pays_naissance', 50)->nullable();
            $table->string('nationalite', 50)->nullable();
            $table->string('serie_bac', 50)->nullable();
            $table->string('lieu_bac', 100)->nullable();
            $table->integer('annee_bac')->nullable();
            $table->string('lycee', 100)->nullable();
            $table->boolean('handicap')->default(false);
            $table->string('region', 50)->nullable();
            $table->timestamps();

            $table->foreign('code_deug')
                  ->references('code_deug')
                  ->on('filiere')
                  ->onDelete('cascade');

            $table->foreign('code_licence')
                  ->references('code_licence')
                  ->on('parcour')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiant');
    }
};
