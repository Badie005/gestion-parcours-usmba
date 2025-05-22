<?php

namespace Database\Seeders;

use App\Models\ActionHistorique;
use App\Models\Etudiant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionHistoriqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer tous les étudiants existants
        $etudiants = DB::table('etudiants')->get();

        // Créer des actions historiques pour chaque étudiant
        foreach ($etudiants as $etudiant) {
            // Action de connexion
            DB::table('action_historiques')->insert([
                'etudiant_id' => $etudiant->num_inscription,
                'type_action' => 'login',
                'description' => 'Connexion au système',
                'donnees_additionnelles' => json_encode(['ip' => '127.0.0.1']),
                'created_at' => now()->subHours(rand(1, 48)),
                'updated_at' => now()->subHours(rand(1, 48))
            ]);

            // Action de consultation de profile
            DB::table('action_historiques')->insert([
                'etudiant_id' => $etudiant->num_inscription,
                'type_action' => 'profil_view',
                'description' => 'Consultation du profil',
                'donnees_additionnelles' => null,
                'created_at' => now()->subHours(rand(1, 24)),
                'updated_at' => now()->subHours(rand(1, 24))
            ]);

            // Pour les étudiants qui ont choisi un parcours
            if (!empty($etudiant->parcour_id)) {
                DB::table('action_historiques')->insert([
                    'etudiant_id' => $etudiant->num_inscription,
                    'type_action' => 'parcours_selection',
                    'description' => 'Sélection d\'un parcours',
                    'donnees_additionnelles' => json_encode(['parcour_id' => $etudiant->parcour_id]),
                    'created_at' => now()->subDays(rand(1, 10)),
                    'updated_at' => now()->subDays(rand(1, 10))
                ]);
                
                // Si le choix est confirmé
                if ($etudiant->choix_confirme) {
                    DB::table('action_historiques')->insert([
                        'etudiant_id' => $etudiant->num_inscription,
                        'type_action' => 'parcours_confirmation',
                        'description' => 'Confirmation du choix de parcours',
                        'donnees_additionnelles' => json_encode(['parcour_id' => $etudiant->parcour_id]),
                        'created_at' => now()->subHours(rand(1, 12)),
                        'updated_at' => now()->subHours(rand(1, 12))
                    ]);
                }
            }
        }
    }
}