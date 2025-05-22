<?php

namespace Database\Seeders;

// Nous n'utilisons plus le modèle User
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TestDataSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Utiliser les seeders dans le bon ordre pour respecter les contraintes
        $this->call([
            TestDataSeeder::class,     // D'abord les filieres et parcours
            EtudiantSeeder::class,     // Ensuite les étudiants
            ActionHistoriqueSeeder::class, // Enfin l'historique des actions
        ]);
        
        // N'utilisez pas User::factory() car nous utilisons le modèle Etudiant pour l'authentification
        // et non le modèle User par défaut de Laravel
    }
}
