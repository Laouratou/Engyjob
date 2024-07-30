@extends('layouts.app_welcome')

@section('content')


<!-- Home Banner -->
<section class="section home-banner row-middle home-two">
    <div class="container">
        <div class="row align-items-center">
            <div class=" col-lg-6 col-md-12">
                <div class="banner-content aos" data-aos="fade-up">
                    <div class="market-place">
                        <h3>Le #1 pour recherche de Freelances</h3>
                    </div>
                    <h1>Obtenez le parfait <br>Freelance & Projets</h1>
                    <form class="form" name="store" id="store" method="post" action="{{ route('search') }}">
                        @csrf
                        <div class="form-inner">
                            <div class="input-group">
                                <span class="drop-detail">
                                    <select class="form-control select" name="type_search">
                                        <option value="Projets">Projets</option>
                                        <option value="Freelancer">Freelancer</option>
                                    </select>
                                </span>
                                <input type="text" class="form-control" name="keywords" placeholder="Mots clés">
                                <button class="btn btn-primary sub-btn" type="submit">Rechercher</button>
                            </div>
                        </div>
                    </form>

                    <div class="home-count">
                        <ul class="nav">
                            <li class="course-count"><span class="counter-up">9,207</span><span
                                    class="list-count">Freelances</span></li>
                            <li class="course-count"><span class="counter-up">6000 </span><span>+</span><span
                                    class="list-count">Projets ajoutés</span></li>
                            <li class="course-count"><span class="counter-up">919,207</span><span
                                    class="list-count">Projets terminés</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-5">
                <div class="banner-two-img aos" data-aos="fade-up">
                    <img src="/assets/img/home-two-banner-bg-01.png" class="img-fluid trusted-user-img aos"
                        data-aos="zoom-in" alt="banner" data-aos-duration="3000">
                    <img src="/assets/img/home-two-banner-bg-02.png" class="img-fluid best-marketing-img aos"
                        data-aos="zoom-in" alt="banner" data-aos-duration="3000">
                </div>
            </div>
        </div>
        <div class="banner-top-bottom">
            <a href="#bottom-scroll"><i class="feather-arrow-down"></i></a>
        </div>
    </div>
</section>
<!-- /Home Banner -->
@if (session('status'))
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Succès</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ session('status') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('status'))
            var statusModal = new bootstrap.Modal(document.getElementById('statusModal'));
            statusModal.show();

            // Ferme automatiquement le modal après 5 secondes (5000 ms)
            setTimeout(function() {
                statusModal.hide();
            }, 5000);
        @endif
    });
</script>


<!-- Our Feature -->
<section class="section update-project" id="bottom-scroll">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12 mx-auto">
                <div class="section-header section-header-two text-center aos" data-aos="fade-up">
                    <h2 class="header-title"><span>Projets </span> Récemment mis à jour</h2>
                    <p>Faites du travail dans plus de 60 catégories différentes</p>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach ($categories as $category)
            <!-- Updated Item -->
            <div class="col-xl-3 col-md-6">
                <div class="aos" data-aos="fade-up">
                    <a href="{{ route('projects.liste', $category->id) }}" class="update-project-blk move-box ">
                        <div class="update-content">
                            <h6>{{ $category->name }}</h6>
                            <p>{{ $category->number_of_projects }} Projets</p>
                        </div>
                        <div class="update-icon-end">
                            <i class="feather-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
            <!-- /Updated Item -->
            @endforeach

            <div class="col-xl-12">
                <div class="more-project text-center aos" data-aos="fade-up">
                    <a href="{{ route('projects.liste') }}" class="btn btn-primary">Voir plus de projets</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Our Feature -->


