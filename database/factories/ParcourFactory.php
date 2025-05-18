<?php

namespace Database\Factories;

use App\Models\Filiere;
use App\Models\Parcour;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parcour>
 */
class ParcourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Liste des noms de parcours possibles par filière
        $parcoursByFiliere = [
            'Informatique' => ['Intelligence Artificielle', 'Développement Web', 'Sécurité Informatique'],
            'Mathématiques' => ['Mathématiques Fondamentales', 'Mathématiques Appliquées'],
            'Physique' => ['Physique Théorique', 'Physique Appliquée'],
        ];
        
        // Récupération d'une filière existante ou création d'une nouvelle
        $filiere = Filiere::inRandomOrder()->first() ?? Filiere::factory()->create();
        
        // Sélection d'un nom de parcours approprié pour la filière
        $nomParcours = '';
        if (isset($parcoursByFiliere[$filiere->nom_filiere])) {
            $possibleParcours = $parcoursByFiliere[$filiere->nom_filiere];
            $nomParcours = $possibleParcours[array_rand($possibleParcours)];
        } else {
            $nomParcours = 'Parcours ' . $this->faker->word();
        }
        
        return [
            'nom_parcour' => $nomParcours,
            'description' => $this->faker->paragraph(),
            'id_filiere' => $filiere->id_filiere,
            'est_parcour_defaut' => false, // Par défaut, non parcours par défaut
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    
    /**
     * Définir le parcours comme parcours par défaut.
     */
    public function asDefault(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'est_parcour_defaut' => true,
            ];
        });
    }
    
    /**
     * Associer le parcours à une filière spécifique.
     */
    public function forFiliere(Filiere $filiere): self
    {
        return $this->state(function (array $attributes) use ($filiere) {
            return [
                'id_filiere' => $filiere->id_filiere,
            ];
        });
    }
}
