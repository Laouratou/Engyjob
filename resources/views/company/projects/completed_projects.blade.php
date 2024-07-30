@extends('layouts.app')

@section('content')
    <div class="content content-page">
        <div class="container">
            <div class="row">
                @include('components.company_side_bar', ['active' => 'dashboard'])

                <div class="col-xl-9 col-lg-8">
                    <div class="page-title">
                        <h3>Projets terminés</h3>
                    </div>
                    <!-- Proposals list -->
                    <div class="proposals-section ongoing-projects">

                        @forelse ($projects as $project)
                            <div class="my-projects-list ongoing-projects">
                                <div class="row">
                                    <div class="col-xl-9 flex-wrap">
                                        <div class="freelancer-proposals proposal-ongoing mb-0">
                                            <div class="project-proposals align-items-center freelancer">
                                                <div class="proposal-info">
                                                    <div class="proposals-details">
                                                        <span
                                                            class="tech-name-badge">{{ $project->user->company_name ?? '' }}
                                                        </span>
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="employee-project-card">

                                                                <h3 class="proposals-title">{{ $project->name }}</h3>
                                                                <ul>

                                                                    <li>
                                                                        <div class="proposal-job-type">
                                                                            <h4 class="title-info">Type de budget</h4>
                                                                            <h3>
                                                                                @if ($project->budget_type == 'hourly')
                                                                                    Par heure
                                                                                @else
                                                                                    Fixe
                                                                                @endif
                                                                            </h3>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="proposal-job-type">
                                                                            <h4 class="title-info">Emplacement</h4>
                                                                            <h3 class="flag-icon"><img
                                                                                    src="{{ asset('vendor/blade-flags/country-BF.svg') }}"
                                                                                    height="13" alt="Lang"> BF</h3>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="proposal-job-type">
                                                                            <h4 class="title-info">Expire</h4>
                                                                            <h3><small>dans
                                                                                </small>
                                                                                {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($project->deadline)) }}
                                                                                jours</h3>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="proposal-job-type">
                                                                            <h4 class="title-info">Budget</h4>
                                                                            <h3>
                                                                                @if ($project->budget_type == 'hourly')
                                                                                    {{ number_format($project->budget ?? 0, 0, ',', ' ') }}
                                                                                    CFA -
                                                                                    {{ number_format($project->max_budget ?? 0, 0, ',', ' ') }}
                                                                                    CFA
                                                                                @else
                                                                                    {{ number_format($project->budget ?? 0, 0, ',', ' ') }}
                                                                                    CFA
                                                                                @endif
                                                                            </h3>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <ul class="employee-project">
                                                                <li>
                                                                    <div class="project-action text-center">
                                                                        <a href="{{ route('company.projects.details', $project->id) }}"
                                                                            class="projects-btn">
                                                                            Voir les détails
                                                                        </a>
                                                                        <a href="javascript:void(0);"
                                                                            class="projects-btn completed-btn">
                                                                            <i class="fa fa-award me-2"></i>
                                                                            Terminé
                                                                        </a>
                                                                        @if ($project->review)
                                                                            <span>
                                                                                @for ($i = 0; $i < $project->review->rate; $i++)
                                                                                    <i class="fa-solid fa-star"></i>
                                                                                @endfor
                                                                                @for ($i = 0; $i < 5 - $project->review->rate; $i++)
                                                                                    <i
                                                                                        class="fa-solid fa-star text-muted"></i>
                                                                                @endfor
                                                                                ({{ $project->review->rate . '.0' }})
                                                                            </span>
                                                                        @else
                                                                            <a class="btn-write-review mb-0 projects-btn openReviewModal"
                                                                                data-project_id="{{ $project->id }}"
                                                                                data-freelancer_id="{{ $project->freelancer->id }}"
                                                                                data-freelancer_name="{{ $project->freelancer->name }}  {{ $project->freelancer->first_name }}"
                                                                                data-freelancer_photo="{{ $project->freelancer->profil->photo }}">Noter
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 d-flex flex-wrap">
                                        <div class="projects-card flex-fill">
                                            <div class="card-body p-2">
                                                <div class="prj-proposal-count text-center hired">
                                                    <h3>Embauché</h3>
                                                    <img src="{{ asset($project->freelancer->profil->photo) }}"
                                                        alt="Img" class="img-fluid"
                                                        style="height: 60px; width: 60px; object-fit: cover">
                                                    <p class="mb-0">{{ $project->freelancer->name }}
                                                        {{ $project->freelancer->first_name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
