@extends('layouts.app_project')

@section('content')
    <!-- Breadcrumb -->
    <div class="bread-crumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="col-md-12 col-12 text-center">
                    <div class="breadcrumb-list">
                        <h2>Détails du Freelancer</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                                <li class="breadcrumb-item" aria-current="page">Détails Du Freelancers</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="company-detail-block pt-0">
                        <div class="company-detail">
                            <div class="company-detail-image">
                                <img src="{{ asset($freelancer->profil->photo) }}" class="img-fluid" alt="logo">
                            </div>
                            <div class="company-title">
                                <h4>{{ $freelancer->name }} {{ $freelancer->first_name }}</h4>

                                <p>
                                    @if ($freelancer->profil->category)
                                        {{ $freelancer->profil->category->name }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="company-address">
                            <ul>
                                <li>
                                    <i class="feather-map-pin"></i>{{ $freelancer->profil->ville }},
                                </li>
                                <li>
                                    <i
                                        class="feather-calendar"></i>{{ \Carbon\Carbon::parse($freelancer->profil->created_at)->format('d M, Y') }}
                                </li>
                                <li>
                                    <i class="feather-star"></i>5.0, 245 Reviews
                                </li>
                            </ul>
                        </div>
                        <div class="project-proposal-detail">
                            <ul>
                                <li>
                                    <div class="proposal-detail-img">
                                        <img src="{{ asset('/assets/img/icon/computer-line.svg') }}" alt="icons">
                                    </div>
                                    <div class="proposal-detail text-capitalize">
                                        <span class=" d-block">Recommandée</span>
                                        <p class="mb-0">89%</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="proposal-detail-img">
                                        <img src="{{ asset('assets/img/icon/time-line.svg') }}" alt="icons">
                                    </div>
                                    <div class="proposal-detail text-capitalize">
                                        <span class=" d-block">Projets achevés</span>
                                        <p class="mb-0">220</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="proposal-detail-img">
                                        <img src="{{ asset('assets/img/icon/time-line.svg') }}" alt="icons">
                                    </div>
                                    <div class="proposal-detail text-capitalize">
                                        <span class=" d-block">Projets en cours</span>
                                        <p class="mb-0">10</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="proposal-detail-img">
                                        <img src="{{ asset('/assets/img/icon/user-heart-line.svg') }}" alt="icons">
                                    </div>
                                    <div class="proposal-detail text-capitalize">
                                        <span class=" d-block">Feedbacks</span>
                                        <p class="mb-0">78</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="proposal-detail-img">
                                        <img src="{{ asset('/assets/img/icon/translate-2.svg') }}" alt="icons">
                                    </div>
                                    <div class="proposal-detail text-capitalize">
                                        <span class=" d-block">Réembaucher</span>
                                        <p class="mb-0">Oui</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="proposal-detail-img">
                                        <img src="{{ asset('assets/img/icon/translate.svg') }}" alt="icons">
                                    </div>
                                    <div class="proposal-detail text-capitalize">
                                        <span class=" d-block">Temps de réponse</span>
                                        <p class="mb-0">1 Heure</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="company-detail-block company-description">
                        <h4 class="company-detail-title">Aperçu</h4>
                        <p>{!! $freelancer->profil->apercu !!}</p>
                    </div>
                    <div class="company-detail-block company-description">
                        <h4 class="company-detail-title">Expérience</h4>
                        @foreach ($freelancer->experiences as $experience)
                            <div class="experience-set">
                                <div class="experience-set-img">
                                    <img src="/assets/img/icon/expereience.png" alt="img">
                                </div>
                                <div class="experience-set-content">
                                    <h5>{{ $experience->company_name }}<span>{{ \Carbon\Carbon::parse($experience->start_date)->format('d M, Y') }}
                                            - {{ \Carbon\Carbon::parse($experience->end_date)->format('d M, Y') }}</span>
                                    </h5>
                                    <span>{{ $experience->position }}</span>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="company-detail-block company-description">
                        <h4 class="company-detail-title">Education</h4>

                        @foreach ($freelancer->educations as $education)
                            <div class="experience-set">
                                <div class="experience-set-img">
                                    <img src="/assets/img/icon/report.png" alt="img">
                                </div>
                                <div class="experience-set-content">
                                    <h5>{{ $education->name }}<span>{{ $education->year_of_start }} -
                                            {{ $education->year_of_end }}</span></h5>
                                    <span>{{ $education->university }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($reviews->count() > 0)
                        <div class="company-detail-block pb-0">
                            <h4 class="company-detail-title">Avis ({{ $reviews->count() }})</h4>

                            @foreach ($reviews as $review)
                                <div class="project-proposals-block ">
                                    <div class="project-proposals-img">
                                        <img src="{{ asset($review->user->profil->photo) }}" class="img-fluid avatar"
                                            alt="user">
                                    </div>
                                    <div class="project-proposals-description">
                                        <div class="proposals-user-detail">
                                            <div>
                                                <h5>
                                                    @if ($review->user->company_name)
                                                        {{ $review->user->company_name }}
                                                    @else
                                                        {{ $review->user->name }} {{ $review->user->lastname }}
                                                    @endif
                                                </h5>
                                                <ul class="d-flex">
                                                    <li>
                                                        <div class="proposals-user-review">
                                                            <span><i
                                                                    class="fa fa-star"></i>{{ $review->rate . '.0' }}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="proposals-user-review">
                                                            <span><i
                                                                    class="feather-calendar"></i>{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div>
                                                <div class="proposals-pricing">
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0">
                                            {!! $review->comment !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endif

                </div>

                <!-- Blog Sidebar -->
                <div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar project-client-view">
                    <div class="card budget-widget">
                        <div class="budget-widget-details">
                            <h6>Budget</h6>
                            <h4>{{ number_format($freelancer->profil->prix ?? 0, 0, ',', ' ') }} CFA</h4>
                            <p class="mb-0">Par heure</p>
                            <ul class="buget-profiles">
                                <li>
                                    <h6><i class="feather-map-pin me-2"></i>Lieu de travail</h6>
                                    <h5>{{ $freelancer->profil->ville }}, {{ $freelancer->profil->pays }}</h5>
                                </li>
                                <li>
                                    <h6><i class="feather-airplay me-2"></i>Années d'expérience</h6>
                                    <h5>5 Années</h5>
                                </li>
                                <li>
                                    <h6><i class="feather-calendar me-2"></i>Délai de livraison</h6>
                                    <h5>3-5 Jours</h5>
                                </li>
                                <li>
                                    <h6><i class="feather-phone me-2"></i>Téléphone</h6>
                                    <h5>{{ $freelancer->phone }}</h5>
                                </li>

                                <li>
                                    <h6><i class="feather-mail me-2"></i>E-mail</h6>
                                    <h5>{{ $freelancer->email }}</h5>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <a data-bs-toggle="modal" href="#file" class="btn proposal-btn btn-primary">Envoyer une
                                invitation</a>
                        </div>
                    </div>
                    <div class="card budget-widget">
                        <h6>Compétences</h6>
                        <div class="tags">
                            @if ($freelancer->profil->category)
                                <a href="javascript:void(0);"><span class="badge badge-pill badge-design">
                                        {{ $freelancer->profil->category->name }}
                                    </span>
                                </a>
                            @endif
                            @foreach ($freelancer->skills as $skill)
                                <a href="javascript:void(0);">
                                    <span class="badge badge-pill badge-design">{{ $skill->skill->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="card budget-widget">
                        <h6>Zone d'activité</h6>
                        <div class="map-location p-0">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d2965.0824050173574!2d-93.63905729999999!3d41.998507000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sWebFilings%2C+University+Boulevard%2C+Ames%2C+IA!5e0!3m2!1sen!2sus!4v1390839289319"></iframe>
                        </div>
                    </div>


                </div>
                <!-- /Blog Sidebar -->

            </div>
        </div>
    </div>
    <!-- /Page Content -->
@endsection
