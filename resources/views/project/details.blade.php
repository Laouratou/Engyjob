@extends('layouts.app_project')

@section('content')
        <!-- Breadcrumb -->
        <div class="bread-crumb-bar">
                <div class="container">
                        <div class="row align-items-center inner-banner">
                                <div class="col-md-12 col-12 text-center">
                                        <div class="breadcrumb-list">
                                                <h2>Détails du Projet</h2>
                                                <nav aria-label="breadcrumb" class="page-breadcrumb">
                                                        <ol class="breadcrumb">
                                                                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                                                                <li class="breadcrumb-item" aria-current="page">Détails du Projet</li>
                                                        </ol>
                                                </nav>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        <!-- /Breadcrumb -->

        <!-- Page Content -->
        <div class="content">
                <div class="container">
                        <div class="row">
                                <div class="col-lg-8 col-md-12">
                                        <div class="company-detail-block pt-0">
                                                <div class="company-detail">
                                                <div class="company-detail-image">
    @if ($project->user && $project->user->profil && $project->user->profil->photo)
        <img src="{{ asset($project->user->profil->photo) }}" class="img-fluid" alt="logo">
    @else
        <img src="{{ asset('default-image.jpg') }}" class="img-fluid" alt="default logo"> <!-- image par défaut -->
    @endif
