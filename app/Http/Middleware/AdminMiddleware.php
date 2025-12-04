<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Liste des rôles autorisés à accéder à la section admin.
     */
    private const ADMIN_ROLES = ['admin', 'super_admin', 'administrator'];

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

        $user = Auth::user();

        // Vérifier si l'utilisateur a un rôle admin
        // Option 1: Vérification par le champ 'role' dans la table etudiants
        if (isset($user->role) && in_array($user->role, self::ADMIN_ROLES)) {
            return $next($request);
        }

        // Option 2: Vérification par email (liste configurable via .env ou config)
        $adminEmails = $this->getAdminEmails();
        if (in_array($user->email_academique ?? $user->email, $adminEmails)) {
            return $next($request);
        }

        // Rediriger vers la page d'accueil avec un message
        return redirect()->route('dashboard')
            ->with('error', 'Vous n\'avez pas les droits d\'accès à cette section.');
    }

    /**
     * Récupérer la liste des emails administrateurs depuis la configuration.
     * 
     * @return array
     */
    private function getAdminEmails(): array
    {
        // Récupérer depuis la config ou .env
        // Format dans .env: ADMIN_EMAILS="admin@usmba.ac.ma,directeur@usmba.ac.ma"
        $envEmails = env('ADMIN_EMAILS', '');
        
        if (empty($envEmails)) {
            return [];
        }

        return array_map('trim', explode(',', $envEmails));
    }
}
