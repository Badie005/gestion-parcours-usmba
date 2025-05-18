<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Parcour;
use App\Models\Filiere;
use App\Http\Requests\ParcourChoixRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Validation\ValidationException;
use Illuminate\Routing\Controller;
use Carbon\Carbon;

class ParcourController extends Controller
{
    /**
     * Constructeur qui applique le middleware d'authentification.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche la page de choix de parcours.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupérer l'étudiant connecté
        $etudiant = Auth::user();
        $filiere = $etudiant->filiere;
        
        // Vérifier si l'étudiant a déjà confirmé son choix
        if ($etudiant->choix_confirme) {
            return redirect()->route('parcours.confirmation');
        }
        
        // Récupérer les parcours disponibles pour la filière de l'étudiant
        $parcours = Parcour::where('id_filiere', $filiere->Code_DEUG)->get();
        
        // Vérifier si l'étudiant peut choisir son parcours
        // Utilisation d'une vérification simplifiée pour éviter les erreurs de lint
        $peutChoisir = $filiere->choix_parcour_autorise ?? false;
        
        // Si l'étudiant ne peut pas choisir, afficher le parcours par défaut
        if (!$peutChoisir) {
            $parcourDefaut = $filiere->getParcoursDefaut();
            
            // Vérifier si un parcours par défaut existe
            if (!$parcourDefaut) {
                // Aucun parcours par défaut trouvé, afficher un message d'erreur approprié
                return view('parcours.index', [
                    'etudiant' => $etudiant,
                    'filiere' => $filiere,
                    'parcours' => $parcours,
                    'peutChoisir' => false,
                    'parcourDefaut' => null,
                    'erreurParcourDefaut' => true
                ]);
            }
            
            // Assigner automatiquement le parcours par défaut si ce n'est pas déjà fait
            if (!$etudiant->id_parcour) {
                // Utiliser l'update statique pour éviter les erreurs de méthode manquante
                \App\Models\Etudiant::where('Num_Inscription', $etudiant->Num_Inscription)
                    ->update([
                        'id_parcour' => $parcourDefaut->Code_Licence,
                        'choix_confirme' => true,
                        'date_choix' => now()
                    ]);
                    
                // Rafraîchir l'instance de l'étudiant
                $etudiant = \App\Models\Etudiant::find($etudiant->Num_Inscription);
                
                $message = 'Votre choix de parcours <strong>' . $parcourDefaut->Licence_Intitule_Fr . '</strong> a été enregistré avec succès.';
                
                return redirect()->route('parcours.confirmation')
                    ->with('success', $message);
            }
            
            return view('parcours.index', [
                'etudiant' => $etudiant,
                'filiere' => $filiere,
                'parcours' => $parcours,
                'peutChoisir' => false,
                'parcourDefaut' => $parcourDefaut,
                'erreurParcourDefaut' => false
            ]);
        }
        
        // Si l'étudiant peut choisir, afficher le formulaire de choix
        return view('parcours.index', [
            'etudiant' => $etudiant,
            'filiere' => $filiere,
            'parcours' => $parcours,
            'peutChoisir' => true,
            'parcourSelectionne' => $etudiant->id_parcour ? $etudiant->parcour : null,
        ]);
    }
    
    /**
     * Traite le formulaire de choix de parcours.
     * Utilise la classe ParcourChoixRequest pour une validation sécurisée
     *
     * @param  \App\Http\Requests\ParcourChoixRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function choisir(ParcourChoixRequest $request)
    {
        try {
            // Récupérer l'étudiant connecté
            $etudiant = Auth::user();
            
            // La validation est déjà gérée par ParcourChoixRequest
            // y compris la vérification que le parcours appartient à la filière de l'étudiant
            // et que l'étudiant est autorisé à choisir un parcours
            
            // Récupérer le parcours validé
            $parcour = Parcour::findOrFail($request->code_licence);
            
            // Mesure de sécurité supplémentaire - double vérification
            if ($parcour->id_filiere !== $etudiant->id_filiere) {
                throw ValidationException::withMessages([
                    'code_licence' => ['Le parcours sélectionné n\'appartient pas à votre filière.']
                ]);
            }
            
            // Vérifier si l'étudiant a déjà un choix confirmé
            if ($etudiant->choix_confirme) {
                throw ValidationException::withMessages([
                    'general' => ['Vous avez déjà confirmé votre choix de parcours.']
                ]);
            }
            
            // Enregistrer le choix de l'étudiant dans une transaction pour garantir l'intégrité des données
            \Illuminate\Support\Facades\DB::beginTransaction();
            
            try {
                // Mettre à jour l'étudiant avec une requête statique
                \App\Models\Etudiant::where('Num_Inscription', $etudiant->Num_Inscription)
                    ->update([
                        'id_parcour' => $parcour->Code_Licence,
                        'choix_confirme' => $request->has('confirmer'),
                        'date_choix' => now()
                    ]);
                    
                // Rafraîchir l'instance de l'étudiant
                $etudiant = \App\Models\Etudiant::find($etudiant->Num_Inscription);
                
                // Obtenir le nom de la filière et du parcours pour le message
                $nomFiliere = $etudiant->filiere->deug_intitule_fr;
                $nomParcour = $parcour->Licence_Intitule_Fr;
                
                // Enregistrer l'action dans l'historique via le modèle
                if (method_exists($etudiant, 'enregistrerAction')) {
                    $etudiant->enregistrerAction(
                        'parcours_selection',
                        'Sélection du parcours ' . $nomParcour,
                        [
                            'id_parcour' => $parcour->Code_Licence,
                            'nom_parcour' => $nomParcour,
                            'confirme' => $etudiant->choix_confirme,
                        ]
                    );
                    
                    // Si l'étudiant a confirmé son choix, enregistrer également cette action
                    if ($etudiant->choix_confirme) {
                        $etudiant->enregistrerAction(
                            'parcours_confirmation',
                            'Confirmation du choix de parcours',
                            [
                                'id_parcour' => $parcour->Code_Licence,
                                'date_confirmation' => now()->format('Y-m-d H:i:s'),
                            ]
                        );
                    }
                }
                
                \Illuminate\Support\Facades\DB::commit();
                
                // Message de succès personnalisé avec des détails sur le choix
                $message = "Votre choix du parcours <strong>$nomParcour</strong> dans la filière <strong>$nomFiliere</strong> a été enregistré et confirmé avec succès.";
                
                return redirect()->route('parcours.confirmation')
                    ->with('success', $message);
                    
            } catch (\Exception $e) {
                // Annuler la transaction en cas d'erreur
                \Illuminate\Support\Facades\DB::rollBack();
                throw $e;
            }
            
        } catch (ValidationException $e) {
            return redirect()->route('parcours.index')
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->route('parcours.index')
                ->with('error', 'Une erreur est survenue lors du choix du parcours: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Affiche la page de confirmation après le choix.
     *
     * @return \Illuminate\View\View
     */
    public function confirmation()
    {
        // Récupérer l'étudiant connecté
        $etudiant = Auth::user();
        
        // Vérifier si l'étudiant a déjà choisi un parcours
        if (!$etudiant->choix_confirme || !$etudiant->id_parcour) {
            return redirect()->route('parcours.index')
                ->with('error', 'Vous devez d\'abord choisir un parcours.');
        }
        
        try {
            // Récupérer le parcours choisi
            $parcour = $etudiant->parcour;
            
            if (!$parcour) {
                throw new \Exception('Parcours introuvable. Veuillez contacter l\'administration.');
            }
            
            // Récupérer la filière
            $filiere = $etudiant->filiere;
            
            if (!$filiere) {
                throw new \Exception('Filière introuvable. Veuillez contacter l\'administration.');
            }
            
            // Préparer les données pour la vue en gérant les valeurs nulles
            // pour éviter les erreurs de format
            $formattedEtudiant = $this->prepareEtudiantData($etudiant);
            
            return view('parcours.confirmation', [
                'etudiant' => $formattedEtudiant,
                'filiere' => $filiere,
                'parcour' => $parcour,
            ]);
        } catch (\Exception $e) {
            // Rediriger vers la page de choix de parcours avec un message d'erreur
            return redirect()->route('parcours.index')
                ->with('error', $e->getMessage());
        }
    }
    
