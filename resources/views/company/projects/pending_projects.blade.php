@extends('layouts.app')

@section('content')
    <div class="content content-page">
        <div class="container">
            <div class="row">
                @include('components.company_side_bar', ['active' => 'dashboard'])

                <div class="col-xl-9 col-lg-8">
                    <div class="page-title">
                        <h3>Projets en attente</h3>
                    </div>
                    <!-- Proposals list -->
                    <div class="proposals-section ongoing-projects">

                        @forelse ($projects as $project)
                            <!-- Proposals -->
                            <div class="freelancer-proposals proposal-ongoing">
                                <div class="project-proposals align-items-center freelancer">
                                    <div class="proposal-info">
                                        <div class="proposals-details">
                                            <h3 class="proposals-title">{{ $project->name }}</h3>
                                            <ul>

                                                <li>
                                                    <div class="proposal-client-price">
                                                        <h4 class="title-info">Budget Client</h4>
                                                        <h3 class="client-price">
                                                            @if ($project->budget_type == 'hourly')
                                                                {{ number_format($project->budget ?? 0, 0, ',', ' ') }} CFA
                                                                -
                                                                {{ number_format($project->max_budget ?? 0, 0, ',', ' ') }}
                                                                CFA
                                                                <span class="price-type">
                                                                    (/heure)
                                                                </span>
                                                            @else
                                                                {{ number_format($project->budget ?? 0, 0, ',', ' ') }} CFA
                                                                <span class="price-type">
                                                                    (Fixe)
                                                                </span>
                                                            @endif
                                                        </h3>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="proposal-job-type">
                                                        <h4 class="title-info">Echeance du projet</h4>
                                                        <h3>{{ \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') }}
                                                        </h3>
                                                    </div>
                                                </li>
                                                <li>
                                                    @if ($project->freelancer_id != null)
                                                        <div class="proposal-img">
                                                            <div class="proposal-client d-flex align-items-center">
                                                                <img src="{{ asset($project->freelancer->profil->photo) }}"
                                                                    alt="Img" class="img-fluid me-2">
                                                                <div>
                                                                    <h4>{{ $project->freelancer->name }}
                                                                        {{ $project->freelancer->first_name }}</h4>
                                                                    <span>{{ '@' . $project->freelancer->profil->username }}<i
                                                                            class="fa-solid fa-star"></i>5.0</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </li>
                                                <li>
                                                    <div class="project-action text-center">
                                                        <a href="{{ route('company.projects.details', $project->id) }}"
                                                            class="projects-btn mb-0">Voir les détails</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Proposals -->
                        @empty
                            <div class="text-center text-primary my-5">
                                <i class="fa-brands fa-cloudversify fa-4x"></i>
                                <h5 class="mt-1">Aucune donnée n'est disponible pour<br>le
                                    moment.</h5>
                            </div>
                        @endforelse

                    </div>
                    <!-- /Proposals list -->
                </div>
            </div>
        </div>
    </div>
@endsection
