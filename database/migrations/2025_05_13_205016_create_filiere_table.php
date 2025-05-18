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
        Schema::create('filiere', function (Blueprint $table) {
            $table->string('code_deug', 50)->primary();
            $table->string('deug_intitule_fr', 100);
            $table->string('deug_intitule_ar', 100)->nullable();
            $table->text('description')->nullable();
            $table->boolean('choix_parcour_autorise')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filiere');
    }
};
