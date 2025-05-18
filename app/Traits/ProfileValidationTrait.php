<?php

namespace App\Traits;

use App\Models\Etudiant;

trait ProfileValidationTrait
{
    /**
     * Vérifie si le profil de l'étudiant est complet.
     *
     * @param Etudiant $etudiant
     * @return array Tableau contenant un booléen indiquant si le profil est complet et les champs manquants
     */
    protected function validateStudentProfile(Etudiant $etudiant): array
    {
        // Utiliser les bons noms de colonnes en snake_case comme définis dans le modèle Etudiant
        $requiredFields = [
            'nom_fr'       => 'Nom',
            'prenom_fr'    => 'Prénom',
            'date_naissance' => 'Date de naissance',
            'adresse'      => 'Adresse',
            'telephone'    => 'Téléphone'
        ];

        // Assurer la rétro-compatibilité si l’instance possède encore les attributs PascalCase
        // Mapping snake_case -> PascalCase pour rétro-compatibilité base de données
        $fallbackMap = [
            'nom_fr'         => 'Nom_Fr',
            'prenom_fr'      => 'Prenom_Fr',
            'date_naissance' => 'Date_Naissance'
        ];

        $missingFields = [];

        foreach ($requiredFields as $field => $label) {
            $value = $etudiant->$field ?? null;
            // Si valeur vide, tenter la clé fallback (pour compatibilité ancienne casse)
            if (empty($value) && isset($fallbackMap[$field])) {
                $fallbackField = $fallbackMap[$field];
                $value = $etudiant->$fallbackField ?? null;
            }
            if (empty($value)) {
                $missingFields[$field] = $label;
            }
        }

        return [
            'isComplete' => empty($missingFields),
            'missingFields' => $missingFields
        ];
    }
}
