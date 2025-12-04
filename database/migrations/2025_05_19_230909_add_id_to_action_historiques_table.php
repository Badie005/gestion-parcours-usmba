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
        // L'ID est désormais ajouté directement lors de la création de la table
        // dans 2025_05_19_160000_create_core_tables.php
        // Cette migration est conservée vide pour éviter de casser l'historique des migrations
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
