<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parcour extends Model
{
    use HasFactory;
    
    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'parcour';
    
    /**
     * La clé primaire associée à la table.
     *
     * @var string
     */
    protected $primaryKey = 'Code_Licence';
    public $incrementing = false;
    protected $keyType = 'string';
    
    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Code_Licence',
        'Licence_Intitule_Fr',
        'Licence_Intitule_Ar',
        'description',
        'id_filiere',
        'est_parcour_defaut'
    ];
    
    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'est_parcour_defaut' => 'boolean'
    ];
    
    /**
     * Obtenir la filière à laquelle appartient ce parcours.
     */
    public function filiere(): BelongsTo
    {
        return $this->belongsTo(Filiere::class, 'id_filiere', 'Code_DEUG');
    }
    
    /**
     * Obtenir les étudiants associés à ce parcours.
     */
    public function etudiants(): HasMany
    {
        return $this->hasMany(Etudiant::class, 'code_licence', 'code_licence');
    }
    
    /**
     * Vérifie si ce parcours est le parcours par défaut de sa filière.
     *
     * @return bool
     */
    public function estParcourDefaut(): bool
    {
        return $this->est_parcour_defaut;
    }
    
    /**
     * Obtenir le nombre d'étudiants inscrits dans ce parcours.
     *
     * @return int
     */
    public function getNombreEtudiantsAttribute(): int
    {
        return $this->etudiants()->count();
    }
    
    /**
     * Obtenir le pourcentage d'étudiants de la filière qui ont choisi ce parcours.
     *
     * @return float
     */
    public function getPourcentageEtudiantsAttribute(): float
    {
        $totalEtudiantsFiliere = $this->filiere->etudiants()->count();
        if ($totalEtudiantsFiliere === 0) {
            return 0;
        }
        
        return round(($this->nombre_etudiants / $totalEtudiantsFiliere) * 100, 2);
    }
}
