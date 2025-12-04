<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création d'un compte Administrateur
        DB::table('etudiants')->insertOrIgnore([
            [
                'num_inscription' => 'ADMIN001',
                'nom_fr' => 'Administrateur',
                'prenom_fr' => 'Systeme',
                'email_academique' => 'admin@usmba.ac.ma',
                'password' => Hash::make('admin123'),
                'role' => 'admin', // Rôle administrateur
                'filiere_id' => 'INF', // Requis par la FK, on met une valeur par défaut
                'parcour_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
