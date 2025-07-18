<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalaireRequest extends FormRequest
{
    /**
     * Autorisation de la requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation.
     */
    public function rules(): array
    {
        return [
            'employe_id' => ['required', 'exists:employes,id'],
            'date'       => ['required', 'date'],
            'montant'    => ['required', 'numeric', 'min:0'],
        ];
    }
   
    /**
     * Messages personnalisés.
     */
    public function messages(): array
    {
        return [
            'employe_id.required' => 'Veuillez sélectionner un employé.',
            'date.required'       => 'Veuillez indiquer la date de paiement.',
            'date.date'           => 'Le format de la date est invalide.',
            'montant.required'    => 'Veuillez indiquer un montant.',
            'montant.numeric'     => 'Le montant doit être un nombre.',
            'montant.min'         => 'Le montant ne peut pas être négatif.',
        ];
    }
}
