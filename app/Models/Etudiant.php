<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Etudiant extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'etudiants';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'num_inscription';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'num_inscription',
        'nom_fr',
        'prenom_fr',
        'email_academique',
        'password',
        'date_naissance',
        'adresse',
        'telephone',
        'filiere_id',
        'parcour_id',
        'choix_confirme',
        'date_choix',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int,string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'date_naissance'  => 'date',
        'date_choix'      => 'datetime',
        'last_login_at'   => 'datetime',
        'choix_confirme'  => 'boolean',
    ];

    /* ---------------------------------------------------------------------*/
    /* Relashionships                                                       */
    /* ---------------------------------------------------------------------*/

    public function actionHistoriques(): HasMany
    {
        return $this->hasMany(ActionHistorique::class, 'etudiant_id', 'num_inscription');
    }

    public function filiere(): BelongsTo
    {
        return $this->belongsTo(Filiere::class, 'filiere_id', 'code_deug');
    }

    public function parcour(): BelongsTo
    {
        return $this->belongsTo(Parcour::class, 'parcour_id', 'code_licence');
    }

    /* ---------------------------------------------------------------------*/
    /* Accessors / Mutators (Aliases for legacy code)                       */
    /* ---------------------------------------------------------------------*/

    public function getNomAttribute(): ?string
    {
        return $this->nom_fr;
    }

    public function getPrenomAttribute(): ?string
    {
        return $this->prenom_fr;
    }

    public function getEmailAttribute(): ?string
    {
        return $this->email_academique;
    }

    /**
     * Alias for legacy id_etudiant property.
     */
    public function getIdEtudiantAttribute(): ?string
    {
        return $this->num_inscription;
    }

    /**
     * Alias to remain compatible with property "Num_Inscription" used in some controllers.
     */
    public function getNum_InscriptionAttribute(): ?string
    {
        return $this->num_inscription;
    }

    /**
     * Alias for id_filiere legacy column name.
     */
    public function getIdFiliereAttribute(): ?string
    {
        return $this->filiere_id;
    }

    /**
     * Alias for id_parcour legacy column name.
     */
    public function getIdParcourAttribute(): ?string
    {
        return $this->parcour_id;
    }

    public function getNomCompletAttribute(): string
    {
        return trim(($this->nom_fr ?? '') . ' ' . ($this->prenom_fr ?? ''));
    }

    public function getFormattedDateNaissanceAttribute(): ?string
    {
        return $this->date_naissance ? $this->date_naissance->format('d/m/Y') : null;
    }

    /* ---------------------------------------------------------------------*/
    /* Helper methods                                                       */
    /* ---------------------------------------------------------------------*/

    /**
     * Enregistrer une action dans l'historique.
     */
    public function enregistrerAction(string $typeAction, string $description, ?array $donneesAdditionnelles = null): ActionHistorique
    {
        return $this->actionHistoriques()->create([
            'etudiant_id'          => $this->num_inscription,
            'type_action'          => $typeAction,
            'description'          => $description,
            'donnees_additionnelles' => $donneesAdditionnelles,
        ]);
    }

    /**
     * Détermine si l'étudiant peut encore choisir un parcours.
     */
    public function peutChoisirParcour(): bool
    {
        return !$this->choix_confirme && $this->filiere && ($this->filiere->choix_parcour_autorise ?? false);
    }
}