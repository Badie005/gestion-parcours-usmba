<?php

namespace Database\Seeders;

use App\Models\Etudiant;
use App\Models\ResultatAcademique;
use Illuminate\Database\Seeder;

class ResultatsAcademiquesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Noms de modules par semestre
        $modulesParSemestre = [
            'S1' => [
                ['code' => 'M1S1', 'titre' => 'Analyse 1', 'coefficient' => 1.00],
                ['code' => 'M2S1', 'titre' => 'Algèbre 1', 'coefficient' => 1.00],
                ['code' => 'M3S1', 'titre' => 'Mécanique 1', 'coefficient' => 1.00],
                ['code' => 'M4S1', 'titre' => 'Thermodynamique', 'coefficient' => 1.00],
                ['code' => 'M5S1', 'titre' => 'Informatique 1', 'coefficient' => 1.00],
                ['code' => 'M6S1', 'titre' => 'Langue et Communication 1', 'coefficient' => 0.75],
                ['code' => 'M7S1', 'titre' => 'Chimie Générale', 'coefficient' => 1.00],
            ],
            'S2' => [
                ['code' => 'M1S2', 'titre' => 'Analyse 2', 'coefficient' => 1.00],
                ['code' => 'M2S2', 'titre' => 'Algèbre 2', 'coefficient' => 1.00],
                ['code' => 'M3S2', 'titre' => 'Mécanique 2', 'coefficient' => 1.00],
                ['code' => 'M4S2', 'titre' => 'Électronique', 'coefficient' => 1.00],
                ['code' => 'M5S2', 'titre' => 'Informatique 2', 'coefficient' => 1.00],
                ['code' => 'M6S2', 'titre' => 'Langue et Communication 2', 'coefficient' => 0.75],
                ['code' => 'M7S2', 'titre' => 'Statistiques et Probabilités', 'coefficient' => 1.00],
            ],
            'S3' => [
                ['code' => 'M1S3', 'titre' => 'Analyse 3', 'coefficient' => 1.00],
                ['code' => 'M2S3', 'titre' => 'Algèbre 3', 'coefficient' => 1.00],
                ['code' => 'M3S3', 'titre' => 'Mécanique 3', 'coefficient' => 1.00],
                ['code' => 'M4S3', 'titre' => 'Électromagnétisme', 'coefficient' => 1.00],
                ['code' => 'M5S3', 'titre' => 'Structure de Données', 'coefficient' => 1.00],
                ['code' => 'M6S3', 'titre' => 'Langue et Communication 3', 'coefficient' => 0.75],
                ['code' => 'M7S3', 'titre' => 'Physique Quantique', 'coefficient' => 1.00],
            ],
            'S4' => [
                ['code' => 'M1S4', 'titre' => 'Analyse Numérique', 'coefficient' => 1.00],
                ['code' => 'M2S4', 'titre' => 'Recherche Opérationnelle', 'coefficient' => 1.00],
                ['code' => 'M3S4', 'titre' => 'Architecture des Ordinateurs', 'coefficient' => 1.00],
                ['code' => 'M4S4', 'titre' => 'Systèmes d\'Exploitation', 'coefficient' => 1.00],
                ['code' => 'M5S4', 'titre' => 'Bases de Données', 'coefficient' => 1.00],
                ['code' => 'M6S4', 'titre' => 'Langue et Communication 4', 'coefficient' => 0.75],
                ['code' => 'M7S4', 'titre' => 'Projet Informatique', 'coefficient' => 1.25],
            ],
        ];

        // Ru00e9cupu00e9rer tous les u00e9tudiants
        $etudiants = Etudiant::all();

        foreach ($etudiants as $etudiant) {
            // Log pour suivre la progression
            $this->command->info("Génération des résultats académiques pour l'étudiant: {$etudiant->num_inscription}");
            
            // Pour chaque semestre
            foreach ($modulesParSemestre as $semestre => $modules) {
                // Pour chaque module dans le semestre
                foreach ($modules as $module) {
                    // Générer une note aléatoire entre 5 et 18
                    $note = rand(50, 180) / 10;
                    
                    // Déterminer le statut en fonction de la note
                    $statut = $note >= 10 ? 'validé' : 'non_validé';
                    
                    // Créer l'enregistrement
                    ResultatAcademique::create([
                        'num_inscription' => $etudiant->num_inscription,
                        'semestre' => $semestre,
                        'code_module' => $module['code'],
                        'titre_module' => $module['titre'],
                        'note' => $note,
                        'coefficient' => $module['coefficient'],
                        'statut' => $statut,
                    ]);
                }
            }
            
            // Enregistrer une action dans l'historique de l'étudiant
            $etudiant->enregistrerAction(
                'generation_resultats',
                'Génération automatique des résultats académiques',
                ['semestres' => array_keys($modulesParSemestre)]
            );
        }
        
        $this->command->info('Les résultats académiques ont été générés avec succès!');
    }
}
