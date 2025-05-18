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
        // Créer 5 étudiants avec des valeurs variables pour id_parcour et choix_confirme
        DB::table('etudiant')->insert([
            [
                'nom' => 'Dupont',
                'prenom' => 'Marie',
                'email' => 'marie.dupont@example.com',
                'password' => Hash::make('password123'),
                'date_naissance' => '1999-05-15',
                'adresse' => '12 rue de la Paix, 75001 Paris',
                'telephone' => '0612345678',
                'id_filiere' => 1, // Informatique
                'id_parcour' => 1, // Développement Web (a fait son choix)
                'choix_confirme' => true,
                'date_choix' => now()->subDays(30),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Martin',
                'prenom' => 'Lucas',
                'email' => 'lucas.martin@example.com',
                'password' => Hash::make('password123'),
                'date_naissance' => '2000-02-20',
                'adresse' => '25 avenue des Champs-Élysées, 75008 Paris',
                'telephone' => '0623456789',
                'id_filiere' => 1, // Informatique
                'id_parcour' => null, // N'a pas encore fait son choix
                'choix_confirme' => false,
                'date_choix' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Dubois',
                'prenom' => 'Sophie',
                'email' => 'sophie.dubois@example.com',
                'password' => Hash::make('password123'),
                'date_naissance' => '2001-07-10',
                'adresse' => '5 rue du Faubourg Saint-Honoré, 75008 Paris',
                'telephone' => '0634567890',
                'id_filiere' => 2, // Mathématiques
                'id_parcour' => 4, // Mathématiques appliquées (a fait son choix)
                'choix_confirme' => true,
                'date_choix' => now()->subDays(15),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Robert',
                'prenom' => 'Thomas',
                'email' => 'thomas.robert@example.com',
                'password' => Hash::make('password123'),
                'date_naissance' => '1998-12-05',
                'adresse' => '8 place de la Concorde, 75001 Paris',
                'telephone' => '0645678901',
                'id_filiere' => 2, // Mathématiques
                'id_parcour' => 5, // Statistiques (choix fait mais non confirmé)
                'choix_confirme' => false,
                'date_choix' => now()->subDays(5),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Petit',
                'prenom' => 'Julie',
                'email' => 'julie.petit@example.com',
                'password' => Hash::make('password123'),
                'date_naissance' => '2002-03-30',
                'adresse' => '15 boulevard Saint-Germain, 75006 Paris',
                'telephone' => '0656789012',
                'id_filiere' => 3, // Physique (filière sans choix autorisé)
                'id_parcour' => 6, // Physique théorique (parcours par défaut automatique)
                'choix_confirme' => false,
                'date_choix' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