    /**
     * Prépare les données étudiant pour la vue de confirmation en gérant les valeurs nulles.
     *
     * @param Etudiant $etudiant
     * @return Etudiant
     */
    private function prepareEtudiantData(Etudiant $etudiant)
    {
        // Créer une copie de l'étudiant pour ne pas modifier l'original
        $etudiantData = clone $etudiant;
        
        // Définir la propriété nom_complet si elle n'existe pas déjà
        if (!isset($etudiantData->nom_complet)) {
            $etudiantData->nom_complet = trim($etudiantData->nom . ' ' . $etudiantData->prenom);
        }
        
        // -------- Date de naissance --------
        $dn = $etudiantData->date_naissance ?? null;
        if ($dn) {
            if (!$dn instanceof Carbon) {
                try {
                    $dn = Carbon::parse($dn);
                } catch (\Exception $e) {
                    $dn = null;
                }
            }
        }
        $etudiantData->date_naissance = $dn; // normaliser
        $etudiantData->formatted_date_naissance = $dn ? $dn->format('d/m/Y') : 'Non renseignée';
        
        // -------- Date du choix --------
        $dc = $etudiantData->date_choix ?? null;
        if ($dc) {
            if (!$dc instanceof Carbon) {
                try {
                    $dc = Carbon::parse($dc);
                } catch (\Exception $e) {
                    $dc = null;
                }
            }
        }
        $etudiantData->date_choix = $dc; // normaliser
        $etudiantData->formatted_date_choix = $dc ? $dc->format('d/m/Y à H:i') : 'Date inconnue';
        
        return $etudiantData;
    }
    
