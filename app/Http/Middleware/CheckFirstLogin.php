<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckFirstLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est connecté
        if (Auth::check()) {
            $user = Auth::user();
            
            // Vérifier si c'est la première connexion (password non modifié)
            if ($user->password_changed === null || $user->password_changed === 0) {
                // Si l'utilisateur n'est pas déjà sur la page de changement de mot de passe
                if (!$request->routeIs('password.first')) {
                    return redirect()->route('password.first');
                }
            }
        }

        return $next($request);
    }
}
