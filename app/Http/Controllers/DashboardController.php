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
        
        // Récupérer l'historique des actions de l'étudiant connecté (basé sur Num_Inscription), triées par date décroissante
        $historique = ActionHistorique::where('id_etudiant', $etudiant->Num_Inscription)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
            
        // Vérifier si l'étudiant a un parcours confirmé
        $hasParcours = $etudiant->id_parcour && $etudiant->choix_confirme;
        
        // Si le profil n'est pas complet, préparer une notification
        if (!$profileValidation['isComplete']) {
            $missingFieldsText = implode(', ', $profileValidation['missingFields']);
            session()->flash('warning', 
                'Votre profil est incomplet. Veuillez compléter les informations suivantes : <strong>' . $missingFieldsText . '</strong>. ' .  
                '<a href="' . route('profile.edit') . '" class="underline font-semibold text-blue-600">Compléter mon profil</a>'
            );
        }
        
        // Si la filière de l'étudiant autorise le choix de parcours mais qu'il ne l'a pas encore fait
        $canChooseParcours = $etudiant->filiere?->choix_parcour_autorise ?? false;
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
