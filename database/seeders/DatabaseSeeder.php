<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\FiliereSeeder;
use Database\Seeders\ParcourSeeder;
use Database\Seeders\EtudiantSeeder;
use Database\Seeders\ActionHistoriqueSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Appel des seeders dans l'ordre correct (gérer les dépendances)
        // 1. D'abord FiliereSeeder (table parente)
        $this->call(FiliereSeeder::class);
        
        // 2. Ensuite ParcourSeeder (dépend de filiere)
        $this->call(ParcourSeeder::class);
        
        // 3. Ensuite EtudiantSeeder (dépend de filiere et parcour)
        $this->call(EtudiantSeeder::class);
        
        // 4. Enfin ActionHistoriqueSeeder (dépend de etudiant)
        $this->call(ActionHistoriqueSeeder::class);
        
        // Création d'un utilisateur de test pour l'authentification
        User::factory()->create([
            'name' => 'Admin Test',
            'email' => 'admin@example.com',
        ]);
    }
}
