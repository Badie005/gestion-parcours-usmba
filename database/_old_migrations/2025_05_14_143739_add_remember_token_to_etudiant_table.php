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
        Schema::table('etudiant', function (Blueprint $table) {
            // Vérifier et ajouter le champ role si nécessaire
            if (!Schema::hasColumn('etudiant', 'role')) {
                $table->string('role')->default('etudiant')->after('email');
            }
            
            // Vérifier et ajouter le champ remember_token si nécessaire
            if (!Schema::hasColumn('etudiant', 'remember_token')) {
                $table->rememberToken();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprimer les colonnes si elles existent
        Schema::table('etudiant', function (Blueprint $table) {
            if (Schema::hasColumn('etudiant', 'role')) {
                $table->dropColumn('role');
            }
            
            if (Schema::hasColumn('etudiant', 'remember_token')) {
                $table->dropColumn('remember_token');
            }
        });
    }
};
