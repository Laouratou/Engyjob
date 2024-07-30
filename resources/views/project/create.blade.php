@extends('layouts.app_project')

@section('content')
    <div class="bread-crumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="col-md-12 col-12 text-center">
                    <div class="breadcrumb-list">
                        <h3>Poster un Projet</h3>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Accueil</a></li>
                                <li class="breadcrumb-item" aria-current="page">Poster un Projet</li>
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
                <div class="col-md-12">
                    <div class="select-project mb-4">
                        <form action="{{ route('projects.store') }}" method="post" class="project-form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="title-box widget-box">
                                @include('components.flash_message')
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4>Détails du projet</h4>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-3">
                                            <label class="focus-label">Titre du projet <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" placeholder="" name="name" class="form-control"
                                                id="name" value="{{ old('name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">

                                        <div class="mb-3">
                                            <label class="focus-label">Catégorie du projet <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control select" name="category_id">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="focus-label">Durée du projet <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control select" name="project_duration_id">
                                                @foreach ($projectDurations as $duree)
                                                    <option value="{{ $duree->id }}">{{ $duree->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 ">
                                        <div class="mb-3">
                                            <label for="deadline" class="focus-label">Date limite <span
                                                    class="text-danger">*</span></label>
                                            <div class="cal-icon">
                                                <input type="date" id="deadline" name="deadline" class="form-control"
                                                    placeholder="Choisir" value="{{ old('deadline') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label for="freelancer_type" class="focus-label">Freelancer Type <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <select class="form-control select" id="freelancer_type"
                                                name="freelancer_type_id">
                                                @foreach ($freelancerTypes as $freelancerType)
                                                    <option value="{{ $freelancerType->id }}">{{ $freelancerType->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label for="freelancer_level" class="focus-label">Niveau</label>
                                            <select class="form-control select" id="freelancer_level"
                                                name="freelancer_level_id">
                                                @foreach ($freelancerLevels as $freelancerLevel)
                                                    <option value="{{ $freelancerLevel->id }}">{{ $freelancerLevel->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-3">
                                            <label for="tags" class="focus-label">Tags</label>
                                            <select class="form-control select" id="tags" multiple name="tags[]">
                                                @foreach ($skills as $skill)
                                                    <option value="{{ $skill->id }}">{{ $skill->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 my-3">
                                        <h4>Compétences</h4>
                                    </div>
                                    <!-- Skills Content -->
                                    <div class="col-lg-12 col-md-12">
                                        <div class="title-content p-0">
                                            <div class="title-detail">
                                                <h3>Ensemble de compétences</h3>
                                                <div class="mb-3">
                                                    <input type="text" data-role="tagsinput"
                                                        class="input-tags form-control" name="services" value="Web Design"
                                                        id="services"
                                                        placeholder="UX, UI, App Design, Wireframing, Branding">
                                                    <p class="text-muted mb-0">Entrez les compétences nécessaire pour le
                                                        projet, pour de meilleurs
                                                        Résultats Ajouter 5 compétences ou plus</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 my-3">
                                        <h4>Budget</h4>
                                    </div>
                                    <div class="buget-img">
                                        <ul>
                                            <li>
                                                <div class="fixed-rate active">
                                                    <div class="hours-rate-img">
                                                        <label class="customize-radio">
                                                            <input type="radio" checked name="budget_type"
                                                                value="fixed" class="fixedradio">
                                                            <img src="{{ asset('assets/img/icon/check-success.svg') }}"
                                                                alt="img" class="success-check">
                                                            <img src="{{ asset('assets/img/icon/fixed.svg') }}"
                                                                alt="img">
                                                            <span class="d-block">Budget fixe</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="hours-rate">
                                                    <div class="hours-rate-img">
                                                        <label class="customize-radio">
                                                            <input type="radio" name="budget_type" value="hourly"
                                                                class="hoursradio">
                                                            <img src="{{ asset('assets/img/icon/check-success.svg') }}"
                                                                alt="img" class="success-check">
                                                            <img src="{{ asset('assets/img/icon/hourly.svg') }}"
                                                                alt="img">
                                                            <span class="d-block">Taux horaire</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="fixed-rates">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mb-3">
                                                    <label class="focus-label">Saisir le montant(F CFA) <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" name="budget" class="form-control "
                                                        placeholder="1 500 000" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hours-rates d-none">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-12">
                                                <div class="mb-3">
                                                    <label class="focus-label">De (F CFA) <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" name="min_budget" class="form-control "
                                                        placeholder="5 000">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 ">
                                                <div class="mb-3">
                                                    <label class="focus-label">A (F CFA) <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" name="max_budget" class="form-control "
                                                        placeholder="15 000">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 my-3">
                                        <h4>Pièce jointe</h4>
                                        <p>Vous pouvez joindre plus de 1 fichiers à 10 fichiers, la taille du document doit
                                            être
                                            En dessous de 2 Mo </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="attach-file">
                                            <i class="fa fa-pdf"></i>
                                            Pièce jointe
                                            <input type="file" name="project_files[]" id="file" multiple>
                                        </div>
                                        <div class="filename">
                                            <ul id="file-list">
                                                {{-- <li>
                                                    <h6>Filename 1
                                                        <a href="javascript:void(0);" class="file-close">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                    </h6>
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-12 my-3">
                                        <h4>Autre exigence</h4>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label class="focus-label">Langues</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label class="focus-label">Language Fluency</label>
                                            <select class="form-control select">
                                                <option>Basic</option>
                                                <option>Intermediate</option>
                                                <option>Professional</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="description" class="focus-label">Écrivez la description du
                                                projet <span class="text-danger">*</span></label>
                                            <textarea class="form-control summernote" id="description" name="description" rows="15" required></textarea>
                                        </div>
                                    </div>
                                    <!-- /Skills Content -->

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="cover_image" class="focus-label">Image de couverture ou
                                                logo</label>
                                            <input type="file" name="cover_image" class="form-control"
                                                id="cover_image">
                                        </div>
                                    </div>
                                </div>

                                <div class="proposal-features mt-4">
                                    <div class="proposal-widget proposal-warning">
                                        <label class="custom_check">
                                            <input type="checkbox" name="en_vedette" value="1">
                                            <span class="checkmark"></span>
                                            <span class="proposal-text">Projet en vedette</span>
                                            <span class="proposal-text float-end">{{ $config->pricevedette }}CFA</span>
                                        </label>
                                        <p>Votre projet sera affiché sur la page d'accueil et sera visible par les autres en
                                            premier</p>
                                    </div>

                                    <div class="proposal-widget proposal-blue">
                                        <label class="custom_check">
                                            <input type="checkbox" name="is_hidden" value="1">
                                            <span class="checkmark"></span>
                                            <span class="proposal-text">Projet confidentiel</span>
                                            <span class="proposal-text float-end">{{ $config->priceconfidentialite }} CFA</span>
                                        </label>
                                        <p>Votre projet sera traité avec une grande confidentialité</p>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-end">
                                        <div class="btn-item">
                                            <button type="reset" class="btn reset-btn">Réinitialiser</button>
                                            <button type="submit" class="btn next-btn">Publier l'offre</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Project Title -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
@endsection
