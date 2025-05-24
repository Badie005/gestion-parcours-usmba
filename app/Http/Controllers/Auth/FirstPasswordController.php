<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class FirstPasswordController extends Controller
{
    /**
     * Affiche le formulaire de changement de premier mot de passe
     */
    public function show()
    {
        return view('auth.first-password');
    }

    /**
     * Met à jour le mot de passe lors de la première connexion
     */
    public function update(Request $request)
    {
        $messages = [
            'current_password.required' => 'Le mot de passe actuel est requis.',
            'current_password.current_password' => 'Le mot de passe actuel est incorrect.',
            'password.required' => 'Le nouveau mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ];
        
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $messages);

        $user = Auth::user();
        
        // Mettre à jour le mot de passe
        $user->update([
            'password' => Hash::make($validated['password']),
            'password_changed' => 1,
        ]);

        // Créer une entrée dans l'historique des actions
        $user->enregistrerAction(
            'password_change',
            'Changement du mot de passe initial',
            ['first_login' => true]
        );

        return redirect()->route('dashboard')->with('status', 'password-updated');
    }
}
