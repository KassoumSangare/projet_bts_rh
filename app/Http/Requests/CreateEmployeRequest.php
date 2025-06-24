<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

   public function rules(): array
{
    return [
        'nom' => 'required|string|max:255',
        'prenoms' => 'required|string|max:255',
        'nationalite' => 'required|string|max:100',
        'contact_urgence' => 'required|string|max:20',
        'numero_compte_bancaire' => 'required|string|max:30',
        'matricule' => 'required|string|max:50|unique:employes,matricule',
        'sexe' => 'required|in:Homme,Femme,Autre',
        'date_naissance' => 'required|date|before:today',
        'email' => 'required|email|unique:employes,email',
        'telephone' => 'required|string|max:20|unique:employes,telephone',
        'adresse' => 'required|string|max:255',
        'date_embauche' => 'required|date',
        'statut' => 'required|in:actif,inactif,suspendu',
        'departement_id' => 'required|exists:departements,id',
        'poste_id' => 'required|exists:postes,id',
        'salaire_id' => 'nullable|exists:salaires,id',
        'contrat_id' => 'nullable|exists:contrats,id',
    ];
}


    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'prenoms.required' => 'Les prénoms sont obligatoires.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'matricule.unique' => 'Ce matricule existe déjà.',
            'telephone.unique' => 'Ce numéro est déjà utilisé.',
            'departement_id.required' => 'Veuillez sélectionner un département.',
            'poste_id.required' => 'Veuillez sélectionner un poste.',

        ];
    }
}
