@extends('layouts.app')

@section('content')
    <div class="content content-page">
        <div class="container">
            <div class="row">
                @include('components.company_side_bar', ['active' => 'dashboard'])

                <div class="col-xl-9 col-lg-8">
                    <div class="dashboard-sec">
                        <div class="page-title">
                            <h3>Tous mes projets </h3>
                        </div>

                        @forelse ($projects as $project)
                            @if ($project->freelancer_id)
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
                                                                                <h3 class="flag-icon">
                                                                                    <img src="{{ asset('vendor/blade-flags/country-BF.svg') }}"
                                                                                        height="13" alt="Lang"> BF
                                                                                </h3>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="proposal-job-type">
                                                                                <h4 class="title-info">Expire</h4>
                                                                                <h3>
                                                                                    {{-- get how many days left --}}
                                                                                    <small>dans
                                                                                    </small>
                                                                                    {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($project->deadline)) }}
                                                                                    jours
                                                                                    {{-- {{ \Carbon\Carbon::parse($project->deadline)->diffInDays(\Carbon\Carbon::now()) }} --}}
                                                                                    {{-- - {{ $project->deadline }} --}}
                                                                                </h3>
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
                                                                                class="projects-btn">Voir les détails</a>
                                                                            <span>Embauché le
                                                                                {{ \Carbon\Carbon::parse($project->hired_on)->format('d m Y') }}</span>
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
                                                            alt="Img" class="img-fluid">
                                                        <p class="mb-0">{{ $project->freelancer->name }}
                                                            {{ $project->freelancer->first_name }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="my-projects-list ongoing-projects">
                                    <div class="row">
                                        <div class="col-xl-12 flex-wrap">
                                            <div class="freelancer-proposals proposal-ongoing mb-0">
                                                <div class="project-proposals align-items-center freelancer">
                                                    <div class="proposal-info">
                                                        <div class="proposals-details">
                                                            <span
                                                                class="tech-name-badge">{{ $project->user->company_name }}</span>
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
                                                                                <h3 class="flag-icon">
                                                                                    <img src="{{ asset('vendor/blade-flags/country-BF.svg') }}"
                                                                                        height="13" alt="Lang"> BF
                                                                                </h3>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="proposal-job-type">
                                                                                <h4 class="title-info">Expire</h4>
                                                                                <h3>
                                                                                    {{-- get how many days left --}}
                                                                                    <small>dans
                                                                                    </small>
                                                                                    {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($project->deadline)) }}
                                                                                    jours
                                                                                    {{-- {{ \Carbon\Carbon::parse($project->deadline)->diffInDays(\Carbon\Carbon::now()) }} --}}
                                                                                    {{-- - {{ $project->deadline }} --}}
                                                                                </h3>
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
                                                                                class="projects-btn">Détails</a>
                                                                            <a href="javascript:void(0);"
                                                                                class="mb-0">Supprimer</a>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="text-center text-primary">
                                <i class="fa-brands fa-cloudversify fa-4x"></i>
                                <h5 class="mt-1">Aucun projet n'est disponible pour<br>le moment.</h5>
                            </div>
                        @endforelse



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
