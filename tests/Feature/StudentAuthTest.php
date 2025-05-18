<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Etudiant;

class StudentAuthTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test qu'un étudiant peut se connecter avec des identifiants valides.
     */
    public function test_student_can_login_with_valid_credentials(): void
    {
        // Création d'un étudiant pour le test
        $etudiant = Etudiant::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Tentative de connexion
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // Vérification que l'utilisateur est redirigé vers le dashboard après connexion
        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }

    /**
     * Test qu'un étudiant ne peut pas se connecter avec des identifiants invalides.
     */
    public function test_student_cannot_login_with_invalid_credentials(): void
    {
        // Création d'un étudiant pour le test
        $etudiant = Etudiant::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Tentative de connexion avec un mauvais mot de passe
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrong_password',
        ]);

        // Vérification que l'utilisateur n'est pas authentifié et reste sur la page de login
        $this->assertGuest();
    }

    /**
     * Test qu'un étudiant peut se déconnecter.
     */
    public function test_student_can_logout(): void
    {
        // Création et authentification d'un étudiant
        $etudiant = Etudiant::factory()->create();
        $this->actingAs($etudiant);

        // Vérification que l'utilisateur est bien authentifié
        $this->assertAuthenticated();

        // Déconnexion
        $response = $this->post('/logout');

        // Vérification que l'utilisateur est déconnecté et redirigé
        $this->assertGuest();
    }

    /**
     * Test qu'un utilisateur non authentifié est redirigé vers la page de login.
     */
    public function test_unauthenticated_user_is_redirected_to_login(): void
    {
        // Tentative d'accès au dashboard sans être connecté
        $response = $this->get('/dashboard');

        // Vérification de la redirection vers la page de login
        $response->assertRedirect('/login');
    }
}
