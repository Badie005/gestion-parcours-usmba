<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Seed minimal data required for authentication & relations.
     */
    public function run(): void
    {
        /* ------------------------------------------------------------------
         | Filieres
         |------------------------------------------------------------------*/
        DB::table('filieres')->insertOrIgnore([
            [
                'code_deug'               => 'INF',
                'deug_intitule_fr'        => 'Informatique',
                'deug_intitule_ar'        => null,
                'description'             => 'Filière Informatique',
                'choix_parcour_autorise'  => true,
                'created_at'              => now(),
                'updated_at'              => now(),
            ],
        ]);

        /* ------------------------------------------------------------------
         | Parcours
         |------------------------------------------------------------------*/
        DB::table('parcours')->insertOrIgnore([
            [
                'code_licence'        => 'INF01',
                'licence_intitule_fr' => 'Développement Web',
                'licence_intitule_ar' => null,
                'description'         => 'Spécialisation en technologies web, frameworks modernes et développement d\'applications internet. Idéal pour les carrières dans le développement frontend/backend.',
                'id_filiere'          => 'INF',
                'est_parcour_defaut'  => true,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'code_licence'        => 'INF02',
                'licence_intitule_fr' => 'Intelligence Artificielle',
                'licence_intitule_ar' => null,
                'description'         => 'Formation approfondie en algorithmes d\'IA, apprentissage automatique et réseaux de neurones. Préparation aux métiers d\'avenir dans le domaine de l\'intelligence artificielle.',
                'id_filiere'          => 'INF',
                'est_parcour_defaut'  => false,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'code_licence'        => 'INF03',
                'licence_intitule_fr' => 'Cybersécurité',
                'licence_intitule_ar' => null,
                'description'         => 'Spécialisation en sécurité informatique, protection des systèmes et analyse de vulnérabilités. Formation aux techniques de défense contre les cyberattaques.',
                'id_filiere'          => 'INF',
                'est_parcour_defaut'  => false,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'code_licence'        => 'INF04',
                'licence_intitule_fr' => 'Génie Logiciel',
                'licence_intitule_ar' => null,
                'description'         => 'Maîtrise des méthodes de conception, développement et maintenance de logiciels complexes. Focus sur les architectures logicielles et la gestion de projets.',
                'id_filiere'          => 'INF',
                'est_parcour_defaut'  => false,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'code_licence'        => 'INF05',
                'licence_intitule_fr' => 'Data Science',
                'licence_intitule_ar' => null,
                'description'         => 'Analyse et traitement de grandes quantités de données. Formation aux techniques statistiques, au big data et à la visualisation de données.',
                'id_filiere'          => 'INF',
                'est_parcour_defaut'  => false,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
        ]);

        /* ------------------------------------------------------------------
         | Etudiants
         |------------------------------------------------------------------*/
        DB::table('etudiants')->insertOrIgnore([
            [
                'num_inscription'      => '20240001',
                'nom_fr'              => 'Elyamani',
                'prenom_fr'           => 'Salma',
                'nom_ar'              => null,
                'prenom_ar'           => null,
                'email_academique'    => 'salma.elyamani@etu.univ.ma',
                'password'            => Hash::make('password123'),
                'date_naissance'      => '2000-05-19',
                'lieu_naissance_fr'   => 'Fès',
                'lieu_naissance_ar'   => null,
                'sexe'                => 'F',
                'pays_naissance'      => 'Maroc',
                'nationalite'         => 'Marocaine',
                'adresse'             => '10 Rue Example',
                'telephone'           => '0600000000',
                'filiere_id'          => 'INF',
                'parcour_id'          => 'INF01',
                'choix_confirme'      => true,
                'date_choix'          => now(),
                'annee'               => date('Y'),
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
        ]);
    }
}