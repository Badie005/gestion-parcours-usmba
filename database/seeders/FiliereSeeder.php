<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer 3 filières dont 2 avec choix_parcour_autorise = true et 1 avec false
        DB::table('filiere')->insert([
            [
                'nom_filiere' => 'Informatique',
                'description' => 'Formation en sciences informatiques et programmation',
                'choix_parcour_autorise' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom_filiere' => 'Mathématiques',
                'description' => 'Formation approfondie en mathématiques pures et appliquées',
                'choix_parcour_autorise' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom_filiere' => 'Physique',
                'description' => 'Études des lois fondamentales de la physique',
                'choix_parcour_autorise' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
