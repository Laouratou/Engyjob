@extends('layouts.app')

@section('content')
        <div class="content content-page">
                <div class="container">
                        <div class="row">
                                @include('components.company_side_bar', ['active' => 'dashboard'])

                                <div class="col-xl-9 col-lg-8">
                                        <div class="page-title">
                                                <h3>Gérer les projets</h3>
                                        </div>
                                        <nav class="user-tabs mb-4">
                                                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                                        <li class="nav-item">
                                                                <a class="nav-link" href="{{ route('company.projects.details', $project->id) }}">Aperçu &
                                                                        Discussions</a>
                                                        </li>
                                                        <li class="nav-item">
                                                                <a class="nav-link active"
                                                                        href="{{ route('company.projects.manage_etape_cles', $project->id) }}">
                                                                        Etapes clés
                                                                </a>
                                                        </li>
                                                        <li class="nav-item">
                                                                <a class="nav-link" href="{{ route('company.projects.manage_tasks', $project->id) }}">
                                                                        Tâches
                                                                </a>
                                                        </li>
                                                        <li class="nav-item">
                                                                <a class="nav-link" href="{{ route('company.projects.project_files', $project->id) }}">
                                                                        Fichiers
                                                                </a>
                                                        </li>
                                                        {{-- <li class="nav-item">
                                                                <a class="nav-link" href="project-payment.html">Payments</a>
                                                        </li> --}}
                                                </ul>
                                        </nav>

                                        <!-- project list -->
                                        <div class="my-projects-view">
                                                <div class="row">
                                                        <div class="col-lg-12">
                                                                <div class="title-head d-flex justify-content-between align-items-center mb-4">
                                                                        <h4 class="mb-0"></h4>
                                                                        @if ($project->status != 'completed' && $project->status != 'canceled' && $project->status != 'expired')
                                                                                <button class="login-btn btn-primary" id="add-step-btn"
                                                                                        data-project_id="{{ $project->id }}">
                                                                                        Ajouter une étape
                                                                                </button>
                                                                                @endif
                                                                </div>

                                                                <div class="table-responsive table-box manage-projects-table">
                                                                        <table class="table table-center table-hover datatable no-sort">
                                                                                <thead class="thead-pink">
                                                                                        <tr>
                                                                                                <th>Titre</th>
                                                                                                <th>Budget</th>
                                                                                                <th>Progression</th>
                                                                                                <th>Début</th>
                                                                                                <th>Echéance</th>
                                                                                                <th>Statut</th>
                                                                                                <th>Action</th>
                                                                                        </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                        @foreach ($etapes_cles as $etapes_cle)
                                                                                                <tr>
                                                                                                        <td>{{ $etapes_cle->name }}</td>
                                                                                                        <td>{{ number_format($etapes_cle->price ?? 0, 0, ',', ' ') }} CFA</td>
                                                                                                        <td>
                                                                                                                <div class="d-flex align-items-center">
                                                                                                                        <div class="progress progress-md mb-0">
                                                                                                                                <div class="progress-bar bg-success" role="progressbar"
                                                                                                                                        style="width: {{ $etapes_cle->tasks_completed }}%"
                                                                                                                                        aria-valuenow="{{ $etapes_cle->tasks_completed }}"
                                                                                                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                                                                                        </div>
                                                                                                                        <p class="mb-0 orange-text text-center ms-3">
                                                                                                                                {{ $etapes_cle->tasks_completed }}%</p>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td>{{ \Carbon\Carbon::parse($etapes_cle->start_date)->format('d m Y') }}
                                                                                                        </td>
                                                                                                        <td>{{ \Carbon\Carbon::parse($etapes_cle->end_date)->format('d m Y') }}
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                @if ($etapes_cle->pay_status == true)
                                                                                                                        <span class="badge badge-pill bg-success-light">
                                                                                                                                Payé
                                                                                                                        </span>
                                                                                                                @else
                                                                                                                        <span class="badge badge-pill bg-danger-light">
                                                                                                                                Non payé
                                                                                                                        </span>
                                                                                                                @endif
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="action-table-data">
                                                                                                                        @if ($etapes_cle->pay_status == false)
                                                                                                                                <button class="btn btn-request btn_payment"
                                                                                                                                        data-id="{{ $etapes_cle->id }}"
                                                                                                                                        data-project_id="{{ $project->id }}"
                                                                                                                                        data-price="{{ $etapes_cle->price }}"
                                                                                                                                        data-freelancer_id="{{ $project->freelancer_id }}"
                                                                                                                                        data-freelancer_name="{{ $project->freelancer->name . ' ' . $project->freelancer->first_name }}">
                                                                                                                                        Payer mtn.
                                                                                                                                </button>
                                                                                                                        @endif
                                                                                                                        <div>
                                                                                                                                <select class="select select_status"
                                                                                                                                        data-id="{{ $etapes_cle->id }}">
                                                                                                                                        <option value="pending"
                                                                                                                                                {{ $etapes_cle->status == 'pending' ? 'selected' : '' }}>
                                                                                                                                                En attente</option>
                                                                                                                                        <option value="accepted"
                                                                                                                                                {{ $etapes_cle->status == 'accepted' ? 'selected' : '' }}>
                                                                                                                                                Accepté</option>
                                                                                                                                        <option value="in_progress"
                                                                                                                                                {{ $etapes_cle->status == 'in_progress' ? 'selected' : '' }}>
                                                                                                                                                En cours</option>
                                                                                                                                        <option value="completed"
                                                                                                                                                {{ $etapes_cle->status == 'completed' ? 'selected' : '' }}>
                                                                                                                                                Terminé</option>
                                                                                                                                        <option value="declined"
                                                                                                                                                {{ $etapes_cle->status == 'declined' ? 'selected' : '' }}>
                                                                                                                                                Rejecté</option>
                                                                                                                                        <option value="cancelled"
                                                                                                                                                {{ $etapes_cle->status == 'cancelled' ? 'selected' : '' }}>
                                                                                                                                                Annuler</option>
                                                                                                                                </select>
                                                                                                                        </div>

                                                                                                                        {{-- <div class="edit-delete-action">
                                                                                                                                <a href="#edit-milestone" class="me-2"
                                                                                                                                        data-bs-toggle="modal">
                                                                                                                                        <i class="feather-edit-2"></i>
                                                                                                                                </a>
                                                                                                                                <a href="javascript:void(0);">
                                                                                                                                        <i class="feather-trash-2"></i>
                                                                                                                                </a>
                                                                                                                        </div> --}}
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                        @endforeach
                                                                                </tbody>
                                                                        </table>

                                                                        @if (count($etapes_cles) == 0)
                                                                                <div class="text-center text-primary my-5">
                                                                                        <i class="fa-brands fa-cloudversify fa-4x"></i>
                                                                                        <h5 class="mt-1">Aucune donnée n'est spécifiée pour<br>le
                                                                                                moment.</h5>
                                                                                </div>
                                                                        @endif
                                                                </div>
                                                        </div>
                                                </div>

                                        </div>
                                        <!-- project list -->
                                </div>

                        </div>
                </div>
        </div>
