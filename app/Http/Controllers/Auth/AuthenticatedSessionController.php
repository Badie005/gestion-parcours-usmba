<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Etudiant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Enregistrer l'action de connexion dans l'historique
        /** @var Etudiant $user */
        $user = Auth::user();
        if ($user) {
            // Vérifier si c'est la première connexion
            $isFirstLogin = ($user->password_changed === null || $user->password_changed === 0);
            
            // Enregistrer l'action dans l'historique
            $user->enregistrerAction(
                $isFirstLogin ? 'first_login' : 'login',
                $isFirstLogin ? 'Première connexion au système' : 'Connexion au système',
                ['ip' => $request->ip()]
            );
            
            // Si c'est la première connexion, rediriger vers la page de changement de mot de passe
            if ($isFirstLogin) {
                return redirect()->route('password.first');
            }
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
