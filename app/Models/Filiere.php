<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Filiere extends Model
{
    use HasFactory;
    
    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'filiere';
    
    /**
     * La clé primaire associée à la table.
     *
     * @var string
     */
    protected $primaryKey = 'Code_DEUG';
    public $incrementing = false;
    protected $keyType = 'string';
    
    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Code_DEUG',
        'DEUG_Intitule_Fr',
        'DEUG_Intitule_Ar',
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
        return $this->hasMany(Parcour::class, 'id_filiere', 'Code_DEUG');
    }
    
    /**
     * Obtenir les étudiants associés à la filière.
     */
    public function etudiants(): HasMany
    {
        return $this->hasMany(Etudiant::class, 'id_filiere', 'Code_DEUG');
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
     * Accessor alias for lowercase snake case attributes.
     */
    public function getDeugIntituleFrAttribute()
    {
        return $this->attributes['DEUG_Intitule_Fr'] ?? null;
    }

    public function getCodeDeugAttribute()
    {
        return $this->attributes['Code_DEUG'] ?? null;
    }
}