@endsection
@section('js')
        <script>
                $(document).ready(function() {


                        $('.btn_payment').click(function() {
                                var id = $(this).data('id');
                                var project_id = $(this).data('project_id');
                                var price = $(this).data('price');
                                var freelancer_id = $(this).data('freelancer_id');
                                var name = $(this).data('freelancer_name');

                                //open modal
                                $("#etape_cle_payment_id").val(id);
                                $("#user_payment_project_id").val(project_id);

                                function formatNumberWithSpaces(number) {
                                        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
                                }

                                var formattedNumber = formatNumberWithSpaces(price);
                                $("#payment_amount").text(formattedNumber);
                                $("#user_payment_freelancer_name").text(name);


                                $("#user_payment_modal").modal('show');

                        })

                        $('.select_status').change(function() {
                                var id = $(this).data('id');
                                var status = $(this).val();

                                // change span text
                                var text = $(this).find(':selected').text();
                                $('#etape_status').text(text);

                                $('#etape_cle_status_id').val(id);
                                $('#etape_cle_status').val(status);

                                $("#change_stape_cle_status_modal").modal('show');
                        })

                        $("#add-step-btn").click(function() {
                                var project_id = $(this).data('project_id');
                                $("#etape_project_id").val(project_id);
                                $("#add-milestone").modal('show');

                        })
                })
        </script>
@endsection