<!-- Feature -->
<section class="section feature-project home-two-projects">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12 mx-auto">
                <div class="section-header section-header-two text-center aos" data-aos="fade-up">
                    <h2 class="header-title">Projets en vedette <span> Pour Vous</span></h2>
                    <p>Nous avons plus de 2000 projets qui vous attendent</p>
                </div>
            </div>
        </div>

        {{--
        <livewire:load-more-widget :lazy="false" /> --}}

        <div class="row">

            @forelse ($projects as $project)
            <!--- Project Item  -->
            <div class="col-lg-4 col-md-6 d-flex">
                <div class="project-item feature-project-item aos" data-aos="fade-up">
                    <div class="project-img">
                        <a href="{{ route('projects/details', $project) }}">
                            <img src="{{ asset($project->image) }}" alt="Img" class="img-fluid"></a>
                    </div>
                    <div class="feature-content">
                        <div class="feature-time-blk">
                            <a href="javascript:void(0);" class="btn btn-primary green-active">{{
                                $project->category->name }}</a>
                            <span><i class="far fa-clock me-1"></i>
                                {{ $project->created_at->diffForHumans() }}</span>
                        </div>
                        <h4><a href="{{ route('projects/details', $project) }}">{{ $project->name }}</a></h4>
                        <ul class="feature-project-list nav">
                            <li><i class="feather-user me-1"></i>{{ $project->category->name }}</li>
                            <li><i class="feather-map-pin me-1"></i>Ouaga.</li>
                        </ul>
                        <div class="feature-foot">
                            <div class="logo-company">
                                <a href="{{ route('projects/details', $project) }}">
                                    <img src="assets/img/icon/logo-icon-01.svg" class="me-1" alt="icon">
                                    <span>{{ $project->user->name }} {{ $project->user->first_name }}</span>
                                </a>
                            </div>
                            <a href="{{ route('projects/details', $project) }}" class="bid-now">Voir plus <i
                                    class="feather-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!--- /Project Item  -->
            @empty
            @include('exemples.projects_vedette')
            @endforelse


            <div class="col-xl-12">
                <div class="more-project text-center aos" data-aos="fade-up">
                    <a href="{{ route('projects.liste') }}" class="btn btn-primary">Voir plus de projets</a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Our Platform -->
<section class="section platform">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="plat-form-img aos" data-aos="fade-up">
                    <img src="assets/img/plat-form.png" alt="Img" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div class="platform-group aos" data-aos="fade-up">
                    <h1>Découvrez les projets près de votre emplacement <span> sur notre plateforme</span></h1>
                    <h5>S'inspirer des projets de développement</h5>
                    <p>
                        Nous fournissons un service stable avec des experts Les freelances du monde entier sont à la
                        recherche d'un emploi et fournissent le meilleur d'eux-mêmes. Faites l'expérience d'une
                        plateforme de marché de pointe avec {{ config('app.name') }}.
                    </p>
                    <div class="market-place-btn platform-btn">
                        <a href="{{ route('projects.liste') }}" class="btn btn-primary market-project me-2">Voir les
                            projets</a>
                        <a href="{{ route('projects.create') }}" class="btn btn-primary project-post">Publier un
                            projet</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- /Our Platform -->


