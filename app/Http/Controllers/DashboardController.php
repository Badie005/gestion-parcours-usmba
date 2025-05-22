<?php

namespace App\Http\Controllers;

use App\Models\ActionHistorique;
use App\Traits\ProfileValidationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    use ProfileValidationTrait;
    /**
     * Affiche le tableau de bord avec l'historique des actions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $etudiant = Auth::user();
        
        // Vérifier si le profil est complet
        $profileValidation = $this->validateStudentProfile($etudiant);
        
        // Récupérer l'historique des actions de l'étudiant connecté (basé sur num_inscription), triées par date décroissante
        $etudiantId = $etudiant->num_inscription;
        $historique = [];
        
        // Vérifier que l'ID de l'étudiant existe avant d'exécuter la requête
        if ($etudiantId) {
            $historique = ActionHistorique::where('etudiant_id', $etudiantId)
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
        }
            
        // Vérifier si l'étudiant a un parcours confirmé
        $hasParcours = !empty($etudiant->parcour_id) && $etudiant->choix_confirme;
        
        // Les étudiants n'ont plus le droit de modifier leurs informations après connexion
        // Nous ne montrons plus la notification de profil incomplet
        
        // Vérifier si l'étudiant a une filière assignée
        $filiere = null;
        if (!empty($etudiant->filiere_id)) {
            $filiere = \App\Models\Filiere::find($etudiant->filiere_id);
        }
        
        // Si la filière de l'étudiant autorise le choix de parcours mais qu'il ne l'a pas encore fait
        $canChooseParcours = $filiere && ($filiere->choix_parcour_autorise ?? false);
        if ($canChooseParcours && !$hasParcours) {
            session()->flash('info', 
                'Vous n\'avez pas encore choisi votre parcours. ' . 
                '<a href="' . route('parcours.index') . '" class="underline font-semibold text-blue-600">Choisir mon parcours</a>'
            );
        }
        
        return view('dashboard', [
            'etudiant' => $etudiant,
            'historique' => $historique,
            'profileComplete' => $profileValidation['isComplete'],
            'hasParcours' => $hasParcours
        ]);
    }
}