    /**
     * Génère un PDF de confirmation du choix.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportPDF()
    {
        // Récupérer l'étudiant connecté
        $etudiant = Auth::user();
        
        try {
            // Validation complète des données avant génération du PDF
            if (!$etudiant) {
                throw new \Exception('Utilisateur non authentifié.');
            }
            
            if (!$etudiant->id_filiere) {
                throw new \Exception('Aucune filière n\'est assignée à votre profil.');
            }
            
            if (!$etudiant->choix_confirme || !$etudiant->id_parcour) {
                throw new \Exception('Vous devez d\'abord choisir et confirmer un parcours.');
            }
            
            // Récupération et validation des relations
            $parcour = $etudiant->parcour;
            if (!$parcour) {
                throw new \Exception('Le parcours sélectionné n\'existe plus.');
            }
            
            $filiere = $etudiant->filiere;
            if (!$filiere) {
                throw new \Exception('La filière assignée n\'existe plus.');
            }
            
            // Vérification de la cohérence des données
            if ($parcour->id_filiere !== $filiere->Code_DEUG) {
                throw new \Exception('Incohérence détectée entre le parcours et la filière.');
            }
            
            // Si la date de choix est manquante, la définir maintenant
            if (!$etudiant->date_choix) {
                \App\Models\Etudiant::where('Num_Inscription', $etudiant->Num_Inscription)
                    ->update(['date_choix' => now()]);
                    
                // Rafraîchir l'instance de l'étudiant
                $etudiant = \App\Models\Etudiant::find($etudiant->Num_Inscription);
            }
            
            // Validation des champs obligatoires pour le PDF - uniquement les champs essentiels
            $requiredFields = [
                'nom_complet' => 'Nom complet',
            ];
            
            foreach ($requiredFields as $field => $label) {
                if (empty($etudiant->$field)) {
                    throw new \Exception("Le champ {$label} est manquant. Complétez votre profil avant de générer le PDF.");
                }
            }
            
            // Préparer les données de l'étudiant
            $etudiant = $this->prepareEtudiantData($etudiant);
            
            // Générer le PDF via le facade barryvdh/dompdf, plus fiable dans Laravel
            $pdf = PDF::loadView('parcours.pdf', [
                'etudiant' => $etudiant,
                'filiere'  => $filiere,
                'parcour'  => $parcour,
                'date'     => now()->format('d/m/Y')
            ])
                ->setPaper('A4', 'portrait');
            
            // Définir le nom du fichier PDF
            $filename = 'confirmation_parcours_' . $etudiant->id_etudiant . '_' . now()->format('Ymd_His') . '.pdf';
            
            // Enregistrer l'action d'export du PDF dans l'historique
            if (method_exists($etudiant, 'enregistrerAction')) {
                $etudiant->enregistrerAction(
                    'pdf_export',
                    'Export du PDF de confirmation',
                    ['filename' => $filename]
                );
            }
            
            // Téléchargement
            return $pdf->download($filename);
            
        } catch (\Exception $e) {
            // Catégoriser les erreurs pour des messages plus adaptés
            $errorMessage = $e->getMessage();
            
            if (strpos($errorMessage, 'profil') !== false) {
                // Erreurs liées au profil incomplet
                return redirect()->route('parcours.confirmation')
                    ->with('warning', '<strong>Profil incomplet</strong> : ' . $errorMessage . 
                        ' <a href="' . route('profile.edit') . '" class="underline font-medium">Compléter mon profil</a>');
            } elseif (strpos($errorMessage, 'choisir') !== false || strpos($errorMessage, 'confirmer') !== false) {
                // Erreurs liées au choix de parcours
                return redirect()->route('parcours.index')
                    ->with('warning', '<strong>Choix de parcours requis</strong> : ' . $errorMessage);
            } else {
                // Autres erreurs techniques
                return redirect()->route('parcours.confirmation')
                    ->with('error', '<strong>Erreur technique</strong> : Impossible de générer le PDF. ' . $errorMessage);
            }
        }
    }
    
    /**
     * Affiche les détails d'un parcours spécifique.
     * Cette méthode est protégée par le middleware FiliereParcourMiddleware
     * qui vérifie si le parcours appartient bien à la filière de l'étudiant.
     *
     * @param  int  $code_licence
     * @return \Illuminate\View\View
     */
    public function show($code_licence)
    {
        // Récupérer l'étudiant connecté
        $etudiant = Auth::user();
        $filiere = $etudiant->filiere;
        
        // Récupérer le parcours demandé
        $parcour = Parcour::findOrFail($code_licence);
        
        // Le middleware FiliereParcourMiddleware s'assure déjà que le parcours
        // appartient à la filière de l'étudiant, nous n'avons donc pas besoin
        // de le vérifier à nouveau ici.
        
        // Afficher la vue détaillée du parcours
            return view('parcours.show', [
            'etudiant' => $etudiant,
            'filiere' => $filiere,
            'parcour' => $parcour,
            'estParcourChoisi' => $etudiant->id_parcour == $code_licence,
            'peutChoisir' => ($filiere->choix_parcour_autorise ?? false) && !$etudiant->choix_confirme
        ]);
    }
}
