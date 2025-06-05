<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Carbon\Carbon;

class LargeSampleSeeder extends Seeder
{
    /**
     * Generate a large realistic dataset for testing purposes.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR');
        $anneeActuelle = date('Y');

        /* --------------------------------------------------------------
         | Filieres (ensure at least three exist)
         |--------------------------------------------------------------*/
        $filieres = [
            [
                'code_deug'             => 'INF',
                'deug_intitule_fr'      => 'Informatique',
                'deug_intitule_ar'      => null,
                'description'           => 'Filière Informatique',
                'choix_parcour_autorise'=> true,
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'code_deug'             => 'MAT',
                'deug_intitule_fr'      => 'Mathématiques',
                'deug_intitule_ar'      => null,
                'description'           => 'Filière Mathématiques',
                'choix_parcour_autorise'=> true,
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'code_deug'             => 'PHY',
                'deug_intitule_fr'      => 'Physique',
                'deug_intitule_ar'      => null,
                'description'           => 'Filière Physique',
                'choix_parcour_autorise'=> true,
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
        ];
        DB::table('filieres')->insertOrIgnore($filieres);

        /* --------------------------------------------------------------
         | Parcours (licences)
         |--------------------------------------------------------------*/
        $parcours = [
            // Informatique
            ['code_licence' => 'INF01', 'licence_intitule_fr' => 'Développement Web',          'id_filiere' => 'INF'],
            ['code_licence' => 'INF02', 'licence_intitule_fr' => 'Intelligence Artificielle',  'id_filiere' => 'INF'],
            ['code_licence' => 'INF03', 'licence_intitule_fr' => 'Cybersécurité',             'id_filiere' => 'INF'],
            // Mathématiques
            ['code_licence' => 'MAT01', 'licence_intitule_fr' => 'Mathématiques Fondamentales','id_filiere' => 'MAT'],
            ['code_licence' => 'MAT02', 'licence_intitule_fr' => 'Mathématiques Appliquées',   'id_filiere' => 'MAT'],
            // Physique
            ['code_licence' => 'PHY01', 'licence_intitule_fr' => 'Physique Théorique',         'id_filiere' => 'PHY'],
            ['code_licence' => 'PHY02', 'licence_intitule_fr' => 'Physique Appliquée',         'id_filiere' => 'PHY'],
        ];

        foreach ($parcours as &$parcour) {
            $parcour = array_merge($parcour, [
                'licence_intitule_ar' => null,
                'description'         => 'Parcours ' . $parcour['licence_intitule_fr'],
                'est_parcour_defaut'  => false,
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);
        }
        DB::table('parcours')->insertOrIgnore($parcours);

        /* --------------------------------------------------------------
         | Étudiants
         |--------------------------------------------------------------*/
        $allParcoursCodes = array_column($parcours, 'code_licence');
        $nbEtudiants      = 150; // >100 comme demandé
        $bulkInsert       = [];

        for ($i = 0; $i < $nbEtudiants; $i++) {
            $numInscription = sprintf('%d%05d', $anneeActuelle, 10000 + $i); // ex: 202510000

            $nom     = $faker->lastName();
            $prenom  = $faker->firstName();
            $email   = ($i + 1) . '@' . ($i + 1) . '.com';

            $parcourId     = $faker->randomElement($allParcoursCodes);
            $choixConfirme = $faker->boolean(70); // 70% confirmés

            $bulkInsert[] = [
                'num_inscription'  => $numInscription,
                'nom_fr'           => $nom,
                'prenom_fr'        => $prenom,
                'email_academique' => $email,
                'password'         => Hash::make('1234'),
                'date_naissance'   => Carbon::parse($faker->dateTimeBetween('-25 years', '-18 years'))->format('Y-m-d'),
                'adresse'          => $faker->address(),
                'telephone'        => $faker->numerify('06########'),
                'filiere_id'       => substr($parcourId, 0, 3), // INF, MAT, PHY
                'parcour_id'       => $parcourId,
                'choix_confirme'   => $choixConfirme,
                'date_choix'       => $choixConfirme ? $faker->dateTimeBetween('-6 months', 'now') : null,
                'annee'            => $anneeActuelle,
                // Valeurs initiales des modules validés – seront mises à jour
                'nb_val_ac_s1'     => 0,
                'nb_val_ac_s2'     => 0,
                'nb_val_ac_s3'     => 0,
                'nb_val_ac_s4'     => 0,
                'created_at'       => now(),
                'updated_at'       => now(),
            ];
        }

        // Insert en lots pour performance
        foreach (array_chunk($bulkInsert, 500) as $chunk) {
            DB::table('etudiants')->insert($chunk);
        }
    }
}
