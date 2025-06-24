@extends('backend.layouts.master')

@section('title')
    Employés
@endsection

@section('css')
    <!--datatable css-->
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
            Employés
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Liste des employés</h5>
                    <a href="{{ route('employes.create') }}" class="btn btn-primary">Créer</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prénoms</th>
                                    <th>Nationalité</th>
                                    <th>Contact urgence</th>
                                    <th>Compte bancaire</th>
                                    <th>Matricule</th>
                                    <th>Sexe</th>
                                    <th>Date naissance</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Adresse</th>
                                    <th>Date embauche</th>
                                    <th>Département</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employes as $key => $employe)
                                    <tr id="row_{{ $employe->id }}">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $employe->nom }}</td>
                                        <td>{{ $employe->prenoms }}</td>
                                        <td>{{ $employe->nationalite }}</td>
                                        <td>{{ $employe->contact_urgence }}</td>
                                        <td>{{ $employe->numero_compte_bancaire }}</td>
                                        <td>{{ $employe->matricule }}</td>
                                        <td>{{ $employe->sexe }}</td>
                                        <td>{{ $employe->date_naissance }}</td>
                                        <td>{{ $employe->email }}</td>
                                        <td>{{ $employe->telephone }}</td>
                                        <td>{{ $employe->adresse }}</td>
                                        <td>{{ $employe->date_embauche }}</td>
                                        <td>{{ $employe->departement->nom ?? 'Non affecté' }}</td>
                                        <td>
                                            @if ($employe->statut == 'actif')
                                                <span class="badge bg-success">Actif</span>
                                            @else
                                                <span class="badge bg-danger">Inactif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a href="{{ route('employes.edit', $employe->id) }}"
                                                            class="dropdown-item edit-item-btn">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Modifier
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('employes.delete', $employe->id) }}"
                                                            class="dropdown-item remove-item-btn delete"
                                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $employe->id }}').submit();">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Supprimer
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="16" class="text-center text-danger fw-semibold">
                                            Aucun employé enregistré.
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
                drawCallback: function(settings) {
                    delete_row('employes');
                }
            });
        });
    </script>
@endsection
