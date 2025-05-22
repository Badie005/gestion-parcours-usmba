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
        Schema::create('parcour', function (Blueprint $table) {
            $table->string('code_licence', 50)->primary();
            $table->string('licence_intitule_fr', 100);
            $table->string('licence_intitule_ar', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('code_deug', 50);
            $table->boolean('est_parcour_defaut')->default(false);
            $table->timestamps();
            
            $table->foreign('code_deug')
                  ->references('code_deug')
                  ->on('filiere')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcour');
    }
};
