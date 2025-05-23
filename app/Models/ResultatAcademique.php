<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResultatAcademique extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'resultats_academiques';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'num_inscription',
        'semestre',
        'code_module',
        'titre_module',
        'note',
        'coefficient',
        'statut',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'note' => 'float',
        'coefficient' => 'float',
    ];

    /**
     * Get the etudiant that owns the result.
     */
    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class, 'num_inscription', 'num_inscription');
    }

    /**
     * Determine if the module is validated.
     */
    public function estValide(): bool
    {
        return $this->statut === 'validé' || ($this->note !== null && $this->note >= 10);
    }

    /**
     * Calculate the weighted value of this result (note * coefficient).
     */
    public function getValeurPonderee(): ?float
    {
        if ($this->note === null) {
            return null;
        }

        return $this->note * $this->coefficient;
    }
}
