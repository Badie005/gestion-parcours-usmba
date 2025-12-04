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
        // Ajouter remember_token à la table etudiants si absent
        if (!Schema::hasColumn('etudiants', 'remember_token')) {
            Schema::table('etudiants', function (Blueprint $table) {
                $table->rememberToken()->after('password');
            });
        }

        // Créer la table password_reset_tokens si elle n'existe pas
        if (!Schema::hasTable('password_reset_tokens')) {
            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('etudiants', function (Blueprint $table) {
            if (Schema::hasColumn('etudiants', 'remember_token')) {
                $table->dropColumn('remember_token');
            }
        });

        Schema::dropIfExists('password_reset_tokens');
    }
};
