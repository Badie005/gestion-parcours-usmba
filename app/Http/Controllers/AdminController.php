<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Parcour;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    /**
     * Constructeur du contrôleur admin
     */
    public function __construct()
    {
        // Le middleware admin est déjà appliqué dans les routes
    }

    /**
     * Affiche la page d'accueil du tableau de bord administratif
     */
    public function index()
    {
        // Récupérer les statistiques générales
        $stats = [
            'total_etudiants' => Etudiant::count(),
            'total_filieres' => Filiere::count(),
            'total_parcours' => Parcour::count(),
            'parcours_confirmes' => Etudiant::where('choix_confirme', true)->count(),
            'parcours_non_confirmes' => Etudiant::where('choix_confirme', false)->count(),
        ];

        // Récupérer les dernières activités (5 derniers étudiants ayant confirmé un parcours)
        $dernieres_activites = Etudiant::where('choix_confirme', true)
            ->whereNotNull('date_choix')
            ->orderBy('date_choix', 'desc')
            ->take(5)
            ->get();

        return view('admin.index', [
            'stats' => $stats,
            'dernieres_activites' => $dernieres_activites
        ]);
    }

    /**
     * Affiche la liste des étudiants avec filtres
     */
    public function etudiants(Request $request)
    {
        // Récupérer les filtres de la requête
        $filiere_id = $request->input('filiere_id');
        $parcour_id = $request->input('parcour_id');
        $confirme = $request->input('confirme');
        
        // Préparer la requête avec les relations
        $query = Etudiant::with(['filiere', 'parcour']);
        
        // Appliquer les filtres si présents
        if ($filiere_id) {
            $query->where('filiere_id', $filiere_id);
        }
        
        if ($parcour_id) {
            $query->where('parcour_id', $parcour_id);
        }
        
        if ($confirme !== null) {
            $query->where('choix_confirme', $confirme == '1');
        }
        
        // Récupérer les étudiants avec pagination
        $etudiants = $query->paginate(15);
        
        // Récupérer les filières et parcours pour les filtres
        $filieres = Filiere::all();
        $parcours = Parcour::all();
        
        return view('admin.etudiants', [
            'etudiants' => $etudiants,
            'filieres' => $filieres,
            'parcours' => $parcours,
            'filiere_id' => $filiere_id,
            'parcour_id' => $parcour_id,
            'confirme' => $confirme
        ]);
    }

    /**
     * Génère un rapport sur les choix de parcours
     */
    public function rapports()
    {
        // Statistiques par filière
        $stats_filieres = Filiere::withCount(['etudiants', 'parcours'])
            ->withCount(['etudiants as etudiants_confirmes_count' => function ($query) {
                $query->where('choix_confirme', true);
            }])
            ->get();
        
        // Statistiques par parcours
        $stats_parcours = Parcour::withCount(['etudiants' => function ($query) {
                $query->where('choix_confirme', true);
            }])
            ->with('filiere')
            ->get()
            ->sortByDesc('etudiants_count');
        
        // Graphique de répartition des étudiants par parcours (à implémenter côté JS)
        $data_graph = $stats_parcours->map(function ($parcour) {
            return [
                'label' => $parcour->licence_intitule_fr,
                'value' => $parcour->etudiants_count,
                'filiere' => $parcour->filiere->deug_intitule_fr
            ];
        });
        
        return view('admin.rapports', [
            'stats_filieres' => $stats_filieres,
            'stats_parcours' => $stats_parcours,
            'data_graph' => json_encode($data_graph)
        ]);
    }

    /**
     * Exporte la liste des étudiants par parcours en CSV
     */
    public function exportCsv(Request $request)
    {
        // Récupérer le parcours spécifié (si aucun, exporter tous les étudiants)
        $parcour_id = $request->input('parcour_id');
        $filiere_id = $request->input('filiere_id');
        
        // Préparer la requête
        $query = Etudiant::with(['filiere', 'parcour']);
        
        // Filtrer par parcours si spécifié
        if ($parcour_id) {
            $query->where('parcour_id', $parcour_id);
        }
        
        // Filtrer par filière si spécifiée
        if ($filiere_id) {
            $query->where('filiere_id', $filiere_id);
        }
        
        // Seulement les choix confirmés par défaut
        if (!$request->has('inclure_non_confirmes')) {
            $query->where('choix_confirme', true);
        }
        
        // Récupérer les données
        $etudiants = $query->get();
        
        // Générer le nom du fichier
        $filename = 'etudiants';
        if ($parcour_id) {
            $parcour = Parcour::find($parcour_id);
            $filename .= '_' . str_replace(' ', '_', strtolower($parcour->licence_intitule_fr));
        }
        if ($filiere_id) {
            $filiere = Filiere::find($filiere_id);
            $filename .= '_' . str_replace(' ', '_', strtolower($filiere->deug_intitule_fr));
        }
        $filename .= '_' . date('Y-m-d') . '.csv';
        
        // Créer le CSV
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];
        
        $callback = function() use ($etudiants) {
            $file = fopen('php://output', 'w');
            
            // En-têtes du CSV
            fputcsv($file, [
                'ID', 'Nom', 'Prénom', 'Email', 'Date de naissance',
                'Adresse', 'Téléphone', 'Filière', 'Parcours', 'Choix confirmé', 'Date de choix'
            ]);
            
            // Données
            foreach ($etudiants as $etudiant) {
                fputcsv($file, [
                    $etudiant->num_inscription,
                    $etudiant->nom,
                    $etudiant->prenom,
                    $etudiant->email,
                    $etudiant->date_naissance ? $etudiant->date_naissance->format('d/m/Y') : '',
                    $etudiant->adresse,
                    $etudiant->telephone,
                    $etudiant->filiere ? $etudiant->filiere->deug_intitule_fr : '',
                    $etudiant->parcour ? $etudiant->parcour->licence_intitule_fr : '',
                    $etudiant->choix_confirme ? 'Oui' : 'Non',
                    $etudiant->date_choix ? $etudiant->date_choix->format('d/m/Y H:i') : ''
                ]);
            }
            
            fclose($file);
        };
        
        return Response::stream($callback, 200, $headers);
    }
}
