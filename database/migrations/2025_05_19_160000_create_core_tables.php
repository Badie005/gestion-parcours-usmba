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
        /* -----------------------------------------------------------------
         | Filieres (DEUG)
         |-----------------------------------------------------------------
         */
        Schema::create('filieres', function (Blueprint $table) {
            $table->char('code_deug', 10)->primary();
            $table->string('deug_intitule_fr');
            $table->string('deug_intitule_ar')->nullable();
            $table->text('description')->nullable();
            $table->boolean('choix_parcour_autorise')->default(false);
            $table->timestamps();
        });

        /* -----------------------------------------------------------------
         | Parcours (Licence)
         |-----------------------------------------------------------------
         */
        Schema::create('parcours', function (Blueprint $table) {
            $table->char('code_licence', 10)->primary();
            $table->string('licence_intitule_fr');
            $table->string('licence_intitule_ar')->nullable();
            $table->text('description')->nullable();
            $table->char('id_filiere', 10);
            $table->boolean('est_parcour_defaut')->default(false);
            $table->timestamps();

            $table->foreign('id_filiere')
                  ->references('code_deug')
                  ->on('filieres')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();
        });

        /* -----------------------------------------------------------------
         | Etudiants
         |-----------------------------------------------------------------
         */
        Schema::create('etudiants', function (Blueprint $table) {
            $table->string('num_inscription', 20)->primary();
            $table->string('nom_fr', 100);
            $table->string('prenom_fr', 100);
            $table->string('nom_ar', 100)->nullable();
            $table->string('prenom_ar', 100)->nullable();
            $table->string('email_academique')->unique();
            $table->string('password');
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance_fr', 100)->nullable();
            $table->string('lieu_naissance_ar', 100)->nullable();
            $table->enum('sexe', ['M', 'F'])->nullable();
            $table->string('pays_naissance', 100)->nullable();
            $table->string('nationalite', 100)->nullable();
            $table->text('adresse')->nullable();
            $table->string('telephone', 20)->nullable();
            $table->char('filiere_id', 10);
            $table->char('parcour_id', 10)->nullable();
            $table->boolean('choix_confirme')->default(false);
            $table->dateTime('date_choix')->nullable();
            $table->dateTime('last_login_at')->nullable();
            $table->year('annee')->nullable();
            $table->tinyInteger('aux')->nullable();
            $table->tinyInteger('nb_val_ac_s1')->nullable();
            $table->tinyInteger('nb_val_ac_s2')->nullable();
            $table->tinyInteger('nb_val_ac_s3')->nullable();
            $table->tinyInteger('nb_val_ac_s4')->nullable();
            $table->string('serie_bac', 50)->nullable();
            $table->string('lieu_bac', 100)->nullable();
            $table->year('annee_bac')->nullable();
            $table->string('lycee')->nullable();
            $table->boolean('handicap')->default(false);
            $table->string('region', 100)->nullable();
            $table->boolean('fonctionnaire')->default(false);
            $table->boolean('impression_carte')->default(false);
            $table->boolean('duplicata_carte')->default(false);
            $table->boolean('impression_deug')->default(false);
            $table->boolean('la_poutre')->default(false);
            $table->boolean('admission_deug')->default(false);
            $table->boolean('exclu')->default(false);
            $table->boolean('rd')->default(false);
            $table->boolean('reinscription')->default(false);
            $table->string('role', 20)->default('etudiant');
            $table->timestamps();

            /* Foreign Keys */
            $table->foreign('filiere_id')
                  ->references('code_deug')
                  ->on('filieres')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreign('parcour_id')
                  ->references('code_licence')
                  ->on('parcours')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            /* Indexes */
            $table->index('filiere_id');
            $table->index('parcour_id');
            $table->index(['filiere_id', 'annee']);
            $table->index(['parcour_id', 'annee']);
            $table->fullText(['nom_fr', 'prenom_fr', 'email_academique']);
        });

        /* -----------------------------------------------------------------
         | Historique des actions
         |-----------------------------------------------------------------
         */
        Schema::create('action_historiques', function (Blueprint $table) {
            $table->string('etudiant_id', 20);
            $table->string('type_action', 50);
            $table->text('description');
            $table->json('donnees_additionnelles')->nullable();
            $table->timestamps();

            $table->foreign('etudiant_id')
                  ->references('num_inscription')
                  ->on('etudiants')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->index('etudiant_id');
            $table->index('type_action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_historiques');
        Schema::dropIfExists('etudiants');
        Schema::dropIfExists('parcours');
        Schema::dropIfExists('filieres');
    }
};