<!-- Feature Developer -->
<section class="section feature-developer home-two-developers">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12 mx-auto">
                <div class="section-header section-header-two text-center aos" data-aos="fade-up">
                    <h2 class="header-title">Freelancers<span> En vedette </span></h2>
                    <p>Nous avons plus de 1400 freelancers </p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($freelancers as $freelancer)
            <div class="col-md-4 col-sm-6">
                <div class="feature-develop-blk aos" data-aos="fade-up">
                    <div class="developer-sub-blk">
                        <div class="img-developer">
                            <a href="{{ route('freelancers.profile', $freelancer->id) }}">
                                @if ($freelancer->profil && $freelancer->profil->photo)
                                <img src="{{ asset($freelancer->profil->photo) }}" class="me-2" alt="Img"
                                    style="object-fit: cover">
                                @else
                                <img src="{{ asset('placeholder.jpg') }}" class="me-2" alt="Placeholder Image">
                                @endif
                            </a>

                        </div>
                        <div class="developer-content">
                            <h4>
                                <a href="{{ route('freelancers.profile', $freelancer->id) }}">
                                    {{ $freelancer->name }}
                                    {{ $freelancer->first_name }}</a>
                            </h4>
                            <p>
                            @isset ($freelancer->profil->category )
                                {{ $freelancer->profil->category->name }}
                                @endisset
                            </p>
                            <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <span class="average-rating">5.0 (30)</span>
                            </div>
                        </div>
                    </div>
                    <div class="hour-rate">
                        <ul class="nav">
                            <li>
                                 {{ $freelancer->profil->prix }} CFA/h
                            </li>
                            <li><i class="feather-map-pin me-1"></i>Ouaga, BF</li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach


            <div class="col-xl-12">
                <div class="more-project text-center aos" data-aos="fade-up">
                    <a href="{{ route('freelancers.liste') }}" class="btn btn-primary">
                        Voir plus de freelancers
                    </a>
                </div>
                <div class="review-bottom text-center aos" data-aos="fade-up">
                    <div class="client-rate">
                        <h4>
                            Les clients ont évalué nos freelancers
                        </h4>
                        <div class="rating">
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <span class="average-rating">5.0 (30)</span>
                        </div>
                        <p>à partir de 4227 avis</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Feature Developer -->

<!-- Top skill -->
<section class="section top-skill">
    <div class="container">
        <div class="section-header section-header-two text-center aos" data-aos="fade-up">
            <h2 class="header-title">Compétences <span> En vedette</span></h2>
            <p>Travailler dans plus de 1800 catégories différentes </p>
        </div>
        <div class="row justify-content-center aos" data-aos="fade-up">
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-01.svg" alt="Img">
                    </div>
                    <span>Traduction</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-02.svg" alt="Img">
                    </div>
                    <span>Écriture de recherche</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-03.svg" alt="Img">
                    </div>
                    <span>Web Scraping</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-04.svg" alt="Img">
                    </div>
                    <span>Rédaction d'articles</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-05.svg" alt="Img">
                    </div>
                    <span>HTML 5</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-06.svg" alt="Img">
                    </div>
                    <span>Conception du site web</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-07.svg" alt="Img">
                    </div>
                    <span>Applications mobiles</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-08.svg" alt="Img">
                    </div>
                    <span>Applications Android</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-09.svg" alt="Img">
                    </div>
                    <span>Applications iOS</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-10.svg" alt="Img">
                    </div>
                    <span>Architecture des logiciels</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-11.svg" alt="Img">
                    </div>
                    <span>Conception graphique</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-12.svg" alt="Img">
                    </div>
                    <span>Conception du logo</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-13.svg" alt="Img">
                    </div>
                    <span>Relations publiques</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-14.svg" alt="Img">
                    </div>
                    <span>Relecture</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-15.svg" alt="Img">
                    </div>
                    <span>Photoshop</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-16.svg" alt="Img">
                    </div>
                    <span>Rédaction technique</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-17.svg" alt="Img">
                    </div>
                    <span>Blogging</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-18.svg" alt="Img">
                    </div>
                    <span>Marketing sur Internet</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-19.svg" alt="Img">
                    </div>
                    <span>eCommerce</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-20.svg" alt="Img">
                    </div>
                    <span>Saisie de données</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-21.svg" alt="Img">
                    </div>
                    <span>Création de liens</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-22.svg" alt="Img">
                    </div>
                    <span>Programmation C++</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-23.svg" alt="Img">
                    </div>
                    <span>Programmation C#</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-24.svg" alt="Img">
                    </div>
                    <span>Rédaction de contenu</span>
                </div>
            </div>
            <div class="skill-custom-col">
                <div class="skills-feature">
                    <div class="skill-icon">
                        <img src="assets/img/icon/skill-icon-25.svg" alt="Img">
                    </div>
                    <span>Marketing</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Top skill -->

