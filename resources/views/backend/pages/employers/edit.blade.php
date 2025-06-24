@extends('backend.layouts.master')

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Employés
        @endslot
        @slot('title')
            Modifier un employé
        @endslot
    @endcomponent

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center fs-5 fw-semibold">
                    Modification d’un Employé
                </div>

                <div class="card-body">
                    <form class="row g-4 needs-validation" method="POST" action="{{ route('employes.update', $employe->id) }}"
                        novalidate>
                        @csrf
                        @method('POST')

                        <!-- Nom -->
                        <div class="col-md-6">
                            <label for="nom" class="form-label fw-semibold">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control"
                                value="{{ old('nom', $employe->nom) }}" required>
                            <div class="invalid-feedback">Veuillez renseigner le nom.</div>
                        </div>

                        <!-- Prénoms -->
                        <div class="col-md-6">
                            <label for="prenoms" class="form-label fw-semibold">Prénoms</label>
                            <input type="text" name="prenoms" id="prenoms" class="form-control"
                                value="{{ old('prenoms', $employe->prenoms) }}" required>
                            <div class="invalid-feedback">Veuillez renseigner les prénoms.</div>
                        </div>

                        <!-- Nationalité -->
                        <div class="col-md-6">
                            <label for="nationalite" class="form-label fw-semibold">Nationalité</label>
                            <input type="text" name="nationalite" id="nationalite" class="form-control"
                                value="{{ old('nationalite', $employe->nationalite) }}" required>
                            <div class="invalid-feedback">Veuillez indiquer la nationalité.</div>
                        </div>

                        <!-- Contact d'urgence -->
                        <div class="col-md-6">
                            <label for="contact_urgence" class="form-label fw-semibold">Contact d'urgence</label>
                            <input type="text" name="contact_urgence" id="contact_urgence" class="form-control"
                                value="{{ old('contact_urgence', $employe->contact_urgence) }}" required>
                            <div class="invalid-feedback">Veuillez entrer un contact d'urgence.</div>
                        </div>

                        <!-- Compte bancaire -->
                        <div class="col-md-6">
                            <label for="numero_compte_bancaire" class="form-label fw-semibold">Numéro de compte
                                bancaire</label>
                            <input type="text" name="numero_compte_bancaire" id="numero_compte_bancaire"
                                class="form-control"
                                value="{{ old('numero_compte_bancaire', $employe->numero_compte_bancaire) }}" required>
                            <div class="invalid-feedback">Ce champ est requis.</div>
                        </div>

                        <!-- Matricule -->
                        <div class="col-md-6">
                            <label for="matricule" class="form-label fw-semibold">Matricule</label>
                            <input type="text" name="matricule" id="matricule" class="form-control"
                                value="{{ old('matricule', $employe->matricule) }}" required>
                            <div class="invalid-feedback">Veuillez indiquer le matricule.</div>
                        </div>

                        <!-- Sexe -->
                        <div class="col-md-6">
                            <label for="sexe" class="form-label fw-semibold">Sexe</label>
                            <select name="sexe" id="sexe" class="form-select" required>
                                <option value="" disabled>-- Sélectionnez --</option>
                                <option value="Homme" {{ old('sexe', $employe->sexe) == 'Homme' ? 'selected' : '' }}>Homme
                                </option>
                                <option value="Femme" {{ old('sexe', $employe->sexe) == 'Femme' ? 'selected' : '' }}>Femme
                                </option>
                                <option value="Autre" {{ old('sexe', $employe->sexe) == 'Autre' ? 'selected' : '' }}>Autre
                                </option>
                            </select>
                            <div class="invalid-feedback">Veuillez choisir un sexe.</div>
                        </div>

                        <!-- Date de naissance -->
                        <div class="col-md-6">
                            <label for="date_naissance" class="form-label fw-semibold">Date de naissance</label>
                            <input type="date" name="date_naissance" id="date_naissance" class="form-control"
                                value="{{ old('date_naissance', $employe->date_naissance) }}" required>
                            <div class="invalid-feedback">Veuillez entrer la date de naissance.</div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email', $employe->email) }}" required>
                            <div class="invalid-feedback">Adresse email invalide.</div>
                        </div>

                        <!-- Téléphone -->
                        <div class="col-md-6">
                            <label for="telephone" class="form-label fw-semibold">Téléphone</label>
                            <input type="text" name="telephone" id="telephone" class="form-control"
                                value="{{ old('telephone', $employe->telephone) }}" required>
                            <div class="invalid-feedback">Ce champ est requis.</div>
                        </div>

                        <!-- Adresse -->
                        <div class="col-md-12">
                            <label for="adresse" class="form-label fw-semibold">Adresse</label>
                            <textarea name="adresse" id="adresse" class="form-control" rows="2" required>{{ old('adresse', $employe->adresse) }}</textarea>
                            <div class="invalid-feedback">Veuillez renseigner l’adresse.</div>
                        </div>

                        <!-- Date d'embauche -->
                        <div class="col-md-6">
                            <label for="date_embauche" class="form-label fw-semibold">Date d'embauche</label>
                            <input type="date" name="date_embauche" id="date_embauche" class="form-control"
                                value="{{ old('date_embauche', $employe->date_embauche) }}" required>
                            <div class="invalid-feedback">Veuillez entrer la date d'embauche.</div>
                        </div>

                        <!-- Statut -->
                        <div class="col-md-6">
                            <label for="statut" class="form-label fw-semibold">Statut</label>
                            <select name="statut" id="statut" class="form-select" required>
                                <option value="" disabled>-- Sélectionnez un statut --</option>
                                <option value="actif" {{ old('statut', $employe->statut) == 'actif' ? 'selected' : '' }}>
                                    ACTIF</option>
                                <option value="inactif"
                                    {{ old('statut', $employe->statut) == 'inactif' ? 'selected' : '' }}>INACTIF</option>
                                <option value="suspendu"
                                    {{ old('statut', $employe->statut) == 'suspendu' ? 'selected' : '' }}>SUSPENDU</option>
                            </select>
                            <div class="invalid-feedback">Veuillez sélectionner un statut.</div>
                        </div>

                        <!-- Département -->
                        <div class="col-md-6">
                            <label for="departement_id" class="form-label fw-semibold">Département</label>
                            <select name="departement_id" id="departement_id" class="form-select" required>
                                <option value="" disabled>-- Sélectionnez un département --</option>
                                @foreach ($departements as $departement)
                                    <option value="{{ $departement->id }}"
                                        {{ old('departement_id', $employe->departement_id) == $departement->id ? 'selected' : '' }}>
                                        {{ $departement->nom }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Veuillez choisir un département.</div>
                        </div>

                        <!-- Poste -->
                        <div class="col-md-6">
                            <label for="poste_id" class="form-label fw-semibold">Poste</label>
                            <select name="poste_id" id="poste_id" class="form-select" required>
                                <option value="" disabled>-- Sélectionnez un poste --</option>
                                @foreach ($postes as $poste)
                                    <option value="{{ $poste->id }}"
                                        {{ old('poste_id', $employe->poste_id) == $poste->id ? 'selected' : '' }}>
                                        {{ $poste->titre }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Veuillez choisir un poste.</div>
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success w-100 fw-bold">
                                <i class="bi bi-check-circle-fill me-2"></i> Enregistrer
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endsection
