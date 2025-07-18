@extends('backend.layouts.master')

@section('title', 'Postes')

@section('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" />




@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Liste
        @endslot
        @slot('title')
            Postes
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card border">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Liste des salaires</h5>
                    <a href="{{ route('payment.formSalaire')}}" class="btn btn-primary">Autre fiche</a>
                </div>

                <div class="card-body">
                    @if (session('success_message'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-bordered table-striped w-100">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Employé</th>
                                    <th>Département</th>
                                    <th>Poste</th>
                                    <th>Montant</th>
                                    <th>Date de paiement</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employes as $key => $employe)
                                    <tr id="row_{{ $employe->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employe->nom . ' ' . $employe->prenoms }}</td>
                                        <td>{{ $employe->departement->nom ?? 'Non défini' }}</td>
                                        <td>{{ $employe->poste->titre ?? 'Non défini' }}</td>
                                        <td>{{ number_format($employe->montant, 0, ',', ' ') }} FCFA</td>
                                        <td>{{ optional($employe->created_at)->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('payment.ficheSalaire', $employe->id) }}"
                                                class="btn btn-sm btn-primary" target="_blank" rel="noopener">
                                                <i class="ri-printer-line"></i> Imprimer
                                            </a>

                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-danger fw-bold">
                                            Aucune fiche disponible.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- DataTables scripts -->
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
            $('#buttons-datatables').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
        });
    </script>
@endsection
