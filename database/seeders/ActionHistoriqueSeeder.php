<?php

namespace Database\Seeders;

use App\Models\ActionHistorique;
use App\Models\Etudiant;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActionHistoriqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $etudiants = Etudiant::all();
        
        foreach ($etudiants as $etudiant) {
            // Action de connexion - pour tous les étudiants
            ActionHistorique::create([
                'id_etudiant' => $etudiant->id_etudiant,
                'type_action' => 'login',
                'description' => 'Connexion au système',
                'donnees_additionnelles' => ['ip' => '192.168.1.' . rand(1, 254)],
                'created_at' => Carbon::now()->subDays(rand(0, 5))->subHours(rand(1, 23))->subMinutes(rand(1, 59))
            ]);
            
            // Si l'étudiant a un parcours, ajouter une action de sélection
            if ($etudiant->id_parcour) {
                ActionHistorique::create([
                    'id_etudiant' => $etudiant->id_etudiant,
                    'type_action' => 'parcours_selection',
                    'description' => 'Sélection du parcours ' . $etudiant->parcour->nom_parcour,
                    'donnees_additionnelles' => [
                        'id_parcour' => $etudiant->id_parcour,
                        'nom_parcour' => $etudiant->parcour->nom_parcour
                    ],
                    'created_at' => Carbon::now()->subDays(rand(0, 3))->subHours(rand(1, 12))
                ]);
                
                // Si le choix est confirmé, ajouter une action de confirmation
                if ($etudiant->choix_confirme) {
                    ActionHistorique::create([
                        'id_etudiant' => $etudiant->id_etudiant,
                        'type_action' => 'parcours_confirmation',
                        'description' => 'Confirmation du choix de parcours',
                        'donnees_additionnelles' => [
                            'id_parcour' => $etudiant->id_parcour,
                            'date_confirmation' => $etudiant->date_choix->format('Y-m-d H:i:s')
                        ],
                        'created_at' => Carbon::now()->subDays(rand(0, 2))->subHours(rand(1, 6))
                    ]);
                    
                    // Ajouter parfois une action d'exportation PDF
                    if (rand(0, 1)) {
                        ActionHistorique::create([
                            'id_etudiant' => $etudiant->id_etudiant,
                            'type_action' => 'pdf_export',
                            'description' => 'Export du PDF de confirmation',
                            'created_at' => Carbon::now()->subDays(rand(0, 1))->subHours(rand(0, 5))
                        ]);
                    }
                }
            }
            
            // Ajouter quelques connexions supplémentaires aléatoires
            $nbConnexionsSupp = rand(0, 3);
            for ($i = 0; $i < $nbConnexionsSupp; $i++) {
                ActionHistorique::create([
                    'id_etudiant' => $etudiant->id_etudiant,
                    'type_action' => 'login',
                    'description' => 'Connexion au système',
                    'donnees_additionnelles' => ['ip' => '192.168.1.' . rand(1, 254)],
                    'created_at' => Carbon::now()->subDays(rand(0, 7))->subHours(rand(1, 23))
                ]);
            }
        }
    }
}
