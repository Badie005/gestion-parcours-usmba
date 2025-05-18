<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParcourController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes principales
|--------------------------------------------------------------------------
|
| Route d'accueil qui redirige automatiquement vers le login si l'utilisateur
| n'est pas connecté ou vers le dashboard s'il est authentifié.
|
*/
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
})->name('home');

/*
|--------------------------------------------------------------------------
| Routes du tableau de bord
|--------------------------------------------------------------------------
|
| Route du tableau de bord qui est protégée par les middleware auth et verified.
| L'utilisateur doit être connecté et avoir vérifié son email pour y accéder.
|
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Routes protégées par authentification
|--------------------------------------------------------------------------
|
| Toutes ces routes nécessitent que l'utilisateur soit authentifié.
| Inclut les routes de profil et de gestion des parcours.
|
*/
Route::middleware('auth')->group(function () {
    // Routes de gestion du profil utilisateur
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        
        // Routes spécifiques pour les informations étudiant
        Route::patch('/student', [StudentProfileController::class, 'update'])->name('student.update');
    });
    
    // Routes pour la gestion des parcours d'études
    Route::prefix('parcours')
        ->name('parcours.')
        ->middleware('filiere.parcour') // Application du middleware de vérification de filière
        ->group(function () {
            // Affichage de la page de sélection des parcours
            Route::get('/', [ParcourController::class, 'index'])->name('index');
            
            // Traitement du formulaire de choix de parcours (méthode POST)
            Route::post('/choisir', [ParcourController::class, 'choisir'])->name('choisir');
            
            // Page de confirmation après sélection du parcours
            Route::get('/confirmation', [ParcourController::class, 'confirmation'])->name('confirmation');
            
            // Exportation du PDF de confirmation
            Route::get('/export-pdf', [ParcourController::class, 'exportPDF'])->name('export-pdf');
            
            // Route avec paramètre pour accéder aux détails d'un parcours spécifique
            // Cette route sera vérifiée par le middleware pour s'assurer que le parcours appartient à la filière de l'étudiant
            Route::get('/{code_licence}', [ParcourController::class, 'show'])->name('show')->where('code_licence', '[A-Za-z0-9]+');
        });
});

/*
|--------------------------------------------------------------------------
| Routes d'administration
|--------------------------------------------------------------------------
|
| Routes protégées par le middleware admin pour la gestion des étudiants,
| des statistiques et l'export de données.
|
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        // Tableau de bord principal
        Route::get('/', [AdminController::class, 'index'])->name('index');
        
        // Gestion des étudiants
        Route::get('/etudiants', [AdminController::class, 'etudiants'])->name('etudiants');
        
        // Rapports et statistiques
        Route::get('/rapports', [AdminController::class, 'rapports'])->name('rapports');
        
        // Export CSV
        Route::get('/export-csv', [AdminController::class, 'exportCsv'])->name('export-csv');
    });

/*
|--------------------------------------------------------------------------
| Routes d'authentification
|--------------------------------------------------------------------------
|
| Routes générées par Breeze pour l'authentification : login, enregistrement,
| gestion du mot de passe, vérification d'email, etc.
|
*/
require __DIR__.'/auth.php';