<!-- Great About -->
<section class="section great-about">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12 mx-auto">
                <div class="section-header section-header-two text-center aos" data-aos="fade-up">
                    <h2 class="header-title">Ce qu'il y a de bien avec <span>{{ config('app.name', '-') }}</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="great-blk aos" data-aos="fade-up" style="min-height: 315px">
                    <div class="great-icon">
                        <img src="assets/img/icon/great-icon-01.svg" alt="Img">
                    </div>
                    <div class="great-content">
                        <h4>Parcourir les portefeuilles</h4>
                        <p>
                            Trouvez des professionnels en qui vous pouvez avoir confiance en consultant leurs
                            échantillons de travaux antérieurs et en lisant les avis sur leur profil.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="great-blk aos" data-aos="fade-up" style="min-height: 315px">
                    <div class="great-icon">
                        <img src="assets/img/icon/great-icon-02.svg" alt="Img">
                    </div>
                    <div class="great-content">
                        <h4>Offres rapides</h4>
                        <p>
                            Recevez rapidement des devis sans engagement de la part de nos freelances talentueux. 80 %
                            des projets font l'objet d'une offre
                            dans les 60 secondes.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="great-blk aos" data-aos="fade-up" style="min-height: 315px">
                    <div class="great-icon">
                        <img src="assets/img/icon/great-icon-03.svg" alt="Img">
                    </div>
                    <div class="great-content">
                        <h4>Travail de qualité</h4>
                        <p>Profitez de notre service de travail de délibér et de qualité.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="great-blk aos" data-aos="fade-up" style="min-height: 315px">
                    <div class="great-icon">
                        <img src="assets/img/icon/great-icon-04.svg" alt="Img">
                    </div>
                    <div class="great-content">
                        <h4>Suivre les progrès</h4>
                        <p>
                            Restez informé grâce à notre outil de suivi du temps et à notre application mobile.
                            Sachez toujours ce que font les freelances.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Great About -->

<!-- About Project -->
<section class="section about-project">
    <div class="about-position">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 d-flex">
                    <div class="about-it-blk w-100 aos" data-aos="fade-up">
                        <div class="about-it-img">
                            <a href="javascript:void(0);">
                                <img class="img-fluid" height="80" style="max-height: 280px; object-fit: cover"
                                    src="assets/img/about-it-01.jpg" alt="Img">
                            </a>
                        </div>
                        <div class="about-it-content text-center">
                            <h4>J'ai besoin d'un projet freelance</h4>
                            <p>
                                Trouvez le freelance parfait pour votre budget grâce à notre communauté créative.
                            </p>
                            <div class="more-project text-center mt-0">
                                <a href="{{ route('projects.create') }}" class="btn btn-primary project-post">Publier
                                    un projet</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="about-it-blk w-100 aos" data-aos="fade-up">
                        <div class="about-it-img">
                            <a href="javascript:void(0);">
                                <img class="img-fluid" height="20" src="assets/img/about-it-02.jpg"
                                    style="max-height: 280px; object-fit: cover" alt="Img">
                            </a>
                        </div>
                        <div class="about-it-content text-center">
                            <h4>Trouvez votre prochaine grande opportunité d'emploi !</h4>
                            <p>Vous voulez gagner de l'argent, trouver un nombre illimité de clients et construire votre
                                carrière de freelance ?</p>
                            <div class="more-project text-center mt-0">
                                <a href="{{ route('projects.liste') }}" class="btn btn-primary start-bid">Parcourir
                                    les projets</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /About Project -->

