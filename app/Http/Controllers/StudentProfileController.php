<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Http\Requests\StudentProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{
    /**
     * Constructeur qui applique le middleware d'authentification.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Met à jour les informations spécifiques de l'étudiant.
     *
     * @param  \App\Http\Requests\StudentProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StudentProfileUpdateRequest $request)
    {
        // La validation est déjà gérée par StudentProfileUpdateRequest

        try {
            // Récupération de l'étudiant connecté
            $etudiant = Auth::user();
            
            // Mise à jour des données de l'étudiant
            $etudiant->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'date_naissance' => $request->date_naissance,
                'telephone' => $request->telephone,
                'adresse' => $request->adresse,
            ]);
            
            // Enregistrement de l'action dans l'historique si cette fonctionnalité existe
            if (method_exists($etudiant, 'enregistrerAction')) {
                $etudiant->enregistrerAction(
                    'profil_maj',
                    'Mise à jour des informations du profil',
                    null
                );
            }
            
            return back()->with('status', 'student-info-updated')->with('success', 'Vos informations personnelles ont été mises à jour avec succès.');
            
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Une erreur est survenue lors de la mise à jour de vos informations : ' . $e->getMessage())
                ->withInput();
        }
    }
}
