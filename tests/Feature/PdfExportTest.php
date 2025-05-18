<?php

namespace Tests\Feature;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Parcour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PdfExportTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test qu'un étudiant avec un parcours confirmé peut générer un PDF.
     */
    public function test_student_with_confirmed_choice_can_generate_pdf(): void
    {
        // Création d'une filière et d'un parcours
        $filiere = Filiere::factory()->create(['nom_filiere' => 'Informatique']);
        $parcours = Parcour::factory()->forFiliere($filiere)->create(['nom_parcour' => 'Développement Web']);
        
        // Création d'un étudiant avec un profil complet et un parcours confirmé
        $etudiant = Etudiant::factory()->withCompleteProfile()->create([
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'date_naissance' => '1995-05-15',
            'adresse' => '123 rue des Étudiants, Paris',
            'telephone' => '0612345678',
            'id_filiere' => $filiere->id_filiere,
            'id_parcour' => $parcours->id_parcour,
            'choix_confirme' => true,
            'date_choix' => now()->subDays(5)
        ]);
        
        // Authentification de l'étudiant
        $this->actingAs($etudiant);
        
        // Accès à la route de génération du PDF
        $response = $this->get('/parcours/pdf');
        
        // Vérification que la réponse est bien un PDF
        $response->assertOk();
        $this->assertEquals('application/pdf', $response->headers->get('Content-Type'));
    }
    
    /**
     * Test qu'un étudiant sans parcours confirmé ne peut pas générer un PDF.
     */
    public function test_student_without_confirmed_choice_cannot_generate_pdf(): void
    {
        // Création d'une filière et d'un parcours
        $filiere = Filiere::factory()->withChoixAutorise()->create();
        $parcours = Parcour::factory()->forFiliere($filiere)->create();
        
        // Création d'un étudiant sans choix confirmé
        $etudiant = Etudiant::factory()->create([
            'id_filiere' => $filiere->id_filiere,
            'id_parcour' => $parcours->id_parcour,
            'choix_confirme' => false
        ]);
        
        // Authentification de l'étudiant
        $this->actingAs($etudiant);
        
        // Tentative d'accès à la route de génération du PDF
        $response = $this->get('/parcours/pdf');
        
        // Vérification que la tentative est refusée
        $response->assertStatus(403);
    }
    
    /**
     * Test qu'un étudiant sans aucun parcours choisi ne peut pas générer un PDF.
     */
    public function test_student_without_parcours_cannot_generate_pdf(): void
    {
        // Création d'une filière
        $filiere = Filiere::factory()->withChoixAutorise()->create();
        
        // Création d'un étudiant sans parcours attribué
        $etudiant = Etudiant::factory()->create([
            'id_filiere' => $filiere->id_filiere,
            'id_parcour' => null,
            'choix_confirme' => false
        ]);
        
        // Authentification de l'étudiant
        $this->actingAs($etudiant);
        
        // Tentative d'accès à la route de génération du PDF
        $response = $this->get('/parcours/pdf');
        
        // Vérification que la tentative est refusée
        $response->assertStatus(403);
    }
    
    /**
     * Test pour vérifier que le PDF contient toutes les informations nécessaires.
     * 
     * Note: Cette méthode ne vérifie pas vraiment le contenu du PDF car cela nécessiterait 
     * d'analyser le contenu binéaire du PDF, ce qui est complexe dans un test unitaire.
     * 
     * Dans un environnement réel, vous pourriez utiliser une bibliothèque comme pdf-parser pour 
     * extraire le texte du PDF et vérifier qu'il contient les informations attendues.
     */
    public function test_pdf_contains_all_necessary_information(): void
    {
        // Création d'une filière et d'un parcours
        $filiere = Filiere::factory()->create(['nom_filiere' => 'Informatique']);
        $parcours = Parcour::factory()->forFiliere($filiere)->create([
            'nom_parcour' => 'Développement Web',
            'description' => 'Parcours orienté vers le développement d\'applications web.'
        ]);
        
        // Création d'un étudiant avec un profil complet et un parcours confirmé
        $etudiant = Etudiant::factory()->withCompleteProfile()->create([
            'nom' => 'Martin',
            'prenom' => 'Sophie',
            'date_naissance' => '1998-09-23',
            'adresse' => '45 avenue des Sciences, Lyon',
            'telephone' => '0687654321',
            'id_filiere' => $filiere->id_filiere,
            'id_parcour' => $parcours->id_parcour,
            'choix_confirme' => true,
            'date_choix' => now()->subDays(3)
        ]);
        
        // Authentification de l'étudiant
        $this->actingAs($etudiant);
        
        // Accès à la route de visualisation de la confirmation avant génération du PDF
        $response = $this->get('/parcours/confirmation');
        
        // Vérification que la page contient toutes les informations nécessaires
        $response->assertSee($etudiant->nom);
        $response->assertSee($etudiant->prenom);
        $response->assertSee($filiere->nom_filiere);
        $response->assertSee($parcours->nom_parcour);
        
        // Accès à la route de génération du PDF
        $pdfResponse = $this->get('/parcours/pdf');
        
        // Vérification que le PDF est généré correctement
        $pdfResponse->assertOk();
        $this->assertEquals('application/pdf', $pdfResponse->headers->get('Content-Type'));
    }
}
