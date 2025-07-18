@extends('backend.layouts.master')

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Employés
        @endslot
        @slot('title')
            Formulaire de paiement
        @endslot
    @endcomponent

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center fs-5 fw-semibold">
                    Formulaire de paiement
                </div>

                <div class="card-body px-4">
                    <form method="POST" action="{{ route('payment.StoreSalaire') }}" class="needs-validation" novalidate>
                        @csrf
                        {{-- Sélection de l’employé --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Employé :</label>
                            <select name="employe_id" class="form-select" required>
                                <option value="">-- Sélectionner un employé --</option>
                                @foreach ($employes as $employe)
                                    <option value="{{ $employe->id }}">{{ $employe->nom }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Veuillez choisir un employé.</div>

                            @if ($employes->isEmpty())
                                <small class="text-danger d-block mt-1">⚠ Aucun employé enregistré.</small>
                            @endif
                        </div>

                        {{-- Date + Montant en 2 colonnes --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Date :</label>
                                <input type="date" name="date" class="form-control" required>
                                <div class="invalid-feedback">Veuillez indiquer la date de paiement.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Montant (FCFA) :</label>
                                <input type="number" name="montant" class="form-control" min="0" step="1000"
                                    placeholder="Saisissez le montant, ex. : 300 000" required>
                                <div class="invalid-feedback">Veuillez indiquer un montant valide.</div>
                            </div>
                        </div>

                        {{-- Bouton envoyer --}}
                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="ri-send-plane-line me-1"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        $(document).ready(function() {
            if ($.fn.DataTable.isDataTable('#buttons-datatables')) {
                $('#buttons-datatables').DataTable().destroy();
            }

            $('#buttons-datatables').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                drawCallback: function() {
                    delete_row('postes');
                }
            });
        });
    </script>
@endsection
