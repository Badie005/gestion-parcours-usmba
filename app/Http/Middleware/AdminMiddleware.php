<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Liste des emails administrateurs (vous pouvez modifier cette liste)
        $admin_emails = [
            'admin@example.com',
            'marie.dupont@example.com', // Ajoutez ici les emails des utilisateurs que vous souhaitez comme admin
        ];
        
        // Vérifier si l'utilisateur est administrateur
        if (!in_array(Auth::user()->email, $admin_emails)) {
            // Rediriger vers la page d'accueil avec un message
            return redirect()->route('dashboard')
                ->with('error', 'Vous n\'avez pas les droits d\'accès à cette section.');
        }
        
        return $next($request);
    }
}
