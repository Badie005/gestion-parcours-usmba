<?php

namespace Database\Seeders;

// Nous n'utilisons plus le modèle User
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TestDataSeeder;
use Database\Seeders\LargeSampleSeeder;
use Database\Seeders\ResultatsAcademiquesSeeder;
use Database\Seeders\AdminSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Utiliser les seeders dans le bon ordre pour respecter les contraintes
        $this->call([
            TestDataSeeder::class,          // Filieres & Parcours
            LargeSampleSeeder::class,       // +150 exemples réalistes
            ResultatsAcademiquesSeeder::class, // Génère les notes pour chaque étudiant
            ActionHistoriqueSeeder::class,  // Historique d'actions pour tous
            AdminSeeder::class,             // Compte Admin
        ]);
        
        // N'utilisez pas User::factory() car nous utilisons le modèle Etudiant pour l'authentification
        // et non le modèle User par défaut de Laravel
    }
}
