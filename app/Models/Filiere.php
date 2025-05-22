<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Filiere extends Model
{
    use HasFactory;
    
    /**
     * La table dans la base de données est au pluriel : "filieres".
     *
     * @var string
     */
    protected $table = 'filieres';
    
    /**
     * La clé primaire correspond désormais à la colonne snake_case.
     *
     * @var string
     */
    protected $primaryKey = 'code_deug';
    public $incrementing = false;
    protected $keyType = 'string';
    
    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code_deug',
        'deug_intitule_fr',
        'deug_intitule_ar',
        'description',
        'choix_parcour_autorise'
    ];
    
    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'choix_parcour_autorise' => 'boolean'
    ];
    
    /**
     * Obtenir les parcours associés à la filière.
     */
    public function parcours(): HasMany
    {
        return $this->hasMany(Parcour::class, 'id_filiere', 'code_deug');
    }
    
    /**
     * Obtenir les étudiants associés à la filière.
     */
    public function etudiants(): HasMany
    {
        return $this->hasMany(Etudiant::class, 'id_filiere', 'code_deug');
    }
    
    /**
     * Obtenir le parcours par défaut de cette filière.
     *
     * @return Parcour|null
     */
    public function getParcoursDefaut()
    {
        return $this->parcours()->where('est_parcour_defaut', true)->first();
    }
    
    /**
     * Vérifie si les étudiants de cette filière peuvent choisir leur parcours.
     *
     * @return bool
     */
    public function choixParcourAutorise(): bool
    {
        return $this->choix_parcour_autorise;
    }
    
    /**
     * Obtenir le nombre d'étudiants inscrits dans cette filière.
     *
     * @return int
     */
    public function getNombreEtudiantsAttribute(): int
    {
        return $this->etudiants()->count();
    }
    
    /**
     * Accessors for camel / legacy attributes – continue to support any
     * existing code that might still reference the old column names.
     */
    public function getDeugIntituleFrAttribute()
    {
        return $this->attributes['deug_intitule_fr']
               ?? $this->attributes['DEUG_Intitule_Fr']
               ?? null;
    }

    public function getCodeDeugAttribute()
    {
        return $this->attributes['code_deug']
               ?? $this->attributes['Code_DEUG']
               ?? null;
    }
}
