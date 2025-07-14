<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCongeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'type' => 'required|string|max:255',
            'libelle' => 'required|string|max:255',
            'duree' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'Le type est obligatoire.',
            'type.string' => 'Le type doit être une chaîne de caractères.',
            'type.max' => 'Le type ne doit pas dépasser 255 caractères.',

            'libelle.required' => 'Le libellé est obligatoire.',
            'libelle.string' => 'Le libellé doit être une chaîne de caractères.',
            'libelle.max' => 'Le libellé ne doit pas dépasser 255 caractères.',

            'duree.required' => 'La durée est obligatoire.',
            'duree.integer' => 'La durée doit être un nombre entier.',
        ];
    }
}
