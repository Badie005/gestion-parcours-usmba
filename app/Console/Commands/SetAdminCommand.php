<?php

namespace App\Console\Commands;

use App\Models\Etudiant;
use Illuminate\Console\Command;

class SetAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:set {email : L\'adresse email de l\'utilisateur à promouvoir en administrateur}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Définir un utilisateur comme administrateur par son adresse email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        // Rechercher l'utilisateur par email
        $etudiant = Etudiant::where('email', $email)->first();
        
        if (!$etudiant) {
            $this->error("Aucun utilisateur trouvé avec l'email {$email}");
            return 1;
        }
        
        // Définir le rôle administrateur
        $etudiant->role = 'admin';
        $etudiant->save();
        
        $this->info("L'utilisateur {$etudiant->prenom} {$etudiant->nom} ({$email}) a été promu administrateur avec succès.");
        
        return 0;
    }
}
