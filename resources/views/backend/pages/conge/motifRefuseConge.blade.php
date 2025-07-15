@extends('backend.layouts.master')

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Employés
        @endslot
        @slot('title')
            Refus de congé
        @endslot
    @endcomponent

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header bg-danger text-white text-center fs-5 fw-bold">
                    Refus de la demande de congé
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('conge.refuseStatut', $demande->id) }}" class="needs-validation"
                        novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="motif_refus" class="form-label fw-semibold">Motif du refus :</label>
                            <textarea name="motif_refus" id="motif_refus" class="form-control" rows="4" required></textarea>
                            <div class="invalid-feedback">
                                Veuillez saisir un motif de refus.
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-danger">
                                <i class="ri-close-line me-1"></i> Refuser la demande
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
