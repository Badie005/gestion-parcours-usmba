<?php

namespace Database\Factories;

use App\Models\Filiere;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Filiere>
 */
class FiliereFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $filiereNames = ['Informatique', 'Mathématiques', 'Physique'];
        static $index = 0;
        
        // Utilisation des noms existants avec rotation, ou génération aléatoire si tous les noms sont utilisés
        $name = $index < count($filiereNames) ? $filiereNames[$index++] : $this->faker->unique()->word();
        
        return [
            'nom_filiere' => $name,
            'choix_parcour_autorise' => $this->faker->boolean(70), // 70% de chance que le choix soit autorisé
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    
    /**
     * Filiere avec choix de parcours autorisé
     */
    public function withChoixAutorise(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'choix_parcour_autorise' => true,
            ];
        });
    }
    
    /**
     * Filiere sans choix de parcours autorisé
     */
    public function withoutChoixAutorise(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'choix_parcour_autorise' => false,
            ];
        });
    }
}
