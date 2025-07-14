@extends('backend.layouts.master')

@section('title')
    Postes
@endsection

@section('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Liste
        @endslot
        @slot('title')
            Historique de présence
        @endslot
    @endcomponent

   <div class="row">
    <div class="col-lg-12">
        <div class="card border-0 shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Présence des utilisateurs</h5>
                <a href="#" class="btn btn-sm btn-primary">Exporter</a>
            </div>

            <div class="card-body">
                @if (session('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success_message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="buttons-datatables" class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nom d'utilisateur</th>
                                <th>Date de connexion</th>
                                <th>Date de déconnexion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($presences as $key => $presence)
                                <tr id="row_{{ optional($presence->user)->username }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ optional($presence->user)->username ?? '-' }}</td>
                                    <td>{{ $presence->date_de_connexion ? $presence->date_de_connexion->format('d/m/Y H:i:s') : '-' }}</td>
                                    <td>{{ $presence->date_de_deconnexion ? $presence->date_de_deconnexion->format('d/m/Y H:i:s') : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Aucune présence enregistrée.</td>
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
