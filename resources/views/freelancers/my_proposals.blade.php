@extends('layouts.app')

@section('content')
    <div class="content content-page">
        <div class="container">
            <div class="row">
                @include('components.freelancers_side_bar', ['active' => 'dashboard'])

                <div class="col-xl-9 col-lg-8">
                    <div class="page-title">
                        <h3>Mes propositions</h3>
                    </div>
                    <!-- <nav class="user-tabs mb-4">
                                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="freelancer-project-proposals.html">My Proposals</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="freelancer-ongoing-projects.html">Ongoing Projects</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="freelancer-completed-projects.html">Completed Projects</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="freelancer-cancelled-projects.html">Cancelled Projects</a>
                                        </li>
                                    </ul>
                                </nav>  -->

                    <!-- Proposals list -->
                    <div class="proposals-section">

                        @forelse ($proposals as $proposal)
                            <div class="freelancer-proposals">
                                <div class="project-proposals align-items-center freelancer">
                                    <div class="proposal-info">
                                        <div class="proposals-details">
                                            <h3 class="proposals-title">{{ $proposal->project->name }}
                                            </h3>
                                            <ul>
                                                <li>
                                                    <div class="proposal-img">
                                                        <div class="proposal-client">
                                                            <img src="{{ asset($proposal->project->user->profil->photo) }}"
                                                                alt="Img" class="img-fluid">
                                                            <h4>
                                                                @if ($proposal->project->user->company_name)
                                                                    {{ $proposal->project->user->company_name }}
                                                                @else
                                                                    {{ $proposal->project->user->name }}
                                                                    {{ $proposal->project->user->first_name }}
                                                                @endif
                                                            </h4>
                                                            @if ($proposal->project->freelancer_id == $proposal->user_id)
                                                                <span class="badge badge-success text-white">
                                                                    Félicitation, Vous avez été choisi.
                                                                </span>
                                                            @else
                                                                <span class="info-btn">
                                                                    client
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="proposal-client-price">
                                                        <h4 class="title-info">Budget du Client</h4>
                                                        <h3 class="client-price">
                                                            @if ($proposal->project->budget_type == 'hourly')
                                                                {{ number_format($proposal->project->budget ?? 0, 0, ',', ' ') }}
                                                                CFA -
                                                                {{ number_format($proposal->project->max_budget ?? 0, 0, ',', ' ') }}
                                                                CFA
                                                                {{-- <span class="price-type">( /heure )</span> --}}
                                                            @else
                                                                {{ number_format($proposal->project->budget ?? 0, 0, ',', ' ') }}
                                                                CFA
                                                                {{-- <span class="price-type">( Fixe )</span> --}}
                                                            @endif
                                                        </h3>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="proposal-job-type">
                                                        <h4 class="title-info">Type de budget</h4>
                                                        <h3>
                                                            @if ($proposal->project->budget_type == 'hourly')
                                                                Par heure
                                                            @else
                                                                Fixe
                                                            @endif
                                                        </h3>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="project-amount">
                                                        <h4 class="title-info">Ton budget</h4>
                                                        <h3>{{ number_format($proposal->price ?? 0, 0, ',', ' ') }}
                                                            CFA <span>(en
                                                                {{ $proposal->number_delivery_days }} jours)</span></h3>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="project-action text-center">
                                                        @if ($proposal->project->freelancer_id != $proposal->user_id)
                                                            <a data-bs-toggle="modal" href="#file" class="projects-btn">
                                                                <i class="fa-solid fa-file-pen"></i>
                                                            </a>
                                                        @endif

                                                        @if ($proposal->project->freelancer_id == $proposal->user_id)
                                                            <a
                                                                href="{{ route('freelancers.projects.details', $proposal->project_id) }}">
                                                                <i class="fa-regular fa-eye"></i>
                                                            </a>
                                                        @endif
                                                        @if ($proposal->project->freelancer_id != $proposal->user_id)
                                                            <a href="javascript:void(0);" class="proposal-delete mb-0">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty
                        @endforelse
                        <!-- Proposals -->
                    </div>
                    <!-- /Proposals list -->
                </div>
            </div>
        </div>
    </div>
@endsection
