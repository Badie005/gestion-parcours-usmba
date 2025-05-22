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
        Schema::table('action_historiques', function (Blueprint $table) {
            // Add ID column as primary key
            $table->id()->first();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('action_historiques', function (Blueprint $table) {
            // Remove the ID column
            $table->dropColumn('id');
        });
    }
};
