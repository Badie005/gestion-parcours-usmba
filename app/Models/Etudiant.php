<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Etudiant extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    /**
     * Override save method to update the model in the database.
     *
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        return parent::save($options);
    }
    
    /**
     * Indique si le modèle doit mémoriser les jetons des utilisateurs.
     *
     * @var bool
     */
    protected $rememberTokenName = false;
    
    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'etudiant';
    
    /**
     * La clé primaire associée à la table.
     *
     * @var string
     */
    protected $primaryKey = 'Num_Inscription';
    
    /**
     * Indique si le modèle doit gérer automatiquement created_at / updated_at.
     * La table "etudiant" ne possède pas ces colonnes, on les désactive donc.
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom_fr', 'prenom_fr', 'nom_ar', 'prenom_ar',
        'email_academique', 'password',
        'date_naissance', 'adresse', 'telephone',
        'id_filiere', 'id_parcour',
        'choix_confirme', 'date_choix', 'last_login_at',
        'annee', 'aux', 'nb_val_ac_s1', 'nb_val_ac_s2', 'nb_val_ac_s3', 'nb_val_ac_s4',
        'fonctionnaire', 'impression_carte', 'duplicata_carte', 'impression_deug',
        'la_poutre', 'admission_deug', 'exclu', 'rd', 'reinscription',
        'lieu_naissance_fr', 'lieu_naissance_ar', 'sexe', 'pays_naissance', 'nationalite',
        'serie_bac', 'lieu_bac', 'annee_bac', 'lycee', 'handicap', 'region',
        'role'
    ];
    
    /**
     * Les attributs qui doivent être cachés pour les tableaux.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];
    
    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'choix_confirme' => 'boolean',
        'date_choix' => 'datetime',
        'last_login_at' => 'datetime'
    ];
    
    /**
     * Obtenir la filière à laquelle appartient cet étudiant.
     */
    public function filiere(): BelongsTo
    {
        // L'étudiant est lié à la filière via la colonne id_filiere => Code_DEUG
        return $this->belongsTo(Filiere::class, 'id_filiere', 'Code_DEUG');
    }
    
    /**
     * Obtenir le parcours choisi par cet étudiant (si existant).
     */
    public function parcour(): BelongsTo
    {
        // Relation basée sur id_parcour => Code_Licence
        return $this->belongsTo(Parcour::class, 'id_parcour', 'Code_Licence');
    }
    
    /**
     * Accesseur pour obtenir le nom complet de l'étudiant.
     *
     * @return string
     */
    public function getNomCompletAttribute(): string
    {
        return "$this->prenom_fr $this->nom_fr";
    }
    
    /**
     * Vérifie si l'étudiant peut choisir son parcours.
     * Basé sur le paramètre choix_parcour_autorise de sa filière.
     *
     * @return bool
     */
    /**
     * Vérifie si l'étudiant peut choisir son parcours.
     * Basé sur le paramètre choix_parcour_autorise de sa filière.
     *
     * @return bool
     */
    public function peutChoisirParcour(): bool
    {
        // Vérifie si la filière autorise le choix de parcours (sécurisé)
        return $this->filiere?->choix_parcour_autorise ?? false;
    }
    
    /**
     * Alias pour la compatibilité API.
     * 
     * @return bool
     */
    public function peutChoisirParcours(): bool
    {
        return $this->peutChoisirParcour();
    }
    
    /**
     * Vérifie si l'étudiant a déjà choisi un parcours.
     *
     * @return bool
     */
    public function aChoisiParcour(): bool
    {
        return $this->id_parcour !== null;
    }
    
    /**
     * Obtenir l'historique des actions de cet étudiant.
     */
    public function actionHistoriques(): HasMany
    {
        return $this->hasMany(ActionHistorique::class, 'id_etudiant', 'Num_Inscription');
    }
    
    /**
     * Enregistrer une action dans l'historique.
     *
     * @param string $typeAction
     * @param string $description
     * @param array|null $donneesAdditionnelles
     * @return \App\Models\ActionHistorique
     */
    public function enregistrerAction(string $typeAction, string $description, ?array $donneesAdditionnelles = null): ActionHistorique
    {
        return $this->actionHistoriques()->create([
            'type_action' => $typeAction,
            'description' => $description,
            'donnees_additionnelles' => $donneesAdditionnelles,
        ]);
    }
    
    /**
     * Vérifie si l'étudiant a le rôle admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    
    /**
     * Accessor pour rendre disponible $etudiant->date_naissance
     * même si la colonne réelle est "Date_Naissance" (PascalCase).
     */
    public function getDateNaissanceAttribute()
    {
        return $this->attributes['Date_Naissance'] ?? null;
    }
}
