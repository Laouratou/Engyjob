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
                                <a class="nav-link" href="{{ route('company.projects.details', $project->id) }}">Aperçu & Discussions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('company.projects.manage_etape_cles', $project->id) }}">Etapes clés</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('company.projects.manage_tasks', $project->id) }}">Tâches</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('company.projects.project_files', $project->id) }}">Fichiers</a>
                            </li>
                        </ul>
                    </nav>

                    <!-- project list -->
                    <div class="my-projects-view">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="title-head d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="mb-0"></h4>
                                    @if ($project->status != 'completed' && $project->status != 'canceled' && $project->status != 'expired')
                                        <button class="login-btn btn-primary" id="add-project-file-btn" data-project_id="{{ $project->id }}">
                                            Ajouter un fichier
                                        </button>
                                    @endif
                                </div>

                                <div class="table-responsive table-box manage-projects-table">
                                    <table class="table table-center table-hover datatable no-sort">
                                        <thead class="thead-pink">
                                            <tr>
                                                <th>Titre</th>
                                                <th>Description</th>
                                                <th>Type</th>
                                                <th>Taille</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($projectFiles as $key => $projectFile)
                                                <tr>
                                                    <td>{{ $projectFile->name }}</td>
                                                    <td>{{ Str::substr($projectFile->description, 0, 55) }}...</td>
                                                    <td>{{ $projectFile->file_type ?? '' }}</td>
                                                    <td>
                                                        @php
                                                            $size_mb = (int) $projectFile->file_size / (1024 * 1024); // Convert bytes to megabytes
                                                            $size_mb_formatted = number_format($size_mb, 2); // Format the result to display two decimal places
                                                        @endphp
                                                        {{ $size_mb_formatted }} MB
                                                    </td>
                                                    <td>
                                                        <div class="action-table-data">
                                                            <div class="edit-delete-action m-0">
                                                                <a target="_blank" href="{{ asset('storage/' . $projectFile->path) }}" class="download-icon me-2">
                                                                    <i class="feather-download"></i>
                                                                </a>
                                                                @if ($projectFile->added_by_user_id == Auth::user()->id)
                                                                    <form action="{{ route('project.files.delete', $projectFile->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="download-icon" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier?');">
                                                                            <i class="feather-trash-2"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    @if (count($projectFiles ?? []) == 0)
                                        <div class="text-center text-primary my-5">
                                            <i class="fa-brands fa-cloudversify fa-4x"></i>
                                            <h5 class="mt-1">Aucune donnée n'est spécifiée pour<br>le moment.</h5>
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
            $("#add-project-file-btn").click(function() {
                var project_id = $(this).data('project_id');
                $("#file_project_id").val(project_id);
                $("#add-project-file-modal").modal('show');
            });
        });
    </script>
@endsection
