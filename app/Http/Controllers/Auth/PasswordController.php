<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $messages = [
            'current_password.required' => 'Le mot de passe actuel est requis.',
            'current_password.current_password' => 'Le mot de passe actuel est incorrect.',
            'password.required' => 'Le nouveau mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ];
        
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $messages);

        $user = $request->user();
        
        // Mettre à jour le mot de passe
        $user->update([
            'password' => Hash::make($validated['password']),
            'password_changed' => 1,
        ]);
        
        // Enregistrer l'action dans l'historique
        if (method_exists($user, 'enregistrerAction')) {
            $user->enregistrerAction(
                'password_change',
                'Changement de mot de passe',
                null
            );
        }

        return back()->with('status', 'password-updated');
    }
}
