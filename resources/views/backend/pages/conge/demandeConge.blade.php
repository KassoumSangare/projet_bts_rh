@extends('backend.layouts.master')

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Employés
        @endslot
        @slot('title')
            Demande de congé
        @endslot
    @endcomponent

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center fs-5 fw-semibold">
                    Demande de congé
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('conge.storeDemande') }}" enctype="multipart/form-data"
                        class="needs-validation" novalidate>
                        @csrf
                        <div class="row mb-3">
                            <!-- Type de congé -->
                            <div class="col-md-8">

                                <div class="mb-3">
                                    <label class="form-label">Type de congé :</label>
                                    <select name="type_conge" class="form-select" id="typeConge" required>
                                        <option value="">-- Sélectionner --</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->type }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Veuillez choisir un type de congé.</div>

                                    @if ($types->isEmpty())
                                        <small class="text-danger">⚠ Aucun type de congé disponible.</small>
                                    @endif
                                </div>

                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Durée max :</label>
                                <input type="number" name="duree_max" id="dureeMax" class="form-control"
                                    placeholder="En jours" readonly>
                            </div>


                        </div>
                </div>


                <div class="row mb-3">
                    <!-- Date de début -->
                    <div class="col-md-6">
                        <label class="form-label">Date de début :</label>
                        <input type="date" name="date_debut" id="date_debut" class="form-control" required>
                        <div class="invalid-feedback">Veuillez indiquer la date de début.</div>
                    </div>

                    <!-- Date de fin -->
                    <div class="col-md-6">
                        <label class="form-label">Date de fin :</label>
                        <input type="date" name="date_fin" id="date_fin" class="form-control" required>
                        <div class="invalid-feedback">Veuillez indiquer la date de fin.</div>
                    </div>

                    <!-- Erreur de durée affichée ici -->
                    <div id="date-error" class="text-danger fw-semibold mt-2" style="display: none;"></div>

                    <!-- Affichage dynamique de la durée demandée -->
                    <div id="duree-demandee" class="text-info fw-semibold mt-1"></div>
                </div>


                <!-- Motif -->
                <div class="mb-3">
                    <label class="form-label">Motif / Justification :</label>
                    <textarea name="motif" id="motif" class="form-control" rows="4" placeholder="Expliquer la raison..."></textarea>
                </div>

                <!-- Bouton envoyer -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="ri-send-plane-line me-1"></i> Envoyer la demande
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
        document.addEventListener('DOMContentLoaded', function() {
            const allTypes = @json($types);
            const typeSelect = document.getElementById('typeConge');
            const dureeInput = document.getElementById('dureeMax');
            const dateDebutInput = document.getElementById('date_debut');
            const dateFinInput = document.getElementById('date_fin');
            const errorDiv = document.getElementById('date-error');
            const dureeAffichee = document.getElementById('duree-demandee');

            // Met à jour la durée max lorsqu'on change le type de congé
            typeSelect.addEventListener('change', function() {
                const selectedId = parseInt(this.value);
                const selectedType = allTypes.find(type => type.id === selectedId);
                dureeInput.value = selectedType ? selectedType.duree : '';
            });

            // Fonction pour calculer et afficher la durée
            function mettreAJourDuree() {
                errorDiv.style.display = 'none';
                errorDiv.textContent = '';
                dureeAffichee.textContent = '';

                const debut = new Date(dateDebutInput.value);
                const fin = new Date(dateFinInput.value);
                const dureeMax = parseInt(dureeInput.value);

                if (!isNaN(debut) && !isNaN(fin) && dateDebutInput.value && dateFinInput.value) {
                    const diffTime = fin - debut;
                    const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 1;

                    if (diffDays > 0) {
                        dureeAffichee.textContent = `Durée demandée : ${diffDays} jour${diffDays > 1 ? 's' : ''}`;

                        if (!isNaN(dureeMax) && diffDays > dureeMax) {
                            errorDiv.textContent =
                                `Vous avez demandé ${diffDays} jours, mais le maximum autorisé est de ${dureeMax} jours.`;
                            errorDiv.style.display = 'block';
                        }
                    } else {
                        dureeAffichee.textContent = `La date de fin doit être postérieure à la date de début.`;
                    }
                }
            }

            // Mettre à jour la durée lorsqu'on change une date
            dateDebutInput.addEventListener('change', mettreAJourDuree);
            dateFinInput.addEventListener('change', mettreAJourDuree);

            // Validation du formulaire
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    const debut = new Date(dateDebutInput.value);
                    const fin = new Date(dateFinInput.value);
                    const dureeMax = parseInt(dureeInput.value);
                    const diffTime = fin - debut;
                    const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 1;

                    errorDiv.style.display = 'none';
                    errorDiv.textContent = '';

                    if (!isNaN(diffDays) && !isNaN(dureeMax)) {
                        if (diffDays > dureeMax) {
                            event.preventDefault();
                            event.stopPropagation();
                            errorDiv.textContent =
                                `Vous avez demandé ${diffDays} jours, mais le maximum autorisé est de ${dureeMax} jours.`;
                            errorDiv.style.display = 'block';
                            return;
                        }
                    }

                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add('was-validated');
                }, false);
            });
        });
    </script>
@endsection
