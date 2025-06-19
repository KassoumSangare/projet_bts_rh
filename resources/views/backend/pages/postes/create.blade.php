@extends('backend.layouts.master')

@section('content')

    @component('backend.components.breadcrumb')
        @slot('li_1')
            A propos
        @endslot
        @slot('title')
            Créer une poste
        @endslot
    @endcomponent
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg rounded-4">
            <div class="card-header bg-primary text-white text-center fs-5 fw-semibold">
                Création d’un poste
            </div>


            <div class="card-body">
                <form class="row g-4 needs-validation" method="POST" action="{{ route('postes.store') }}" novalidate enctype="multipart/form-data">
                    @csrf

                    <!-- Nom du département -->
                    <div class="col-md-12">
                        <label  class="form-label fw-semibold">Titre du poste</label>
                        <input type="text" name="titre" id="titre" class="form-control" required placeholder="Ex:  Informaticien">
                        <div class="invalid-feedback">
                            Veuillez renseigner le titre du poste.
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Salaire de salaire</label>
                        <input type="text" name="salaire_base" id="salaire_base" class="form-control" required placeholder="Ex: Salaire de base">
                        <div class="invalid-feedback">
                            Veuillez renseigner le salaire de base.
                        </div>
                    </div>

                    <!-- Statut -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Statut</label>
                        <select name="statut" id="statut" class="form-select" required>
                            <option value="" selected disabled>-- Sélectionnez un statut --</option>
                            <option value="actif">Actif</option>
                            <option value="inactif">Inactif</option>
                        </select>
                        <div class="invalid-feedback">
                            Veuillez sélectionner un statut.
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-md-12">
                        <label  class="form-label fw-semibold">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required placeholder="Décrivez les fonctions ou le rôle de ce poste..."></textarea>
                        <div class="invalid-feedback">
                            Veuillez fournir une description.
                        </div>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success w-100 fw-bold">
                            <i class="bi bi-check-circle-fill me-2"></i> Valider
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <!--end row-->

@section('script')
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
    <script src="{{ URL::asset('build/js/pages/modal.init.js') }}"></script>
    <script src="{{ URL::asset('build/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('build/tinymce/fr_FR.js') }}"></script>
     <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
@endsection
