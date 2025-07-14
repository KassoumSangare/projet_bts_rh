@extends('backend.layouts.master')

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Congé
        @endslot
        @slot('title')
            Modifier un congé
        @endslot
    @endcomponent

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center fs-5 fw-semibold">
                    <i class="ri-calendar-add-line me-2"></i> Modifier un congé
                </div>

                <div class="card-body">
                    <form class="row g-4 needs-validation" method="POST" action="{{ route('conge.update',$congeItem->id) }}" novalidate>
                        @csrf

                        {{-- Type --}}
                        <div class="col-md-12">
                            <label for="type" class="form-label fw-semibold">Type de congé</label>
                            <input type="text" name="type" id="type" value="{{ old('type',$congeItem->type) }}"
                                class="form-control @error('type') is-invalid @enderror" required>
                            <div class="invalid-feedback">Veuillez renseigner le type de congé.</div>
                            @error('type')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Libellé --}}
                        <div class="col-md-12">
                            <label for="libelle" class="form-label fw-semibold">Libellé</label>
                            <textarea name="libelle" id="libelle" rows="4" class="form-control @error('libelle') is-invalid @enderror"
                                placeholder="Décrivez le type de congé en détail">{{ old('libelle',$congeItem->libelle) }}</textarea>
                            @error('libelle')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Durée --}}
                        <div class="col-md-12">
                            <label for="duree" class="form-label fw-semibold">Durée (en jours)</label>
                            <input type="number" name="duree" id="duree" value="{{ old('duree',$congeItem->duree) }}"
                                class="form-control @error('duree') is-invalid @enderror" required min="1">
                            <div class="invalid-feedback">Veuillez renseigner la durée du congé.</div>
                            @error('duree')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Bouton de soumission --}}
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success w-100 fw-bold">
                                <i class="ri-check-line me-1"></i> Enregistrer le type de congé
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
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endsection
