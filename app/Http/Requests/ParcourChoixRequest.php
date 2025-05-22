<?php

namespace App\Http\Requests;

use App\Models\Parcour;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ParcourChoixRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Vérifie que l'utilisateur est authentifié et qu'il peut choisir un parcours
     */
    public function authorize(): bool
    {
        $etudiant = Auth::user();
        
        // L'utilisateur doit être authentifié et avoir la possibilité de choisir un parcours
        return $etudiant && method_exists($etudiant, 'peutChoisirParcour') && $etudiant->peutChoisirParcour();
    }

    /**
     * Get the validation rules that apply to the request.
     * Définit des règles de validation strictes pour le choix de parcours
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $etudiant = Auth::user();
        
        return [
            'code_licence' => [
                'required',
                'string',
                'exists:parcours,code_licence',
                function ($attribute, $value, $fail) {
                    $etudiant = Auth::user();
                    if (!$etudiant) {
                        $fail('Vous n\'êtes pas connecté.');
                        return;
                    }
                    
                    $parcour = Parcour::where('code_licence', $value)->first();
                    if (!$parcour) {
                        $fail('Le parcours sélectionné n\'existe pas.');
                        return;
                    }
                    
                    if ($parcour->id_filiere != $etudiant->filiere_id) {
                        $fail('Le parcours sélectionné n\'appartient pas à votre filière.');
                    }
                }
            ],
            'confirmer' => [
                'required',
                'accepted'
            ]
        ];
    }
    
    /**
     * Get custom messages for validator errors.
     * Messages d'erreur personnalisés pour améliorer l'expérience utilisateur
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'code_licence.required' => 'Vous devez sélectionner un parcours.',
            'code_licence.string' => 'Le code du parcours doit être une chaîne de caractères.',
            'code_licence.exists' => 'Le parcours sélectionné n\'existe pas.',
            'confirmer.required' => 'Vous devez confirmer votre choix.',
            'confirmer.accepted' => 'Vous devez confirmer votre choix en cochant la case.'
        ];
    }
    
    /**
     * Handle a failed authorization attempt.
     * Personnalise la réponse en cas d'échec d'autorisation
     *
     * @return void
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthorization()
    {
        $message = 'Vous ne pouvez pas choisir de parcours pour l\'une des raisons suivantes : ';
        $message .= 'soit vous avez déjà confirmé un choix, ';
        $message .= 'soit vous n\'avez pas de filière assignée, ';
        $message .= 'soit votre filière ne permet pas le choix de parcours.';
        
        throw new \Illuminate\Auth\Access\AuthorizationException($message);
    }
}
