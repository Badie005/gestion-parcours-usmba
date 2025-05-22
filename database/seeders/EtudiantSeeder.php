<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EtudiantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer 5 étudiants avec différentes configurations
        DB::table('etudiants')->insert([
            [
                'num_inscription' => '2025101',
                'nom_fr' => 'Dupont',
                'prenom_fr' => 'Marie',
                'email_academique' => 'marie.dupont@example.com',
                'password' => Hash::make('password123'),
                'date_naissance' => '1999-05-15',
                'adresse' => '12 rue de la Paix, 75001 Paris',
                'telephone' => '0612345678',
                'filiere_id' => 'INF', // Informatique
                'parcour_id' => 'INF01', // Développement Web (a fait son choix)
                'choix_confirme' => true,
                'date_choix' => now()->subDays(30),
                'nb_val_ac_s1' => 6,
                'nb_val_ac_s2' => 6,
                'nb_val_ac_s3' => 6,
                'nb_val_ac_s4' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'num_inscription' => '2025102',
                'nom_fr' => 'Martin',
                'prenom_fr' => 'Lucas',
                'email_academique' => 'lucas.martin@example.com',
                'password' => Hash::make('password123'),
                'date_naissance' => '2000-02-20',
                'adresse' => '25 avenue des Champs-Élysées, 75008 Paris',
                'telephone' => '0623456789',
                'filiere_id' => 'INF', // Informatique
                'parcour_id' => null, // N'a pas encore fait son choix
                'choix_confirme' => false,
                'date_choix' => null,
                'nb_val_ac_s1' => 6,
                'nb_val_ac_s2' => 6,
                'nb_val_ac_s3' => 6,
                'nb_val_ac_s4' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'num_inscription' => '2025201',
                'nom_fr' => 'Test',
                'prenom_fr' => 'Etudiant1',
                'email_academique' => 'etu1@etu.univ.ma',
                'password' => Hash::make('1234'),
                'date_naissance' => '2003-01-01',
                'adresse' => 'Adresse test',
                'telephone' => '0600000000',
                'filiere_id' => 'INF',
                'parcour_id' => null,
                'choix_confirme' => false,
                'date_choix' => null,
                'nb_val_ac_s1' => 6,
                'nb_val_ac_s2' => 6,
                'nb_val_ac_s3' => 6,
                'nb_val_ac_s4' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'num_inscription' => '2025103',
                'nom_fr' => 'Dubois',
                'prenom_fr' => 'Sophie',
                'email_academique' => 'sophie.dubois@example.com',
                'password' => Hash::make('password123'),
                'date_naissance' => '2001-07-10',
                'adresse' => '5 rue du Faubourg Saint-Honoré, 75008 Paris',
                'telephone' => '0634567890',
                'filiere_id' => 'INF', // Utilisons la filiere qui existe
                'parcour_id' => 'INF01', // Utilisons le parcours qui existe
                'choix_confirme' => true,
                'date_choix' => now()->subDays(15),
                'nb_val_ac_s1' => 6,
                'nb_val_ac_s2' => 6,
                'nb_val_ac_s3' => 6,
                'nb_val_ac_s4' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'num_inscription' => '2025104',
                'nom_fr' => 'Robert',
                'prenom_fr' => 'Thomas',
                'email_academique' => 'thomas.robert@example.com',
                'password' => Hash::make('password123'),
                'date_naissance' => '1998-12-05',
                'adresse' => '8 place de la Concorde, 75001 Paris',
                'telephone' => '0645678901',
                'filiere_id' => 'INF', // Utilisons la filiere qui existe
                'parcour_id' => 'INF01', // Utilisons le parcours qui existe
                'choix_confirme' => false,
                'date_choix' => now()->subDays(5),
                'nb_val_ac_s1' => 6,
                'nb_val_ac_s2' => 6,
                'nb_val_ac_s3' => 6,
                'nb_val_ac_s4' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'num_inscription' => '2025105',
                'nom_fr' => 'Petit',
                'prenom_fr' => 'Julie',
                'email_academique' => 'julie.petit@example.com',
                'password' => Hash::make('password123'),
                'date_naissance' => '2002-03-30',
                'adresse' => '15 boulevard Saint-Germain, 75006 Paris',
                'telephone' => '0656789012',
                'filiere_id' => 'INF', // Utilisons la filiere qui existe
                'parcour_id' => 'INF01', // Utilisons le parcours qui existe
                'choix_confirme' => false,
                'date_choix' => null,
                'nb_val_ac_s1' => 6,
                'nb_val_ac_s2' => 6,
                'nb_val_ac_s3' => 6,
                'nb_val_ac_s4' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
