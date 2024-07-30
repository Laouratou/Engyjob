@extends('layouts.app')

@section('content')
    <div class="content content-page">
        <div class="container">
            <div class="row">
                @include('components.freelancers_side_bar', ['active' => 'dashboard'])

                <div class="col-xl-9 col-lg-8">
                    <div class="page-title">
                        <h3>Gérer les projets</h3>
                    </div>
                    <nav class="user-tabs mb-4">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('freelancers.projects.details', $project->id) }}">Aperçu &
                                    Discussions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('freelancers.projects.manage_etape_cles', $project->id) }}">
                                    Etapes clés
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active"
                                    href="{{ route('freelancers.projects.manage_tasks', $project->id) }}">
                                    Tâches
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('freelancers.projects.project_files', $project->id) }}">
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
                                    <button class="login-btn btn-primary" id="add-task-btn"
                                        data-project_id="{{ $project->id }}">
                                        Ajouter une tâche
                                    </button>
                                    @endif
                                </div>

                                <div class="table-responsive table-box manage-projects-table">
                                    <table class="table table-center table-hover datatable no-sort">
                                        <thead class="thead-pink">
                                            <tr>
                                                <th>Libellé</th>
                                                <th>Etape</th>
                                                <th>Echéance</th>
                                                <th>Description</th>
                                                <th>Statut</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tasks as $key => $task)
                                                <tr>
                                                <td>{{ $task->name }}</td>
<td>{{ $task->etape_cle ? $task->etape_cle->name : 'Aucune étape clé associée' }}</td>
<td>{{ \Carbon\Carbon::parse($task->end_date)->format('d/m/Y') }}</td>
<td alt="{!! $task->description !!}">
    {!! Str::substr($task->description ?? '', 0, 55) !!}...
</td>

                                                    <td>
                                                        <div class="action-table-data">
                                                            <select class="select select_task_status"
                                                                data-id="{{ $task->id }}">
                                                                <option value="pending"
                                                                    {{ $task->status == 'pending' ? 'selected' : '' }}>
                                                                    En attente</option>
                                                                <option value="in_progress"
                                                                    {{ $task->status == 'in_progress' ? 'selected' : '' }}>
                                                                    En cours</option>
                                                                <option value="completed"
                                                                    {{ $task->status == 'completed' ? 'selected' : '' }}>
                                                                    Terminé</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="action-table-data">
                                                            <div class="edit-delete-action m-0">
                                                                <a href="#edit-milestone" class="me-2"
                                                                    data-bs-toggle="modal"><i
                                                                        class="feather-edit-2"></i></a>
                                                                <a href="javascript:void(0);"><i
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                    @if (count($tasks ?? []) == 0)
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


            $(".select_task_status").change(function() {

                var id = $(this).data('id');
                var status = $(this).val();

                // change span text
                var text = $(this).find(':selected').text();
                $('#task_status_text').text(text);

                $("#task_status").val(status);
                $("#task_status_id").val(id);
                $("#change_task_status_modal").modal('show');
            })

            $("#add-task-btn").click(function() {
                var project_id = $(this).data('project_id');
                $("#task_project_id").val(project_id);
                $("#add-task-modal").modal('show');

            })

        })
    </script>
@endsection
