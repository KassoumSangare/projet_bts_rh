@extends('backend.layouts.master')

@section('title', 'Statut des demandes')

@section('css')
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" />
@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Statut des demandes
        @endslot
        @slot('title')
            Suivi des congés
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm rounded-4 border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Liste des demandes de congé</h5>
                </div>

                <div class="card-body">
                    @if (session('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="congesTable"
                            class="table table-bordered table-striped table-hover align-middle text-center w-100">
                            <thead class="table-primary text-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Motif</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Durée (jours)</th>
                                    <th>Motif du refus</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($demandes as $key => $demande)
                                    <tr id="row_{{ $demande->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td class="fw-bold text-primary">{{ $demande->motif }}</td>
                                        <td class="fw-bold text-primary">{{ $demande->date_debut }}</td>
                                        <td class="fw-bold text-primary">{{ $demande->date_fin }}</td>
                                        <td class="fw-bold text-primary">{{ $demande->duree }}</td>
                                        <td>
                                            @if ($demande->statut === 'refuser')
                                                {{ $demande->motif_refus ?? 'Non spécifié' }}
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>
                                            @switch($demande->statut)
                                                @case('accepter')
                                                    <span class="badge bg-success">Acceptée</span>
                                                @break

                                                @case('refuser')
                                                    <span class="badge bg-danger">Refusée</span>
                                                @break

                                                @default
                                                    <span class="badge bg-secondary">En attente</span>
                                            @endswitch
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-danger fw-bold py-4">
                                                Aucune demande trouvée.
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
        <!-- jQuery & DataTables JS -->
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

        <!-- App scripts -->
        <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
        <script src="{{ URL::asset('build/js/app.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('#congesTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    drawCallback: function() {
                        let route = "conge";
                        delete_row(route);
                    }
                });
            });
        </script>
    @endsection