<!-- Job Location -->
{{-- <section class="section job-location home-two-jobsec">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12 mx-auto">
                <div class="section-header section-header-two d-block text-center section-locate aos"
                    data-aos="fade-up">
                    <h2 class="header-title">Jobs By <span>Locations</span></h2>
                    <p>Find your favourite jobs and get the benefits of yourself</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-4">
                <div class="job-locate-blk aos" data-aos="fade-up">
                    <div class="location-img">
                        <a href="project.html"><img class="img-fluid" src="assets/img/location/location-01.jpg"
                                alt="Img"></a>
                    </div>
                    <div class="job-it-content">
                        <h6>Nevada, USA</h6>
                        <ul class="nav job-locate-foot">
                            <li>80 Companies</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-4">
                <div class="job-locate-blk aos" data-aos="fade-up">
                    <div class="location-img">
                        <a href="project.html"><img class="img-fluid" src="assets/img/location/location-02.jpg"
                                alt="Img"></a>
                    </div>
                    <div class="job-it-content">
                        <h6>London, UK</h6>
                        <ul class="nav job-locate-foot">
                            <li>40 Companies</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-4">
                <div class="job-locate-blk aos" data-aos="fade-up">
                    <div class="location-img">
                        <a href="project.html"><img class="img-fluid" src="assets/img/location/location-03.jpg"
                                alt="Img"></a>
                    </div>
                    <div class="job-it-content">
                        <h6>Bangalore, India</h6>
                        <ul class="nav job-locate-foot">
                            <li>50 Companies</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-4">
                <div class="job-locate-blk aos" data-aos="fade-up">
                    <div class="location-img">
                        <a href="project.html"><img class="img-fluid" src="assets/img/location/location-04.jpg"
                                alt="Img"></a>
                    </div>
                    <div class="job-it-content">
                        <h6>Newyork, USA</h6>
                        <ul class="nav job-locate-foot">
                            <li>60 Companies</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-4">
                <div class="job-locate-blk aos" data-aos="fade-up">
                    <div class="location-img">
                        <a href="project.html"><img class="img-fluid" src="assets/img/location/location-05.jpg"
                                alt="Img"></a>
                    </div>
                    <div class="job-it-content">
                        <h6>Paris, France</h6>
                        <ul class="nav job-locate-foot">
                            <li>80 Companies</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-4">
                <div class="job-locate-blk aos" data-aos="fade-up">
                    <div class="location-img">
                        <a href="project.html"><img class="img-fluid" src="assets/img/location/location-06.jpg"
                                alt="Img"></a>
                    </div>
                    <div class="job-it-content">
                        <h6>Berlin, Germany</h6>
                        <ul class="nav job-locate-foot">
                            <li>50 Companies</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-4">
                <div class="job-locate-blk aos" data-aos="fade-up">
                    <div class="location-img">
                        <a href="project.html"><img class="img-fluid" src="assets/img/location/location-07.jpg"
                                alt="Img"></a>
                    </div>
                    <div class="job-it-content">
                        <h6>Amsterdam, Netherland</h6>
                        <ul class="nav job-locate-foot">
                            <li>30 Companies</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-4">
                <div class="job-locate-blk aos" data-aos="fade-up">
                    <div class="location-img">
                        <a href="project.html"><img class="img-fluid" src="assets/img/location/location-08.jpg"
                                alt="Img"></a>
                    </div>
                    <div class="job-it-content">
                        <h6>California, USA</h6>
                        <ul class="nav job-locate-foot">
                            <li>70 Companies</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="more-project text-center aos aos-init aos-animate" data-aos="fade-up">
                    <a href="project.html" class="btn btn-primary">View More Locations</a>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- /Job Location -->

<!-- Review -->
<section class="section review review-two">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header section-header-two text-center aos" data-aos="fade-up">
                    <h2 class="header-title">Avis des <span>Utilisateurs</span></h2>
                    <p>Ce que nos clients disent de nous </p>
                </div>
            </div>
        </div>
        <div class="row aos" data-aos="fade-up">
            <div class="col-lg-4 col-md-6">
                <!-- Review Widget -->
                <div class="review-blog user-review">
                    <div class="review-top ">
                        <div class="review-img mx-auto">
                            <a href="#">
                                <img class="img-fluid" style="object-fit: cover;" width="55" height="55"
                                    src="{{ asset('assets/img/review/review-01.jpg') }}" alt="Post Image">
                            </a>
                        </div>
                        <div class="review-info text-center">
                            <h3><a href="#">Durso Raeen</a></h3>
                            <h5>Chef de projet</h5>
                        </div>
                    </div>
                    <div class="review-content text-center">
                        <p>Respond to every review, both positive and negative. Thank clients for positive feedback and
                            address concerns in negative reviews professionally and empathetically.</p>
                    </div>
                    <div class="rating">
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <span class="average-rating">5.0</span>
                    </div>
                </div>
                <!-- / Review Widget -->
            </div>
            <div class="col-lg-4 col-md-6">
                <!-- Review Widget -->
                <div class="review-blog user-review">
                    <div class="review-top ">
                        <div class="review-img mx-auto">
                            <a href="#"><img class="img-fluid" src="assets/img/review/review-02.jpg"
                                    style="object-fit: cover;" width="55" height="55" alt="Post Image"></a>
                        </div>
                        <div class="review-info text-center">
                            <h3><a href="#">Camelia Rennesa</a></h3>
                            <h5>Chef d'équipe</h5>
                        </div>
                    </div>
                    <div class="review-content text-center">
                        <p>Respond promptly to reviews. Aim to acknowledge and reply to reviews within a reasonable
                            timeframe, ideally within 24-48 hours.</p>
                    </div>
                    <div class="rating">
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <span class="average-rating">5.0</span>
                    </div>
                </div>
                <!-- / Review Widget -->
            </div>
            <div class="col-lg-4 col-md-6">
                <!-- Review Widget -->
                <div class="review-blog user-review">
                    <div class="review-top">
                        <div class="review-img mx-auto">
                            <a href="#">
                                <img class="img-fluid" src="assets/img/review/review-03.jpg" style="object-fit: cover;"
                                    width="55" alt="Post Image">
                            </a>
                        </div>
                        <div class="review-info text-center">
                            <h3><a href="#">Brayan</a></h3>
                            <h5>Chef de projet</h5>
                        </div>
                    </div>
                    <div class="review-content text-center">
                        <p>Maintain a professional and courteous tone in all responses, even when addressing negative
                            reviews. Avoid getting defensive or confrontational.</p>
                    </div>
                    <div class="rating">
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star"></i>
                        <span class="average-rating">5.0</span>
                    </div>
                </div>
                <!-- / Review Widget -->
            </div>
        </div>
    </div>
</section>
<!-- / Review -->

<!-- Company Hire -->
{{-- <section class="section top-company-two border-bottom-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header section-header-two text-center aos" data-aos="fade-up">
                    <h2 class="header-title">Trusted By The <span>World’s Best</span></h2>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page
                        when looking at its layout. </p>
                </div>
            </div>
        </div>
        <div id="company-slider" class="owl-carousel owl-theme testimonial-slider aos" data-aos="fade-up">
            <div class="company-logos">
                <img src="assets/img/company-logo-01.svg" alt="Img">
            </div>
            <div class="company-logos">
                <img src="assets/img/company-logo-02.svg" alt="Img">
            </div>
            <div class="company-logos">
                <img src="assets/img/company-logo-03.svg" alt="Img">
            </div>
            <div class="company-logos">
                <img src="assets/img/company-logo-04.svg" alt="Img">
            </div>
            <div class="company-logos">
                <img src="assets/img/company-logo-05.svg" alt="Img">
            </div>
            <div class="company-logos">
                <img src="assets/img/company-logo-06.svg" alt="Img">
            </div>
            <div class="company-logos">
                <img src="assets/img/company-logo-03.svg" alt="Img">
            </div>
            <div class="company-logos">
                <img src="assets/img/company-logo-02.svg" alt="Img">
            </div>
        </div>
    </div>
</section> --}}
<!-- / Company Hire -->

<!-- News -->
{{-- <section class="section blog-tricks">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header section-header-two text-center aos" data-aos="fade-up">
                    <h2 class="header-title">Featured <span>Blogs</span></h2>
                    <p>Read Our Article To Get Tricks </p>
                </div>
            </div>
        </div>
        <div class="row aos" data-aos="fade-up">
            <div class="col-lg-4 col-md-6">
                <div class="grid-blog blog-two aos" data-aos="fade-up">
                    <div class="blog-image">
                        <a href="blog-details.html"><img class="img-fluid" src="assets/img/blog/blog-12.jpg"
                                alt="Post Image"></a>
                    </div>
                    <div class="blog-content">
                        <div class="feature-time-blk">
                            <span class="badge bg-pink d-flex align-items-center"><i
                                    class="feather-tag me-1"></i>Jobs</span>
                            <span><i class="far fa-calendar me-1"></i> 06 Oct, 2023</span>
                        </div>
                        <h3 class="blog-title mt-0"><a href="blog-details.html">Top 10 Resume Tips for Landing Your
                                Dream Job</a></h3>
                        <p>Customize your resume for each job application. Highlight skills and experiences that
                            align...</p>
                        <div class="blog-read">
                            <a href="blog-details.html">Read More <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="grid-blog blog-two aos" data-aos="fade-up">
                    <div class="blog-image">
                        <a href="blog-details.html"><img class="img-fluid" src="assets/img/blog/blog-13.jpg"
                                alt="Post Image"></a>
                    </div>
                    <div class="blog-content">
                        <div class="feature-time-blk">
                            <span class="badge bg-pink d-flex align-items-center"><i
                                    class="feather-tag me-1"></i>Jobs</span>
                            <span><i class="far fa-calendar me-1"></i> 06 Oct, 2023</span>
                        </div>
                        <h3 class="blog-title mt-0"><a href="blog-details.html">Navigating the Gig Economy:
                                Freelancing and Side Hustles</a></h3>
                        <p>Start by evaluating your skills, interests, and passions. What are you good at, and what...
                        </p>
                        <div class="blog-read">
                            <a href="blog-details.html">Read More <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="grid-blog blog-two aos" data-aos="fade-up">
                    <div class="blog-image">
                        <a href="blog-details.html"><img class="img-fluid" src="assets/img/blog/blog-14.jpg"
                                alt="Post Image"></a>
                    </div>
                    <div class="blog-content">
                        <div class="feature-time-blk">
                            <span class="badge bg-pink d-flex align-items-center"><i
                                    class="feather-tag me-1"></i>Jobs</span>
                            <span><i class="far fa-calendar me-1"></i> 06 Oct, 2023</span>
                        </div>
                        <h3 class="blog-title mt-0"><a href="blog-details.html">Interview Success: How to Ace Common
                                Interview Questions</a></h3>
                        <p>Select a weakness that is not a critical skill for the job and discuss how you've been
                            working...</p>
                        <div class="blog-read">
                            <a href="blog-details.html">Read More <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- / News -->

<!-- News -->
<section class="section job-register-two">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="register-job-blk justify-content-center">
                    <div class="job-content-blk text-center aos" data-aos="fade-up">
                        <h2>Trouvez votre prochaine grande opportunité d'emploi !</h2>
                        <p>Quisque pretium dolor turpis, quis blandit turpis semper ut. Nam malesuada eros nec luctus
                            laoreet.</p>
                    </div>
                    <div class="bg-img">
                        <img src="assets/img/bg/job-sec-bg-01.png" class="img-fluid job-right-bg" alt="Img">

                        <img src="assets/img/bg/job-sec-bg-02.png" class="img-fluid job-left-bg" alt="Img">
                    </div>
                </div>
                <div class="sign-in-btn text-center mt-5 aos" data-aos="fade-up">
                    <a href="login.html" class="btn btn-primary">S'inscrire sur {{ config('app.name', '-') }} </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endSection