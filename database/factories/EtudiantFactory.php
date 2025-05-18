<?php

namespace Database\Factories;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Parcour;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Récupération d'une filière existante ou création si non existante
        $filiere = Filiere::inRandomOrder()->first() ?? Filiere::factory()->create();
        
        // Id parcours peut être null parfois
        $parcour = $filiere->choix_parcour_autorise ? Parcour::where('id_filiere', $filiere->id_filiere)->inRandomOrder()->first() : null;
        $id_parcour = $parcour ? $parcour->id_parcour : null;
        
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password123'),
            'date_naissance' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
            'adresse' => $this->faker->address(),
            'telephone' => $this->faker->numerify('06########'),
            'id_filiere' => $filiere->id_filiere,
            'id_parcour' => $id_parcour,
            'choix_confirme' => $id_parcour ? $this->faker->boolean() : false,
            'date_choix' => $id_parcour ? $this->faker->optional(0.7)->dateTimeBetween('-6 months', 'now') : null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    
    /**
     * État pour un étudiant dans une filière avec choix autorisé.
     */
    public function withChoixAutorise(): self
    {
        return $this->state(function (array $attributes) {
            $filiere = Filiere::where('choix_parcour_autorise', true)->inRandomOrder()->first() ?? 
                       Filiere::factory()->create(['choix_parcour_autorise' => true]);
            
            return [
                'id_filiere' => $filiere->id_filiere,
            ];
        });
    }
    
    /**
     * État pour un étudiant dans une filière sans choix autorisé.
     */
    public function withoutChoixAutorise(): self
    {
        return $this->state(function (array $attributes) {
            $filiere = Filiere::where('choix_parcour_autorise', false)->inRandomOrder()->first() ??
                       Filiere::factory()->create(['choix_parcour_autorise' => false]);
                       
            // Trouver le parcours par défaut de cette filière
            $parcourDefaut = Parcour::where('id_filiere', $filiere->id_filiere)
                                    ->where('est_parcour_defaut', true)
                                    ->first() ??
                             Parcour::where('id_filiere', $filiere->id_filiere)
                                   ->inRandomOrder()
                                   ->first();
            
            return [
                'id_filiere' => $filiere->id_filiere,
                'id_parcour' => $parcourDefaut ? $parcourDefaut->id_parcour : null,
                'choix_confirme' => false,
                'date_choix' => null,
            ];
        });
    }
    
    /**
     * État pour un étudiant avec un choix de parcours confirmé.
     */
    public function withConfirmedChoice(): self
    {
        return $this->state(function (array $attributes) {
            $filiere = Filiere::where('choix_parcour_autorise', true)->inRandomOrder()->first() ??
                       Filiere::factory()->create(['choix_parcour_autorise' => true]);
                       
            $parcour = Parcour::where('id_filiere', $filiere->id_filiere)->inRandomOrder()->first() ??
                      Parcour::factory()->create(['id_filiere' => $filiere->id_filiere]);
            
            return [
                'id_filiere' => $filiere->id_filiere,
                'id_parcour' => $parcour->id_parcour,
                'choix_confirme' => true,
                'date_choix' => now()->subDays(rand(1, 30)),
            ];
        });
    }
    
    /**
     * État pour un étudiant avec profil complet pour générer un PDF.
     */
    public function withCompleteProfile(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'nom' => $this->faker->lastName(),
                'prenom' => $this->faker->firstName(),
                'date_naissance' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
                'adresse' => $this->faker->address(),
                'telephone' => $this->faker->numerify('06########'),
            ];
        });
    }
}