</div>

                                                        <div class="company-title">
                                                                <p>{{ $project->user->name }} {{ $project->user->first_name }}</p>
                                                                <h4>{{ $project->name }}</h4>
                                                        </div>
                                                </div>
                                                <div class="company-address">
                                                        <ul>
                                                                <li>
                                                                        <i class="feather-map-pin"></i>Ouagadougou
                                                                </li>
                                                                <li>
                                                                        <i class="feather-calendar"></i>{{ $project->created_at->format('d M, Y') }}
                                                                </li>
                                                                <li>
                                                                        <i class="feather-eye"></i>902 Vues
                                                                </li>
                                                                <li>
                                                                        <i class="feather-edit-2"></i>15 offres
                                                                </li>

                                                        </ul>
                                                </div>
                                                <div class="project-proposal-detail">
                                                        <ul>
                                                                <li>
                                                                        <div class="proposal-detail-img">
                                                                                <img src="/assets/img/icon/computer-line.svg" alt="icons">
                                                                        </div>
                                                                        <div class="proposal-detail text-capitalize">
                                                                                <span class=" d-block">Type de Freelancer</span>
                                                                                <p class="mb-0">{{ $project->freelancerType->name }}</p>
                                                                        </div>
                                                                </li>
                                                                <li>
                                                                        <div class="proposal-detail-img">
                                                                                <img src="/assets/img/icon/time-line.svg" alt="icons">
                                                                        </div>
                                                                        <div class="proposal-detail text-capitalize">
                                                                                <span class="d-block">Type de Projet</span>
                                                                                <p class="mb-0">
                                                                                        @if ($project->budget_type == 'hourly')
                                                                                                Horaire
                                                                                        @else
                                                                                                Fixe
                                                                                        @endif
                                                                                </p>
                                                                        </div>
                                                                </li>
                                                                <li>
                                                                        <div class="proposal-detail-img">
                                                                                <img src="/assets/img/icon/time-line.svg" alt="icons">
                                                                        </div>
                                                                        <div class="proposal-detail text-capitalize">
                                                                                <span class=" d-block">Durée du Projet</span>
                                                                                <p class="mb-0">
                                                                                        {{ $project->projectDuration->name }}
                                                                                </p>
                                                                        </div>
                                                                </li>
                                                                <li>
                                                                        <div class="proposal-detail-img">
                                                                                <img src="/assets/img/icon/user-heart-line.svg" alt="icons">
                                                                        </div>
                                                                        <div class="proposal-detail text-capitalize">
                                                                                <span class=" d-block">Experience</span>
                                                                                <p class="mb-0">{{ $project->freelancerLevel->name }}</p>
                                                                        </div>
                                                                </li>
                                                                <li>
                                                                        <div class="proposal-detail-img">
                                                                                <img src="/assets/img/icon/translate-2.svg" alt="icons">
                                                                        </div>
                                                                        <div class="proposal-detail text-capitalize">
                                                                                <span class=" d-block">Langue</span>
                                                                                <p class="mb-0">Français</p>
                                                                        </div>
                                                                </li>
                                                                <li>
                                                                        <div class="proposal-detail-img">
                                                                                <img src="/assets/img/icon/translate.svg" alt="icons">
                                                                        </div>
                                                                        <div class="proposal-detail text-capitalize">
                                                                                <span class=" d-block">Maîtrise de la langue</span>
                                                                                <p class="mb-0">Conversation</p>
                                                                        </div>
                                                                </li>
                                                        </ul>
                                                </div>
                                        </div>
                                        <div class="company-detail-block company-description">
                                                <h4 class="company-detail-title">Description</h4>
                                                <p>
                                                        {!! $project->description !!}
                                                </p>
                                        </div>


                                        @if (count($project->skills ?? []) > 1)
                                                <div class="company-detail-block company-description">
                                                        <h4 class="company-detail-title">Compétences additionnelles</h4>
                                                        <div class="tags">

                                                                @foreach ($project->skills as $item)
                                                                        <a href="javascript:void(0);"><span
                                                                                        class="badge badge-pill badge-design">{{ $item }}</span></a>
                                                                @endforeach

                                                        </div>
                                                </div>
                                        @endif


                                        @if (count($project->projectFiles) > 0)
                                                <div class="company-detail-block">
                                                        <h4 class="company-detail-title">Pièces jointes</h4>
                                                        <div class="row row-gap">

                                                                @foreach ($project->projectFiles as $projectFile)
                                                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                                                                <div class="attachment-file">
                                                                                        <div class="attachment-files-details">
                                                                                                <h6>{{ $projectFile->name }}</h6>
                                                                                                @php
                                                                                                        $size_mb = (int) $projectFile->size / (1024 * 1024); // Convert bytes to megabytes
                                                                                                        $size_mb_formatted = number_format($size_mb, 2); // Format the result to display two decimal places
                                                                                                @endphp
                                                                                                <span>Taille {{ $size_mb_formatted }} MB</span>
                                                                                        </div>
                                                                                        <a target="_blank" href="{{ asset('storage/' . $projectFile->path) }}"
                                                                                                class="file-download-btn">
                                                                                                <i class="fa-solid fa-download"></i>
                                                                                        </a>
                                                                                </div>
                                                                        </div>
                                                                @endforeach

                                                        </div>
                                                </div>
                                        @endif

                                        {{-- <div class="company-detail-block company-description">
                                                <h4 class="company-detail-title">Tags</h4>
                                                <div class="tags">
                                                        <a href="javascript:void(0);"><span class="badge badge-pill badge-design">Machine
                                                                        Learning</span></a>
                                                        <a href="javascript:void(0);"><span class="badge badge-pill badge-design">AI
                                                                        Chatbot</span></a>
                                                        <a href="javascript:void(0);"><span class="badge badge-pill badge-design">Virtual
                                                                        Assistant</span></a>
                                                </div>
                                        </div> --}}

                                        @auth
                                                @if (auth()->user()->user_type == 'freelancer')
                                                        <div class="company-detail-block pb-0">
                                                                <h4 class="company-detail-title">Propositions du projet ({{ count($project->proposals) }})</h4>
                                                                @forelse ($project->proposals as $proposalKey => $proposal)
                                                                        <div class="project-proposals-block ">
                                                                                <div class="project-proposals-img">
                                                                                        <img src="{{ asset($proposal->user->profil->photo) }}" class="img-fluid"
                                                                                                alt="user">
                                                                                </div>
                                                                                <div class="project-proposals-description">
                                                                                        <div class="proposals-user-detail">
                                                                                                <div>
                                                                                                        <h5>{{ $proposal->user->name }} {{ $proposal->user->first_name }}</h5>
                                                                                                        <ul class="d-flex">
                                                                                                                <li>
                                                                                                                        <div class="proposals-user-review">
                                                                                                                                <span><i class="fa fa-star"></i>5.0</span>
                                                                                                                        </div>
                                                                                                                </li>
                                                                                                                <li>
                                                                                                                        <div class="proposals-user-review">
                                                                                                                                <span><i
                                                                                                                                                class="feather-calendar"></i>{{ \Carbon\Carbon::parse($proposal->created_at)->diffForHumans() }}</span>
                                                                                                                        </div>
                                                                                                                </li>
                                                                                                        </ul>
                                                                                                </div>

                                                                                                <div>
                                                                                                        <div class="proposals-pricing">
                                                                                                                <h4>{{ number_format($proposal->price ?? 0, 0, ',', ' ') }} CFA</h4>
                                                                                                                {{-- <span>Price : Fixed </span> --}}
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                                                                        <span class="mb-0">
                                                                                                {!! $proposal->letter_cover !!}
                                                                                        </span>
                                                                                </div>
                                                                        </div>
                                                                @empty
                                                                        <div class="row">
                                                                                <div class="col-12 text-center">

                                                                                        <i class="fa-solid fa-triangle-exclamation text-muted fa-5x"></i>
                                                                                        <br>

                                                                                        <label class="my-4 text-muted">Soyez le premier à laisser une proposition</label>
                                                                                        <br>
                                                                                        <a class="btn btn-primary btn-lg btn_faire_proposition"
                                                                                                data-project_id="{{ $project->id }}">
                                                                                                Faire une proposition
                                                                                        </a>

                                                                                </div>
                                                                        </div>
                                                                @endforelse

                                                        </div>
                                                @endif
                                        @endauth

                                </div>

                                <!-- Blog Sidebar -->
                                <div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar project-client-view">
                                        <div class="card budget-widget">
                                                <div class="budget-widget-details">
                                                        <h6>Budget</h6>
                                                        @if ($project->budget_type == 'fixed')
                                                                <h4>{{ number_format($project->budget ?? 0, 0, ',', ' ') }} CFA</h4>
                                                                <p class="mb-0">Fixe</p>
                                                        @else
                                                                <h4>{{ number_format($project->budget ?? 0, 0, ',', ' ') }} CFA -
                                                                        {{ number_format($project->max_budget ?? 0, 0, ',', ' ') }} CFA</h4>
                                                                <p class="mb-0">Par Heure</p>
                                                        @endif
                                                </div>
                                                @auth
                                                        @if (auth()->user()->user_type == 'freelancer')
                                                                <div>
                                                                        <a class="btn proposal-btn btn-primary btn_faire_proposition"
                                                                                data-project_id="{{ $project->id }}">
                                                                                Faire une proposition
                                                                        </a>
                                                                </div>
                                                        @endif
                                                @endauth

                                        </div>
                                        <div class="card budget-widget">
                                                <div class="budget-widget-details">
                                                        <h6>A propos du client</h6>
                                                        <div class="company-detail-image">
                                                                <img src="/assets/img/default-logo.svg" class="img-fluid" alt="logo">
                                                        </div>
                                                        <h5>{{ $project->user->name }} {{ $project->user->first_name }}</h5>
                                                        <span>Membre depuis
                                                                {{ \Carbon\Carbon::parse($project->user->created_at)->format('d/m/Y') }}</span>
                                                        <div class="rating mb-3">
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <span class="average-rating">5.0</span>
                                                        </div>
                                                        <ul class="d-flex list-style mb-0 social-list">
                                                                <li>
                                                                        <a href="javascript:void(0);" class="social-link-block">
                                                                                <i class="fa-brands fa-facebook-f"></i>
                                                                        </a>
                                                                </li>
                                                                <li>
                                                                        <a href="javascript:void(0);" class="social-link-block">
                                                                                <i class="fab fa-twitter"></i>
                                                                        </a>
                                                                </li>
                                                                <li>
                                                                        <a href="javascript:void(0);" class="social-link-block">
                                                                                <i class="fa-brands fa-linkedin-in"></i>
                                                                        </a>
                                                                </li>
                                                                <li>
                                                                        <a href="javascript:void(0);" class="social-link-block">
                                                                                <i class="fa-brands fa-instagram"></i>
                                                                        </a>
                                                                </li>
                                                        </ul>
                                                        <ul class="d-flex list-style mb-0 client-detail-list">
                                                                <li>
                                                                        <span>Domaine</span>

                                                                        <p class="mb-0">
    @if (auth()->user() && auth()->user()->profil && auth()->user()->profil->category)
        {{ auth()->user()->profil->category->name ?? '' }}
    @endif
