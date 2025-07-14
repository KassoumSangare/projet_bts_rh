@extends('backend.layouts.master')

@section('title')
    Role
@endsection

@section('css')
    <!-- Datatables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" />
@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Liste
        @endslot
        @slot('title')
            Roles
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm rounded-4 border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Liste des congés</h5>
                    <a href="{{ route('conge.registerForm') }}" class="btn btn-primary">
                        Créer un congé
                    </a>
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
                                    <th>Type de congé</th>
                                    <th>Libellé</th>
                                    <th>Durée (jours)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($congeItems as $key => $congeItem)
                                    <tr id="row_{{ $congeItem->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-capitalize">{{ $congeItem->type }}</td>
                                        <td>{{ $congeItem->libelle }}</td>
                                        <td class="fw-bold text-primary">{{ $congeItem->duree }}</td>
                                        <td>
                                            <a href="{{ route('conge.edit', $congeItem->id) }}"
                                                class="btn btn-sm btn-outline-info me-1" title="Modifier">
                                                <i class="ri-edit-line"></i>
                                            </a>

                                            <a href="{{ route('conge.delete', $congeItem->id) }}"
                                                class="btn btn-sm btn-outline-danger" data-id="{{ $congeItem->id }}">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-danger fw-bold py-4">
                                            Aucun type de congé enregistré
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
