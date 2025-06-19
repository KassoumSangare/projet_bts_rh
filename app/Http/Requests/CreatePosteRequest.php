<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePosteRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation pour la création d’un poste.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255', 'unique:postes,titre'],
            'statut' => ['required', 'string', 'in:actif,inactif'],
            'description' => ['nullable', 'string'],
            'salaire_base' => ['required', 'numeric'],
        ];
    }

    /**
     * Messages personnalisés pour les erreurs de validation.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du poste est obligatoire.',
            'titre.string' => 'Le titre doit être une chaîne de caractères.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'titre.unique' => 'Ce titre est déjà utilisé pour un autre poste.',

            'statut.required' => 'Le statut est obligatoire.',
            'statut.string' => 'Le statut doit être une chaîne de caractères.',
            'statut.in' => 'Le statut doit être "actif" ou "inactif".',

            'description.string' => 'La description doit être une chaîne de caractères.',

            'salaire_base.required' => 'Le salaire de base est obligatoire.',
            'salaire_base.numeric' => 'Le salaire de base doit être un nombre.',
            'salaire_base.min' => 'Le salaire de base doit être au moins égal à 0.',
        ];
    }
}
