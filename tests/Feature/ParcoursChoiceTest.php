<?php

namespace Tests\Feature;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Parcour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParcoursChoiceTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test qu'un étudiant peut voir la liste des parcours pour sa filière si celle-ci autorise le choix.
     */
    public function test_student_can_view_parcours_list_when_allowed(): void
    {
        // Création d'une filière avec choix autorisé
        $filiere = Filiere::factory()->withChoixAutorise()->create();
        
        // Création de parcours pour cette filière
        $parcours = Parcour::factory()->count(3)->forFiliere($filiere)->create();
        
        // Création d'un étudiant dans cette filière
        $etudiant = Etudiant::factory()->create([
            'id_filiere' => $filiere->id_filiere,
            'id_parcour' => null,
            'choix_confirme' => false
        ]);
        
        // Authentification de l'étudiant
        $this->actingAs($etudiant);
        
        // Accès à la page de sélection des parcours
        $response = $this->get('/parcours');
        
        // Vérification que la page s'affiche correctement
        $response->assertStatus(200);
        
        // Vérification que tous les parcours de la filière sont présents
        foreach ($parcours as $parcour) {
            $response->assertSee($parcour->nom_parcour);
        }
    }
    
    /**
     * Test qu'un étudiant peut sélectionner un parcours pour sa filière si celle-ci autorise le choix.
     */
    public function test_student_can_choose_parcours_when_allowed(): void
    {
        // Création d'une filière avec choix autorisé
        $filiere = Filiere::factory()->withChoixAutorise()->create();
        
        // Création de parcours pour cette filière
        $parcours = Parcour::factory()->count(3)->forFiliere($filiere)->create();
        $selectedParcour = $parcours->first();
        
        // Création d'un étudiant dans cette filière
        $etudiant = Etudiant::factory()->create([
            'id_filiere' => $filiere->id_filiere,
            'id_parcour' => null,
            'choix_confirme' => false
        ]);
        
        // Authentification de l'étudiant
        $this->actingAs($etudiant);
        
        // Sélection d'un parcours
        $response = $this->post('/parcours', [
            'parcours_id' => $selectedParcour->id_parcour
        ]);
        
        // Vérification de la redirection vers la page de confirmation
        $response->assertRedirect('/parcours/confirmation');
        
        // Vérification que l'étudiant a bien été associé au parcours choisi
        $this->assertDatabaseHas('etudiant', [
            'id_etudiant' => $etudiant->id_etudiant,
            'id_parcour' => $selectedParcour->id_parcour,
            'choix_confirme' => true
        ]);
    }
    
    /**
     * Test qu'un étudiant ne peut pas sélectionner un parcours si sa filière n'autorise pas le choix.
     */
    public function test_student_cannot_choose_parcours_when_not_allowed(): void
    {
        // Création d'une filière sans choix autorisé
        $filiere = Filiere::factory()->withoutChoixAutorise()->create();
        
        // Création de parcours pour cette filière
        $parcourDefaut = Parcour::factory()->forFiliere($filiere)->asDefault()->create();
        $autreParcour = Parcour::factory()->forFiliere($filiere)->create();
        
        // Création d'un étudiant dans cette filière
        $etudiant = Etudiant::factory()->create([
            'id_filiere' => $filiere->id_filiere,
            'id_parcour' => $parcourDefaut->id_parcour, // Déjà associé au parcours par défaut
            'choix_confirme' => true
        ]);
        
        // Authentification de l'étudiant
        $this->actingAs($etudiant);
        
        // Tentative d'accès à la page de sélection des parcours
        $response = $this->get('/parcours');
        
        // Vérification que l'étudiant est redirigé car il ne peut pas choisir de parcours
        $response->assertStatus(302);
        
        // Tentative de sélection d'un autre parcours
        $response = $this->post('/parcours', [
            'parcours_id' => $autreParcour->id_parcour
        ]);
        
        // Vérification que la tentative est refusée
        $response->assertStatus(403);
        
        // Vérification que l'étudiant est toujours associé au parcours par défaut
        $this->assertDatabaseHas('etudiant', [
            'id_etudiant' => $etudiant->id_etudiant,
            'id_parcour' => $parcourDefaut->id_parcour
        ]);
    }
    
    /**
     * Test que le parcours par défaut est attribué automatiquement pour les filières sans choix autorisé.
     */
    public function test_default_parcours_is_assigned_when_choice_not_allowed(): void
    {
        // Création d'une filière sans choix autorisé
        $filiere = Filiere::factory()->withoutChoixAutorise()->create();
        
        // Création d'un parcours par défaut pour cette filière
        $parcourDefaut = Parcour::factory()->forFiliere($filiere)->asDefault()->create();
        
        // Création d'un étudiant dans cette filière sans parcours attribué initialement
        $etudiant = Etudiant::factory()->create([
            'id_filiere' => $filiere->id_filiere,
            'id_parcour' => null,
            'choix_confirme' => false
        ]);
        
        // Authentification de l'étudiant
        $this->actingAs($etudiant);
        
        // Accès au dashboard pour déclencher l'attribution du parcours par défaut
        $response = $this->get('/dashboard');
        
        // Vérification que l'étudiant est associé au parcours par défaut
        $etudiant->refresh();
        $this->assertEquals($parcourDefaut->id_parcour, $etudiant->id_parcour);
        $this->assertTrue($etudiant->choix_confirme);
    }
    
    /**
     * Test qu'un étudiant ne peut pas choisir un parcours d'une autre filière.
     */
    public function test_student_cannot_choose_parcours_from_another_filiere(): void
    {
        // Création d'une filière avec choix autorisé
        $filiere1 = Filiere::factory()->withChoixAutorise()->create(['nom_filiere' => 'Informatique']);
        $filiere2 = Filiere::factory()->withChoixAutorise()->create(['nom_filiere' => 'Mathématiques']);
        
        // Création de parcours pour ces filières
        $parcourFiliere1 = Parcour::factory()->forFiliere($filiere1)->create();
        $parcourFiliere2 = Parcour::factory()->forFiliere($filiere2)->create();
        
        // Création d'un étudiant dans la première filière
        $etudiant = Etudiant::factory()->create([
            'id_filiere' => $filiere1->id_filiere,
            'id_parcour' => null,
            'choix_confirme' => false
        ]);
        
        // Authentification de l'étudiant
        $this->actingAs($etudiant);
        
        // Tentative de sélection d'un parcours d'une autre filière
        $response = $this->post('/parcours', [
            'parcours_id' => $parcourFiliere2->id_parcour
        ]);
        
        // Vérification que la tentative est refusée
        $response->assertStatus(403);
        
        // Vérification que l'étudiant n'a pas de parcours attribué
        $this->assertDatabaseHas('etudiant', [
            'id_etudiant' => $etudiant->id_etudiant,
            'id_parcour' => null
        ]);
    }
}
