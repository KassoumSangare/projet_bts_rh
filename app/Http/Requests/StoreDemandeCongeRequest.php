<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDemandeCongeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'type_conge' => 'required|exists:type_conges,id',
            'date_debut' => 'required|date',
            'date_fin'   => 'required|date|after_or_equal:date_debut',
            'motif'      => 'nullable|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'type_conge.required' => 'Le type de congé est requis.',
            'type_conge.exists'   => 'Type de congé invalide.',
            'date_debut.required' => 'La date de début est requise.',
            'date_fin.required'   => 'La date de fin est requise.',
            'date_fin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
        ];
    }
}
