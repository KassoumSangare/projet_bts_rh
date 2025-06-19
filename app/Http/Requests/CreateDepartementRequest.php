<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDepartementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   public function rules(): array
{
    return [
        'nom' => ['required', 'string', 'max:255', 'unique:departements,nom'],
        'description' => ['nullable', 'string'],
        'statut' => ['required', 'string', 'in:EN_SERVICE,HORS_SERVICE'],
    ];
}

public function messages(): array
{
    return [
        'nom.required' => 'Le nom du département est obligatoire.',
        'nom.unique' => 'Ce nom est déjà utilisé.',
        'statut.required' => 'Le statut est obligatoire.',
        'statut.in' => 'Le statut doit être EN_SERVICE ou HORS_SERVICE.',
        'description.string' => 'La description doit être une chaîne de caractères.',
    ];
}

}
