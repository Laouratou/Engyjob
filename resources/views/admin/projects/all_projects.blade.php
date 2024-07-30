@extends('layouts.app_admin')


@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Tous les projets</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a>
                            </li>
                            <li class="breadcrumb-item active">Catégories</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        {{-- <a href="javascript:void(0);" class="btn add-button me-2" data-bs-toggle="modal"
                            data-bs-target="#add-category">
                            <i class="fas fa-plus"></i>
                        </a> --}}
                        {{-- <a class="btn filter-btn" href="javascript:void(0);" id="filter_search">
                            <i class="fas fa-filter"></i>
                        </a> --}}
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Title</th>
                                            <th>Catégorie</th>
                                            <th>Utilisateur</th>
                                            <th>Freelanceur</th>
                                            <th>Budget</th>
                                            <th>Deadline</th>
                                            <th>Durée</th>
                                            <th>Type de freelanceur</th>
                                            <th>Expérience</th>
                                            <th>Compétences</th>
                                            <th>En vedette</th>
                                            <th>Est confidentiel</th>
                                            <th>Publié</th>
                                            <th>Statut</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($projects as $key => $project)
                                            <tr>
                                                <td>
                                                    {{ ++$key }}
                                                </td>
                                                <td>
                                                    <a target="_blank" href="{{ route('projects/details', $project->id) }}">
                                                        {{ $project->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $project->category->name }}</td>

                                                <td>{{ $project->user->name }} {{ $project->user->first_name }}
                                                    <div>
                                                        <span
                                                            class="badge bg-success-light">{{ $project->user->email }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($project->freelancer)
                                                        <a href="{{ route('freelancers.profile', $project->freelancer->id) }}"
                                                            target="_blank" rel="noopener noreferrer">
                                                            {{ $project->freelancer->name }}
                                                            {{ $project->freelancer->first_name }}
                                                        </a>
                                                        <div>
                                                            <span
                                                                class="badge bg-success-light">{{ $project->freelancer->email }}</span>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($project->budget_type == 'hourly')
                                                        {{ number_format($project->budget ?? 0, 0, ',', ' ') }} -
                                                        {{ number_format($project->max_budget ?? 0, 0, ',', ' ') }} CFA/h
                                                        <div>
                                                            <span class="badge bg-warning-light">Par heure</span>
                                                        </div>
                                                    @else
                                                        {{ number_format($project->budget ?? 0, 0, ',', ' ') }} CFA
                                                        <div>
                                                            <span class="badge bg-info-light">Fixe</span>
                                                        </div>
                                                    @endif
                                                </td>

                                                <td>{{ \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') }}</td>

                                                <td>{{ $project->projectDuration->name }}
                                                </td>

                                                <td>{{ $project->freelancerType->name }}</td>

                                                <td>{{ $project->freelancerLevel->name }}</td>

                                                <td>
                                                    @if (count($project->skills) > 1)
                                                        <div class="skill-required">
                                                            <div class="pro-content">
                                                                <div class="tags">
                                                                    @forelse ($project->skills as $skill)
                                                                        <span
                                                                            class="badge bg-primary-light">{{ $skill }}
                                                                        </span>
                                                                    @empty
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        -
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($project->en_vedette)
                                                        <span class="badge bg-success-light">Oui</span>
                                                    @else
                                                        <span class="badge bg-danger-light">Non</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($project->is_hidden)
                                                        <span class="badge bg-success-light">Oui</span>
                                                    @else
                                                        <span class="badge bg-danger-light">Non</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($project->is_active)
                                                        <span class="badge bg-success-light">Oui</span>
                                                    @else
                                                        <span class="badge bg-danger-light">Non</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @switch($project->status)
                                                        @case('pending')
                                                            <span class="badge bg-warning-light">En attente</span>
                                                        @break

                                                        @case('ongoing')
                                                            <span class="badge bg-success-light">En cours</span>
                                                        @break

                                                        @case('completed')
                                                            <span class="badge bg-success-light">Terminé</span>
                                                        @break

                                                        @case('canceled')
                                                            <span class="badge bg-danger-light">Annulé</span>
                                                        @break

                                                        @case('expired')
                                                            <span class="badge bg-danger-light">Expiré</span>
                                                        @break

                                                        @default
                                                            -
                                                    @endswitch
                                                </td>

                                                <td class="text-end">

                                                    @if ($project->is_active)
                                                        <button title="Activer"
                                                            class="btn btn-sm btn-success toggleActiveBtn"
                                                            data-model="Project" data-id="{{ $project->id }}">
                                                            <i class="fa-solid fa-circle-check"></i>
                                                        </button>
                                                    @else
                                                        <button title="Activer"
                                                            class="btn btn-sm btn-danger toggleActiveBtn"
                                                            data-model="Project" data-id="{{ $project->id }}">
                                                            <i class="fa-solid fa-circle-check"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $(".datatable tbody").on('click', '.toggleActiveBtn', function() {
                // alert('ok');

                var id = $(this).data('id');
                var model = $(this).data('model');

                $.ajax({
                    type: "POST",
                    data: {
                        id: id,
                        model: model
                    },
                    url: "{{ route('toggleActive') }}",
                    success: function(data) {
                        console.log(data);
                        //reload page
                        window.location.reload();

                    },
                    error: function(data) {
                        console.log(data);
                        //reload page
                        window.location.reload();
                    }
                })

            })

        })
    </script>
@endsection
