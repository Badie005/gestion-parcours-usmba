<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Récupère la liste des filières pour le formulaire d'inscription
        $filieres = Filiere::all();
        return view('auth.register', compact('filieres'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom_fr' => ['required', 'string', 'max:50'],
            'prenom_fr' => ['required', 'string', 'max:50'],
            'email_academique' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:etudiant,email_academique'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'date_naissance' => ['required', 'string', 'max:50'],
            'adresse' => ['required', 'string'],
            'telephone' => ['required', 'string', 'max:20'],
            'code_deug' => ['required', 'exists:filiere,code_deug'],
        ]);

        // Récupérer la filière choisie
        $filiere = Filiere::findOrFail($request->code_deug);
        
        // Déterminer le parcours par défaut si la filière n'autorise pas le choix
        $code_licence = null;
        if (!$filiere->choix_parcour_autorise) {
            $parcourDefaut = $filiere->getParcoursDefaut();
            if ($parcourDefaut) {
                $code_licence = $parcourDefaut->code_licence;
            }
        }
        
        $etudiant = Etudiant::create([
            'nom_fr' => $request->nom_fr,
            'prenom_fr' => $request->prenom_fr,
            'email_academique' => $request->email_academique,
            'password' => Hash::make($request->password),
            'date_naissance' => $request->date_naissance,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'code_deug' => $request->code_deug,
            'code_licence' => $code_licence,
            'choix_confirme' => !$filiere->choix_parcour_autorise,
            'date_choix' => !$filiere->choix_parcour_autorise ? now() : null,
        ]);

        event(new Registered($etudiant));

        Auth::login($etudiant);

        return redirect(route('dashboard', absolute: false));
    }
}
