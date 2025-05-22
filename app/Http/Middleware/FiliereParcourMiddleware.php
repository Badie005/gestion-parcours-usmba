<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FiliereParcourMiddleware
{
    /**
     * Handle an incoming request.
     * Vérifie si l'étudiant a une filière assignée et s'il essaie d'accéder à un parcours
     * qui n'est pas dans sa filière.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $etudiant = Auth::user();
        
        // Vérifier si l'étudiant a une filière assignée
        if (!$etudiant || !$etudiant->id_filiere) {
            // Rediriger vers une page d'erreur ou de complétion de profil
            return redirect()->route('profile.edit')
                ->with('error', 'Vous devez avoir une filière assignée pour accéder à cette page. Veuillez compléter votre profil.');
        }
        
        // Vérifier le nombre de modules validés (minimum 18)
        $totalModules = ($etudiant->nb_val_ac_s1 ?? 0) + ($etudiant->nb_val_ac_s2 ?? 0) + 
                       ($etudiant->nb_val_ac_s3 ?? 0) + ($etudiant->nb_val_ac_s4 ?? 0);
        
        if ($totalModules < 18) {
            $modulesManquants = 18 - $totalModules;
            return redirect()->route('profile.edit')
                ->with('warning', "Vous n'êtes pas actuellement éligible pour sélectionner un parcours. "
                    . "Pour devenir éligible, vous devez valider {$modulesManquants} module(s) supplémentaire(s) "
                    . "pour atteindre le seuil minimal requis de 18 modules.");
        }
        
        // Vérifier si l'étudiant essaie d'accéder à un parcours spécifique
        $parcourId = $request->route('code_licence');
        if ($parcourId) {
            // Récupérer le parcours demandé
            $parcour = \App\Models\Parcour::find($parcourId);
            
            // Vérifier si le parcours existe et appartient à la filière de l'étudiant
            // Récupérer le code_deug de la filière de l'étudiant
            $codeDeugEtudiant = $etudiant->filiere ? $etudiant->filiere->Code_DEUG : null;
            
            // Utiliser id_filiere sur le modèle Parcour pour la comparaison
            if (!$parcour || $parcour->id_filiere != $etudiant->id_filiere) {
                return redirect()->route('parcours.index')
                    ->with('error', 'Vous ne pouvez pas accéder à un parcours qui n\'est pas dans votre filière.');
            }
        }
        
        return $next($request);
    }
}
