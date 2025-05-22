<?php

namespace App\Http\Controllers;

use App\Models\ActionHistorique;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Traits\ProfileValidationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DiagnosticController extends Controller
{
    use ProfileValidationTrait;
    
    /**
     * Affiche les informations de diagnostic.
     */
    public function index()
    {
        // Détails de base
        $diagnosticData = [
            'app_version' => app()->version(),
            'php_version' => phpversion(),
            'timestamp' => now()->format('Y-m-d H:i:s'),
        ];
        
        // Vérifier l'authentification
        try {
            $diagnosticData['auth_check'] = Auth::check() ? 'Authentifié' : 'Non authentifié';
            $diagnosticData['auth_user'] = Auth::user() ? Auth::id() : 'Aucun';
        } catch (\Exception $e) {
            $diagnosticData['auth_error'] = $e->getMessage();
        }
        
        // Vérifier les tables et le schéma
        try {
            $diagnosticData['etudiants_exists'] = Schema::hasTable('etudiants') ? 'Oui' : 'Non';
            $diagnosticData['action_historiques_exists'] = Schema::hasTable('action_historiques') ? 'Oui' : 'Non';
            $diagnosticData['filieres_exists'] = Schema::hasTable('filieres') ? 'Oui' : 'Non';
            $diagnosticData['parcours_exists'] = Schema::hasTable('parcours') ? 'Oui' : 'Non';
        } catch (\Exception $e) {
            $diagnosticData['schema_error'] = $e->getMessage();
        }
        
        // Vérifier les données
        try {
            $diagnosticData['etudiants_count'] = DB::table('etudiants')->count();
            $diagnosticData['action_historiques_count'] = DB::table('action_historiques')->count();
            $diagnosticData['filieres_count'] = DB::table('filieres')->count();
            $diagnosticData['parcours_count'] = DB::table('parcours')->count();
        } catch (\Exception $e) {
            $diagnosticData['data_error'] = $e->getMessage();
        }
        
        // Tester la logique du dashboard étape par étape
        $dashboardTest = [];
        
        try {
            // 1. Vérifier l'utilisateur authentifié
            $etudiant = Auth::user();
            $dashboardTest['etudiant'] = $etudiant ? 'Trouvé' : 'Non trouvé';
            
            if ($etudiant) {
                // 2. Vérifier le profil
                try {
                    $profileValidation = $this->validateStudentProfile($etudiant);
                    $dashboardTest['profile_validation'] = 'OK';
                    $dashboardTest['profile_complete'] = $profileValidation['isComplete'] ? 'Complet' : 'Incomplet';
                } catch (\Exception $e) {
                    $dashboardTest['profile_validation_error'] = $e->getMessage();
                }
                
                // 3. Vérifier l'historique des actions
                try {
                    $etudiantId = $etudiant->num_inscription;
                    $dashboardTest['num_inscription'] = $etudiantId ?: 'Non trouvé';
                    
                    if ($etudiantId) {
                        $historique = ActionHistorique::where('etudiant_id', $etudiantId)
                            ->orderBy('created_at', 'desc')
                            ->take(10)
                            ->get();
                        $dashboardTest['historique_count'] = $historique->count();
                    } else {
                        $dashboardTest['historique_warning'] = 'num_inscription non défini';
                    }
                } catch (\Exception $e) {
                    $dashboardTest['historique_error'] = $e->getMessage();
                }
                
                // 4. Vérifier le parcours
                try {
                    $dashboardTest['parcour_id'] = $etudiant->parcour_id ?: 'Non défini';
                    $dashboardTest['choix_confirme'] = $etudiant->choix_confirme ? 'Oui' : 'Non';
                    $hasParcours = !empty($etudiant->parcour_id) && $etudiant->choix_confirme;
                    $dashboardTest['has_parcours'] = $hasParcours ? 'Oui' : 'Non';
                } catch (\Exception $e) {
                    $dashboardTest['parcours_error'] = $e->getMessage();
                }
                
                // 5. Vérifier la filière
                try {
                    $dashboardTest['filiere_id'] = $etudiant->filiere_id ?: 'Non défini';
                    
                    if (!empty($etudiant->filiere_id)) {
                        $filiere = Filiere::find($etudiant->filiere_id);
                        $dashboardTest['filiere_found'] = $filiere ? 'Oui' : 'Non';
                        $dashboardTest['choix_parcour_autorise'] = $filiere && ($filiere->choix_parcour_autorise ?? false) ? 'Oui' : 'Non';
                    } else {
                        $dashboardTest['filiere_warning'] = 'filiere_id non défini';
                    }
                } catch (\Exception $e) {
                    $dashboardTest['filiere_error'] = $e->getMessage();
                }
            }
        } catch (\Exception $e) {
            $dashboardTest['general_error'] = $e->getMessage();
            $dashboardTest['error_trace'] = $e->getTraceAsString();
        }
        
        return response()->json([
            'diagnostics' => $diagnosticData,
            'dashboard_test' => $dashboardTest
        ]);
    }
    
    /**
     * Affiche uniquement les informations utilisateur
     */
    public function user()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json(['error' => 'User not authenticated']);
            }
            
            // Safe extraction of user properties
            $userProperties = [];
            foreach ($user as $key => $value) {
                if (!is_object($value) && !is_array($value)) {
                    $userProperties[$key] = $value;
                }
            }
            
            return response()->json([           
                'user' => $userProperties,
                'type' => get_class($user),
                'class_methods' => get_class_methods($user)
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
    
    /**
     * Test ActionHistorique model
     */
    public function actionHistorique()
    {
        try {
            $count = ActionHistorique::count();
            $items = ActionHistorique::orderBy('created_at', 'desc')->take(5)->get();
            $schema = DB::getSchemaBuilder()->getColumnListing('action_historiques');
            
            return response()->json([
                'count' => $count,
                'items' => $items,
                'schema' => $schema
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
    
    /**
     * Affiche la page de débogage des parcours
     */
    public function debugParcours()
    {
        try {
            $etudiant = Auth::user();
            
            if (!$etudiant) {
                return redirect()->route('login')
                    ->with('error', 'Vous devez être connecté pour accéder à cette page.');
            }
            
            $filiere = Filiere::find($etudiant->filiere_id);
            $parcours = [];
            
            if ($filiere) {
                $parcours = DB::table('parcours')
                    ->where('id_filiere', $etudiant->filiere_id)
                    ->get();
            }
            
            // Récupérer les actions récentes
            $actions = ActionHistorique::where('etudiant_id', $etudiant->num_inscription)
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
            
            return view('parcours.debug', [
                'etudiant' => $etudiant,
                'filiere' => $filiere,
                'parcours' => $parcours,
                'actions' => $actions
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
