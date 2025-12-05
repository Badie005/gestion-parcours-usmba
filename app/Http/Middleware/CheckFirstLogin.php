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
     * En mode démo/portfolio, cette vérification est complètement désactivée
     * pour permettre aux visiteurs de naviguer librement sans être forcés
     * de changer le mot de passe.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // MODE DEMO : Bypass complet du changement de mot de passe
        // Cette application est utilisée en mode démo pour un portfolio
        // Les visiteurs doivent pouvoir naviguer sans restriction
        return $next($request);

        // Code original désactivé pour le mode démo :
        /*
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->password_changed === null || $user->password_changed === 0) {
                if (!$request->routeIs('password.first')) {
                    return redirect()->route('password.first');
                }
            }
        }

        return $next($request);
        */
    }
}
