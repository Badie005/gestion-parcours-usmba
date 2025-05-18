<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParcourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer 7 parcours répartis entre les filières avec un parcours par défaut pour chaque filière
        
        // Parcours pour la filière Informatique (id = 1)
        DB::table('parcour')->insert([
            [
                'nom_parcour' => 'Développement Web',
                'description' => 'Spécialisation en technologies web et applications internet',
                'id_filiere' => 1,
                'est_parcour_defaut' => true, // Parcours par défaut
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom_parcour' => 'Intelligence Artificielle',
                'description' => 'Formation en algorithmes d\'IA et apprentissage automatique',
                'id_filiere' => 1,
                'est_parcour_defaut' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom_parcour' => 'Cybersecurité',
                'description' => 'Formation en sécurité informatique et protection des données',
                'id_filiere' => 1,
                'est_parcour_defaut' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Parcours pour la filière Mathématiques (id = 2)
            [
                'nom_parcour' => 'Mathématiques appliquées',
                'description' => 'Application des mathématiques à des problèmes concrets',
                'id_filiere' => 2,
                'est_parcour_defaut' => true, // Parcours par défaut
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom_parcour' => 'Statistiques',
                'description' => 'Analyse de données et modèles probabilistes',
                'id_filiere' => 2,
                'est_parcour_defaut' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Parcours pour la filière Physique (id = 3)
            [
                'nom_parcour' => 'Physique théorique',
                'description' => 'Étude des modèles mathématiques de la physique',
                'id_filiere' => 3,
                'est_parcour_defaut' => true, // Parcours par défaut
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom_parcour' => 'Physique expérimentale',
                'description' => 'Approche expérimentale des phénomènes physiques',
                'id_filiere' => 3,
                'est_parcour_defaut' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
