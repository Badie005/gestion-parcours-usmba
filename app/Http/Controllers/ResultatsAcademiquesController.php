<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ResultatsAcademiquesController extends Controller
{
    /**
     * Afficher les résultats académiques de l'étudiant connecté.
     */
    public function index(Request $request)
    {
        $etudiant = Auth::user();
        $anneeAcademique = $request->input('annee_academique', date('Y'));
        
        // Récupérer les années académiques disponibles
        $anneesDisponibles = $this->getAnneesAcademiquesDisponibles($etudiant);
        
        $semestres = ['S1', 'S2', 'S3', 'S4'];
        $resultatsParSemestre = [];
        $moyennesParSemestre = [];
        $modulesValides = [];
        $semestreValide = [];
        
        foreach ($semestres as $semestre) {
            $resultatsParSemestre[$semestre] = $etudiant->getResultatsSemestre($semestre, $anneeAcademique);
            $moyennesParSemestre[$semestre] = $etudiant->getMoyenneSemestre($semestre, $anneeAcademique);
            $modulesValides[$semestre] = $etudiant->getNombreModulesValidesSemestre($semestre, $anneeAcademique);
            $semestreValide[$semestre] = $etudiant->estSemestreValide($semestre, $anneeAcademique);
        }
        
        // Calculer les statistiques globales
        $statsGlobales = $this->calculerStatistiquesGlobales($etudiant);
        
        return view('resultats-academiques', [
            'etudiant' => $etudiant,
            'resultatsParSemestre' => $resultatsParSemestre,
            'moyennesParSemestre' => $moyennesParSemestre,
            'modulesValides' => $modulesValides,
            'semestreValide' => $semestreValide,
            'semestres' => $semestres,
            'anneeAcademique' => $anneeAcademique,
            'anneesDisponibles' => $anneesDisponibles,
            'statsGlobales' => $statsGlobales
        ]);
    }
    
    /**
     * Afficher les résultats académiques d'un étudiant spécifique (pour les administrateurs).
     */
    public function show($numInscription)
    {
        // Vérifier si l'utilisateur est administrateur (vous devez adapter cette logique à votre système)
        // if (!Auth::user()->isAdmin()) {
        //     return redirect()->route('dashboard')->with('error', 'Accès non autorisé');
        // }
        
        $etudiant = Etudiant::findOrFail($numInscription);
        
        $semestres = ['S1', 'S2', 'S3', 'S4'];
        $resultatsParSemestre = [];
        $moyennesParSemestre = [];
        $modulesValides = [];
        $semestreValide = [];
        
        foreach ($semestres as $semestre) {
            $resultatsParSemestre[$semestre] = $etudiant->getResultatsSemestre($semestre);
            $moyennesParSemestre[$semestre] = $etudiant->getMoyenneSemestre($semestre);
            $modulesValides[$semestre] = $etudiant->getNombreModulesValidesSemestre($semestre);
            $semestreValide[$semestre] = $etudiant->estSemestreValide($semestre);
        }
        
        return view('resultats-academiques', [
            'etudiant' => $etudiant,
            'resultatsParSemestre' => $resultatsParSemestre,
            'moyennesParSemestre' => $moyennesParSemestre,
            'modulesValides' => $modulesValides,
            'semestreValide' => $semestreValide,
            'semestres' => $semestres
        ]);
    }
    
    /**
     * Exporter les résultats académiques en PDF.
     */
    public function exportPDF(Request $request)
    {
        $etudiant = Auth::user();
        $anneeAcademique = $request->input('annee_academique', date('Y'));
        
        $semestres = ['S1', 'S2', 'S3', 'S4'];
        $resultatsParSemestre = [];
        $moyennesParSemestre = [];
        $modulesValides = [];
        $semestreValide = [];
        
        foreach ($semestres as $semestre) {
            $resultatsParSemestre[$semestre] = $etudiant->getResultatsSemestre($semestre, $anneeAcademique);
            $moyennesParSemestre[$semestre] = $etudiant->getMoyenneSemestre($semestre, $anneeAcademique);
            $modulesValides[$semestre] = $etudiant->getNombreModulesValidesSemestre($semestre, $anneeAcademique);
            $semestreValide[$semestre] = $etudiant->estSemestreValide($semestre, $anneeAcademique);
        }
        
        $data = [
            'etudiant' => $etudiant,
            'resultatsParSemestre' => $resultatsParSemestre,
            'moyennesParSemestre' => $moyennesParSemestre,
            'modulesValides' => $modulesValides,
            'semestreValide' => $semestreValide,
            'semestres' => $semestres,
            'anneeAcademique' => $anneeAcademique
        ];
        
        $pdf = PDF::loadView('pdf.resultats-academiques', $data);
        
        return $pdf->download('resultats-academiques-' . $etudiant->num_inscription . '-' . $anneeAcademique . '.pdf');
    }
    
    /**
     * Récupérer les années académiques disponibles pour un étudiant.
     */
    private function getAnneesAcademiquesDisponibles(Etudiant $etudiant)
    {
        // Récupérer les années uniques des résultats de l'étudiant
        $annees = $etudiant->resultatsAcademiques()
            ->selectRaw('YEAR(created_at) as annee')
            ->distinct()
            ->pluck('annee')
            ->toArray();
        
        // Si aucune année n'est disponible, utiliser l'année en cours
        if (empty($annees)) {
            $annees = [date('Y')];
        }
        
        // Trier les années en ordre décroissant (la plus récente en premier)
        rsort($annees);
        
        return $annees;
    }
    
    /**
     * Calculer les statistiques globales pour un étudiant.
     */
    private function calculerStatistiquesGlobales(Etudiant $etudiant)
    {
        $resultats = $etudiant->resultatsAcademiques;
        
        // Si aucun résultat n'est disponible, retourner des statistiques vides
        if ($resultats->isEmpty()) {
            return [
                'meilleurNote' => null,
                'pireNote' => null,
                'moyenneGenerale' => null,
                'tauxReussite' => 0,
                'nombreModulesValides' => 0,
                'nombreModulesTotal' => 0,
                'distributionNotes' => [
                    '0-5' => 0,
                    '5-10' => 0,
                    '10-12' => 0,
                    '12-14' => 0,
                    '14-16' => 0,
                    '16-20' => 0,
                ]
            ];
        }
        
        // Calculer les statistiques de base
        $meilleurNote = $resultats->max('note');
        $pireNote = $resultats->min('note');
        
        $totalPondere = 0;
        $totalCoefficients = 0;
        $modulesValides = 0;
        $distributionNotes = [
            '0-5' => 0,
            '5-10' => 0,
            '10-12' => 0,
            '12-14' => 0,
            '14-16' => 0,
            '16-20' => 0,
        ];
        
        foreach ($resultats as $resultat) {
            if ($resultat->note !== null) {
                $totalPondere += $resultat->note * $resultat->coefficient;
                $totalCoefficients += $resultat->coefficient;
                
                // Compter les modules validés
                if ($resultat->estValide()) {
                    $modulesValides++;
                }
                
                // Distribuer les notes par catégorie
                if ($resultat->note < 5) {
                    $distributionNotes['0-5']++;
                } elseif ($resultat->note < 10) {
                    $distributionNotes['5-10']++;
                } elseif ($resultat->note < 12) {
                    $distributionNotes['10-12']++;
                } elseif ($resultat->note < 14) {
                    $distributionNotes['12-14']++;
                } elseif ($resultat->note < 16) {
                    $distributionNotes['14-16']++;
                } else {
                    $distributionNotes['16-20']++;
                }
            }
        }
        
        $moyenneGenerale = $totalCoefficients > 0 ? $totalPondere / $totalCoefficients : null;
        $tauxReussite = $resultats->count() > 0 ? ($modulesValides / $resultats->count()) * 100 : 0;
        
        return [
            'meilleurNote' => $meilleurNote,
            'pireNote' => $pireNote,
            'moyenneGenerale' => $moyenneGenerale,
            'tauxReussite' => $tauxReussite,
            'nombreModulesValides' => $modulesValides,
            'nombreModulesTotal' => $resultats->count(),
            'distributionNotes' => $distributionNotes
        ];
    }
}
