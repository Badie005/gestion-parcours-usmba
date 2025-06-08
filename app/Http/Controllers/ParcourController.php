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
        
        // Si déjà confirmé, redirection
        if ($etudiant->choix_confirme) {
            return redirect()->route('parcours.confirmation');
        }
        
        // Récupérer la filière d'une manière sécurisée
        $filiere = null;
        if ($etudiant->filiere_id) {
            $filiere = \App\Models\Filiere::find($etudiant->filiere_id);
        }
        
        // Vérifier si l'étudiant a une filière assignée
        if (!$filiere) {
            return redirect()->route('dashboard')
                ->with('error', 'Vous n\'avez pas de filière assignée. Veuillez contacter l\'administration.');
        }
        
        // Récupérer les parcours disponibles pour la filière de l'étudiant
        $parcours = Parcour::where('id_filiere', $etudiant->filiere_id)->get();
        
        // Vérifier si l'étudiant peut choisir son parcours
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
            if (!$etudiant->parcour_id) {
                // Utiliser l'update statique pour éviter les erreurs de méthode manquante
                \App\Models\Etudiant::where('num_inscription', $etudiant->num_inscription)
                    ->update([
                        'parcour_id' => $parcourDefaut->code_licence,
                        'choix_confirme' => true,
                        'date_choix' => now()
                    ]);
                    
                // Rafraîchir l'instance de l'étudiant
                $etudiant = \App\Models\Etudiant::find($etudiant->num_inscription);
                
                $message = 'Votre choix de parcours <strong>' . $parcourDefaut->licence_intitule_fr . '</strong> a été enregistré avec succès.';
                
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
        
        // Si l'étudiant peut choisir, afficher le formulaire de choix de parcours
        return view('parcours.index', [
            'etudiant' => $etudiant,
            'filiere' => $filiere,
            'parcours' => $parcours,
            'peutChoisir' => true,
            'parcourSelectionne' => $etudiant->parcour_id ? $etudiant->parcour : null,
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
            
            // Vérifier si l'étudiant a déjà confirmé son choix
            if ($etudiant->choix_confirme) {
                throw ValidationException::withMessages([
                    'choix_confirme' => ['Vous avez déjà confirmé votre choix de parcours et ne pouvez plus le modifier.']
                ]);
            }
            
            // Vérifier si la filière autorise le choix de parcours
            $filiere = $etudiant->filiere;
            if (!($filiere->choix_parcour_autorise ?? false)) {
                throw ValidationException::withMessages([
                    'filiere' => ['Votre filière ne permet pas de choisir librement un parcours.']
                ]);
            }
            
            // Démarrer une transaction pour s'assurer que tout est cohérent
            \Illuminate\Support\Facades\DB::beginTransaction();
            
            try {
                // Obtenir le nom de la filière et du parcours pour le message
                $nomFiliere = $etudiant->filiere->deug_intitule_fr;
                $nomParcour = $parcour->licence_intitule_fr;
                
                // Mettre à jour l'étudiant avec le parcours choisi en utilisant la méthode statique update
                // pour éviter les erreurs liées à la méthode save()
                Etudiant::where('num_inscription', $etudiant->num_inscription)
                    ->update([
                        'parcour_id' => $parcour->code_licence,
                        'choix_confirme' => true,
                        'date_choix' => now()
                    ]);
                
                // Rafraîchir l'instance de l'étudiant
                $etudiant = Etudiant::find($etudiant->num_inscription);
                
                // Enregistrer l'action directement dans la table action_historiques
                // sans utiliser la méthode enregistrerAction qui peut causer des erreurs
                // Convertir les données en JSON pour éviter les problèmes de sérialisation
                \App\Models\ActionHistorique::create([
                    'etudiant_id' => $etudiant->num_inscription,
                    'type_action' => 'parcours_choix',
                    'description' => 'Choix du parcours',
                    'donnees_additionnelles' => json_encode([
                        'code_licence' => $parcour->code_licence,
                        'date_choix' => now()->format('Y-m-d H:i:s'),
                    ]),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
                // Enregistrer l'action de confirmation
                \App\Models\ActionHistorique::create([
                    'etudiant_id' => $etudiant->num_inscription,
                    'type_action' => 'parcours_confirmation',
                    'description' => 'Confirmation du choix de parcours',
                    'donnees_additionnelles' => json_encode([
                        'code_licence' => $parcour->code_licence,
                        'date_confirmation' => now()->format('Y-m-d H:i:s'),
                    ]),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
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
        if (!$etudiant->choix_confirme || !$etudiant->parcour_id) {
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
            
            if (!$etudiant->filiere_id) {
                throw new \Exception('Aucune filière n\'est assignée à votre profil.');
            }
            
            if (!$etudiant->choix_confirme || !$etudiant->parcour_id) {
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
            if ($parcour->id_filiere !== $filiere->code_deug) {
                throw new \Exception('Incohérence détectée entre le parcours et la filière.');
            }
            
            // Si la date de choix est manquante, la définir maintenant
            if (!$etudiant->date_choix) {
                \App\Models\Etudiant::where('num_inscription', $etudiant->num_inscription)
                    ->update(['date_choix' => now()]);
                    
                // Rafraîchir l'instance de l'étudiant
                $etudiant = \App\Models\Etudiant::find($etudiant->num_inscription);
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

            // --- Référence et hash natif ---
            $reference = 'GPE-' . str_pad($etudiant->num_inscription, 5, '0', STR_PAD_LEFT) . '-' . now()->format('Ymd');
            $hash = hash('sha256', $reference);
            
            // Générer un QR code via une URL externe (solution temporaire)
            $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?' . http_build_query([
                'size' => '120x120',
                'data' => $reference,
                'ecc' => 'H',
                'margin' => 1,
                'qzone' => 1,
                'format' => 'png'
            ]);
            $qr = base64_encode(file_get_contents($qrUrl));
            
            // Générer le PDF avec filigrane CSS
            $pdf = PDF::loadView('parcours.pdf', [
                'etudiant' => $etudiant,
                'filiere'  => $filiere,
                'parcour'  => $parcour,
                'date'     => now()->format('d/m/Y'),
                'qr'       => $qr,
                'hash'     => $hash,
                'reference'=> $reference
            ])->setPaper('A4', 'portrait');
            
            // Définir le nom du fichier PDF
            $filename = 'confirmation_parcours_' . $etudiant->num_inscription . '_' . now()->format('Ymd_His') . '.pdf';
            
            // Vérifier si une action similaire a été enregistrée dans les 10 dernières secondes
            $recentAction = \App\Models\ActionHistorique::where('etudiant_id', $etudiant->num_inscription)
                ->where('type_action', 'pdf_export')
                ->where('created_at', '>=', now()->subSeconds(10))
                ->first();
                
            // Enregistrer l'action uniquement si aucune action similaire récente n'existe
            if (!$recentAction) {
                \App\Models\ActionHistorique::create([
                    'etudiant_id' => $etudiant->num_inscription,
                    'type_action' => 'pdf_export',
                    'description' => 'Export du PDF de confirmation',
                    'donnees_additionnelles' => json_encode(['filename' => $filename]),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
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
            'estParcourChoisi' => $etudiant->parcour_id == $code_licence,
            'peutChoisir' => ($filiere->choix_parcour_autorise ?? false) && !$etudiant->choix_confirme
        ]);
    }
}
