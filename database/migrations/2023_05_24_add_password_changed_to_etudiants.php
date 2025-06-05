<?php

// Cette migration devient obsolète, car la colonne `password_changed` est
// désormais créée directement dans `2025_05_19_160000_create_core_tables.php`.

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * No operation – column already exists.
     */
    public function up(): void {}

    /**
     * No operation.
     */
    public function down(): void {}
};