</p>

                                                                </li>
                                                                <li>
                                                                        <span>Employées</span>
                                                                        <p class="mb-0">30-50</p>
                                                                </li>
                                                        </ul>
                                                </div>
                                                @auth
                                                        @if (auth()->user()->user_type == 'freelancer')
                                                                <div>
                                                                        <a href="javascript:void(0);" class="btn   btn-primary price-btn btn-block">Contactez Moi
                                                                        </a>
                                                                </div>
                                                        @endif
                                                @endauth
                                        </div>
                                        <div class="card budget-widget">
                                                <ul class="d-flex mb-0 list-style job-list-block">
                                                        <li>
                                                                <span>Offres publiées</span>
                                                                <p class="mb-0">48</p>
                                                        </li>

                                                        <li>
                                                                <span>Tâches ouvertes</span>
                                                                <p class="mb-0">75</p>
                                                        </li>
                                                        <li>
                                                                <span>Paiements</span>
                                                                <p class="mb-0">22</p>
                                                        </li>
                                                        <li>
                                                                <span>Embauché</span>
                                                                <p class="mb-0">64</p>
                                                        </li>
                                                        <li>
                                                                <span>Active</span>
                                                                <p class="mb-0">29</p>
                                                        </li>
                                                </ul>
                                        </div>
                                </div>
                                <!-- /Blog Sidebar -->

                        </div>
                </div>
        </div>
        <!-- /Page Content -->
@endsection
<!-- Inclure jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Inclure Bootstrap JS (assurez-vous d'inclure le bundle complet si vous utilisez Bootstrap 5) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


        <script>
                $(document).ready(function() {
                        $('.btn_faire_proposition').on('click', function() {
                                var project_id = $(this).data('project_id');
                                $('#makeProposalModal_project_id').val(project_id);
                                $('#makeProposalModal').modal('show');
                        });
                });
        </script>
