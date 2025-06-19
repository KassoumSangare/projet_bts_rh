@extends('backend.layouts.master')

@section('content')

    @component('backend.components.breadcrumb')
        @slot('li_1') A propos @endslot
        @slot('title') Modifier un département @endslot
    @endcomponent

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center fs-5 fw-semibold">
                    Modification d’un Département
                </div>

                <div class="card-body">
                    {{-- Affichage des messages de session --}}
                    @if (session('success_message'))
                        <div class="alert alert-success">{{ session('success_message') }}</div>
                    @endif
                    @if (session('error_message'))
                        <div class="alert alert-danger">{{ session('error_message') }}</div>
                    @endif

                    {{-- Formulaire --}}
                    <form action="{{ route('departements.update',$departement->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du département</label>
                            <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror"
                                value="{{ old('nom', $departement->nom) }}">
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description', $departement->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select name="statut" id="statut" class="form-select @error('statut') is-invalid @enderror">
                                <option value="EN_SERVICE" {{ old('statut', $departement->statut) == 'EN_SERVICE' ? 'selected' : '' }}>En service</option>
                                <option value="HORS_SERVICE" {{ old('statut', $departement->statut) == 'HORS_SERVICE' ? 'selected' : '' }}>Hors service</option>
                            </select>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
    <script src="{{ URL::asset('build/js/pages/modal.init.js') }}"></script>
    <script src="{{ URL::asset('build/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('build/tinymce/fr_FR.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
