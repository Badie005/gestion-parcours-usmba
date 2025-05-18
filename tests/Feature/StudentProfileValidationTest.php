<?php

namespace Tests\Feature;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Traits\ProfileValidationTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentProfileValidationTest extends TestCase
{
    use RefreshDatabase;
    use ProfileValidationTrait; // Utilisation du trait de validation de profil
    
    /**
     * Test qu'un profil incomplet est correctement détecté.
     */
    public function test_incomplete_profile_is_detected(): void
    {
        // Création d'un étudiant avec un profil incomplet
        $etudiant = Etudiant::factory()->create([
            'nom' => 'Dupont',
            'prenom' => null,
            'date_naissance' => null,
            'telephone' => null,
            'adresse' => null
        ]);
        
        // Validation du profil
        $result = $this->validateStudentProfile($etudiant);
        
        // Vérification que le profil est détecté comme incomplet
        $this->assertFalse($result['isComplete']);
        $this->assertContains('prénom', $result['missingFields']);
        $this->assertContains('date de naissance', $result['missingFields']);
        $this->assertContains('téléphone', $result['missingFields']);
        $this->assertContains('adresse', $result['missingFields']);
    }
    
    /**
     * Test qu'un profil complet est correctement détecté.
     */
    public function test_complete_profile_is_validated(): void
    {
        // Création d'un étudiant avec un profil complet
        $etudiant = Etudiant::factory()->withCompleteProfile()->create([
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'date_naissance' => '1995-05-15',
            'telephone' => '0612345678',
            'adresse' => '123 rue des Étudiants, Paris'
        ]);
        
        // Validation du profil
        $result = $this->validateStudentProfile($etudiant);
        
        // Vérification que le profil est détecté comme complet
        $this->assertTrue($result['isComplete']);
        $this->assertEmpty($result['missingFields']);
    }
    
    /**
     * Test que la validation du profil est vérifiée lors de l'accès au dashboard.
     */
    public function test_profile_validation_is_checked_on_dashboard(): void
    {
        // Création d'un étudiant avec un profil incomplet
        $etudiant = Etudiant::factory()->create([
            'nom' => 'Martin',
            'prenom' => 'Sophie',
            'date_naissance' => null,
            'telephone' => null,
            'adresse' => null
        ]);
        
        // Authentification de l'étudiant
        $this->actingAs($etudiant);
        
        // Accès au dashboard
        $response = $this->get('/dashboard');
        
        // Vérification que la page s'affiche correctement
        $response->assertStatus(200);
        
        // Vérification qu'une notification est affichée concernant le profil incomplet
        $response->assertSessionHas('warning');
    }
    
    /**
     * Test que les champs requis sont validés lors de la mise à jour du profil.
     */
    public function test_required_fields_are_validated_on_profile_update(): void
    {
        // Création d'un étudiant
        $etudiant = Etudiant::factory()->create();
        
        // Authentification de l'étudiant
        $this->actingAs($etudiant);
        
        // Tentative de mise à jour avec des champs manquants
        $response = $this->post('/profil', [
            'nom' => 'Nouveau Nom',
            // Prénom manquant
            'date_naissance' => '', // Date vide
            'telephone' => 'invalid', // Format invalide
            'adresse' => 'Nouvelle adresse'
        ]);
        
        // Vérification que la validation a échoué
        $response->assertSessionHasErrors(['prenom', 'date_naissance', 'telephone']);
    }
    
    /**
     * Test qu'une mise à jour valide du profil fonctionne correctement.
     */
    public function test_valid_profile_update_works(): void
    {
        // Création d'un étudiant
        $etudiant = Etudiant::factory()->create();
        
        // Authentification de l'étudiant
        $this->actingAs($etudiant);
        
        // Données de mise à jour valides
        $updateData = [
            'nom' => 'Dubois',
            'prenom' => 'Marie',
            'date_naissance' => '1997-10-25',
            'telephone' => '0687654321',
            'adresse' => '45 boulevard des Sciences, Lyon'
        ];
        
        // Mise à jour du profil
        $response = $this->post('/profil', $updateData);
        
        // Vérification que la mise à jour a réussi
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/dashboard');
        
        // Vérification que les données ont bien été mises à jour en base
        $this->assertDatabaseHas('etudiant', array_merge(
            ['id_etudiant' => $etudiant->id_etudiant],
            $updateData
        ));
    }
}
