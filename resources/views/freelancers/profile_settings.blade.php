@extends('layouts.app')

@section('content')
    <div class="content content-page">
        <div class="container">
            <div class="row">
                @if (auth()->user()->user_type == 'freelancer')
                    @include('components.freelancers_side_bar', ['active' => 'profile_settings'])
                @else
                    @include('components.company_side_bar', ['active' => 'profile_settings'])
                @endif

                <div class="col-xl-9 col-lg-8">
                    <div class="pro-pos">
                        <div class="setting-content">
                            <form action="{{ route('freelancers.profile.settings') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="pro-head">
                                        <h3>Paramètre de profil</h3>
                                    </div>
                                    <div class="pro-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-row pro-pad pt-0 ps-0">
                                                    <div class="input-block col-md-6 pro-pic">
                                                        <label class="form-label">Photo de profil</label>
                                                        <div class="d-flex align-items-center">
                                                            <div class="upload-images freelancer-pic-box">
                                                                
                                                            </div>
                                                            <div class="ms-3 freelancer-pic-upload">
                                                                <label class="file-upload image-upbtn">
                                                                    Téléverser une image <input type="file"
                                                                        id="imgInp" name="image">
                                                                </label>
                                                                <p>Taille Max 300*300</p>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Prénom(s)</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $user->first_name }}" name="first_name">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Nom</label>
                                                    <input type="text" class="form-control" value="{{ $user->name }}"
                                                        name="name">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Numéro de téléphone</label>
                                                    <input type="text" class="form-control" value="{{ $user->phone }}"
                                                        name="phone">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Adresse e-mail</label>
                                                    <input type="text" class="form-control" value="{{ $user->email }}"
                                                        name="email">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
    <label class="form-label">Date de naissance</label>
    <input type="date" class="form-control"
        value="{{ optional($user->profil)->date_naissance }}" name="date_naissance">
</div>

                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Votre fonction</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $user->profil->fonction }}" name="fonction">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Domaine d'activité</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $user->profil->domaine_activite }}"
                                                        name="domaine_activite">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Prix / h</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $user->profil->prix }}" name="prix">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Nom de l'entreprise</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $user->company_name }}" name="company_name">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Disponsibilité</label>

                                                    <select class="form-control select" name="freelancer_type_id">
                                                        @foreach ($freelancersTypes as $freelancerType)
                                                            <option value="{{ $freelancerType->id }}"
                                                                {{ $user->profil->freelancer_type_id == $freelancerType->id ? 'selected' : '' }}>
                                                                {{ $freelancerType->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Compétence principale</label>

                                                    <select class="form-control select" name="category_id">
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $user->profil->category_id == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="pro-head">
                                        <h4 class="pro-titles mb-0">Aperçu</h4>
                                    </div>
                                    <div class="pro-body">
                                        <div class="row">
                                            <div class="input-block col-md-12">
                                                <label class="form-label">Aperçu</label>
                                                <textarea class="form-control summernote" rows="5" name="apercu">{{ $user->profil->apercu }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 w-100">
                                    <div class="card flex-fill mb-3">
                                        <div class="pro-head">
                                            <h4 class="pro-titles without-border mb-0">Compétences secondaires</h4>
                                        </div>
                                        <div class="pro-body">
                                            <div class="form-row align-items-center skill-cont">
                                                <select name="skills[]" id="skills" class="form-control select"
                                                    multiple>
                                                    @foreach ($skills as $skill)
                                                        <option value="{{ $skill->id }}"
                                                            {{ in_array($skill->id, $user->skills->pluck('skill_id')->toArray()) ? 'selected' : '' }}>
                                                            {{ $skill->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 w-100 mt-4">
                                    <div class="card flex-fill mb-3">
                                        <div class="pro-head">
                                            <h4 class="pro-titles without-border mb-0">Education</h4>
                                        </div>
                                        <div class="pro-body">
                                            <div class="form-row align-items-center skill-cont">

                                                @forelse ($user->educations as $education)
                                                    <div class="input-block col-lg-3">
                                                        <label class="form-label">Nom de diplome</label>
                                                        <input type="text" class="form-control"
                                                            name="educations[0][name]" value="{{ $education->name }}">
                                                    </div>
                                                    <div class="input-block col-lg-3">
                                                        <label class="form-label">Nom de l'université</label>
                                                        <input type="text" class="form-control"
                                                            name="educations[0][university]"
                                                            value="{{ $education->university }}">
                                                    </div>
                                                    <div class="col-md-3 input-block floating-icon">
                                                        <label class="form-label">Année de début</label>
                                                        <input type="text" class="form-control"
                                                            name="educations[0][year_of_start]"
                                                            value="{{ $education->year_of_start }}">
                                                        <span><i class="feather-calendar"></i></span>
                                                    </div>
                                                    <div class="col-md-2 input-block floating-icon">
                                                        <label class="form-label">Année de fin</label>
                                                        <input type="text" class="form-control" placeholder=""
                                                            name="educations[0][year_of_end]"
                                                            value="{{ $education->year_of_end }}">
                                                        <span><i class="feather-calendar"></i></span>
                                                    </div>
                                                    <div class="input-block col-lg-1 mb-0">
                                                        <button type="button" class="btn trash-icon delete-education"
                                                            data-id="{{ $education->id }}">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                @empty
                                                    <div class="input-block col-lg-3">
                                                        <label class="form-label">Nom de diplome</label>
                                                        <input type="text" class="form-control"
                                                            name="educations[0][name]">
                                                    </div>
                                                    <div class="input-block col-lg-3">
                                                        <label class="form-label">Nom de l'université</label>
                                                        <input type="text" class="form-control"
                                                            name="educations[0][university]">
                                                    </div>
                                                    <div class="col-md-3 input-block floating-icon">
                                                        <label class="form-label">Année de début</label>
                                                        <input type="text" class="form-control"
                                                            name="educations[0][year_of_start]">
                                                        <span><i class="feather-calendar"></i></span>
                                                    </div>
                                                    <div class="col-md-2 input-block floating-icon">
                                                        <label class="form-label">Année de fin</label>
                                                        <input type="text" class="form-control" placeholder=""
                                                            name="educations[0][year_of_end]">
                                                        <span><i class="feather-calendar"></i></span>

                                                    </div>

                                                    {{-- <div class="input-block col-lg-1 mb-0">
                                                        <a href="javascript:void(0);"
                                                            class="btn trash-icon delete-education" data-id="-1">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div> --}}
                                                @endforelse


                                                <div id="education_add_row" class="w-100"></div>

                                                <a href="javascript:void(0)"
                                                    class="add-btn-form add-edu w-100 d-block text-end"><i
                                                        class="feather-plus-circle me-2"></i>Ajouter</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 w-100">
                                    <div class="card flex-fill mb-3">
                                        <div class="pro-head">
                                            <h4 class="pro-titles without-border mb-0">Expérience</h4>
                                        </div>
                                        <div class="pro-body">
                                            @forelse ($user->experiences as $experience)
                                                <div class="form-row align-items-center skill-cont">
                                                    <div class="input-block col-lg-3">
                                                        <label class="form-label">Nom de l'entreprise</label>
                                                        <input type="text" class="form-control"
                                                            name="experiences[0][company_name]"
                                                            value="{{ $experience->company_name }}">
                                                    </div>
                                                    <div class="input-block col-lg-2">
                                                        <label class="form-label">Poste occupé</label>
                                                        <input type="text" class="form-control"
                                                            name="experiences[0][position]"
                                                            value="{{ $experience->position }}">
                                                    </div>
                                                    <div class="col-md-3 input-block floating-icon">
                                                        <label class="form-label">Date de début</label>
                                                        <input type="date" class="form-control" placeholder=""
                                                            name="experiences[0][start_date]"
                                                            value="{{ $experience->start_date }}">
                                                    </div>
                                                    <div class="col-md-3 input-block floating-icon">
                                                        <label class="form-label">Date de fin</label>
                                                        <input type="date" class="form-control" placeholder=""
                                                            name="experiences[0][end_date]"
                                                            value="{{ $experience->end_date }}">
                                                    </div>
                                                    <div class="input-block col-lg-1 mb-0">
                                                        <button type="button" class="btn trash-icon delete-exp"
                                                            data-id="{{ $experience->id }}">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                            @empty
                                                <div class="form-row align-items-center skill-cont">
                                                    <div class="input-block col-lg-3">
                                                        <label class="form-label">Nom de l'entreprise</label>
                                                        <input type="text" class="form-control"
                                                            name="experiences[0][company_name]">
                                                    </div>
                                                    <div class="input-block col-lg-3">
                                                        <label class="form-label">Poste occupé</label>
                                                        <input type="text" class="form-control"
                                                            name="experiences[0][position]">
                                                    </div>
                                                    <div class="col-md-3 input-block floating-icon">
                                                        <label class="form-label">Date de début</label>
                                                        <input type="date" class="form-control" placeholder=""
                                                            name="experiences[0][start_date]">
                                                    </div>
                                                    <div class="col-md-3 input-block floating-icon">
                                                        <label class="form-label">Date de fin</label>
                                                        <input type="date" class="form-control" placeholder=""
                                                            name="experiences[0][end_date]">
                                                    </div>
                                                    {{-- <div class="input-block col-lg-1 mb-0">
                                                        <a href="javascript:void(0);" class="btn trash-icon delete-exp">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div> --}}
                                                </div>
                                            @endforelse

                                            <div id="exp_add_row" class=" w-100"></div>
                                            <a href="javascript:void(0)"
                                                class="add-btn-form add-exp w-100 d-block text-end">
                                                <i class="feather-plus-circle me-2"></i>
                                                Ajouter
                                            </a>

                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">

                                    <div class="col-lg-12 w-100">
                                        <div class="card flex-fill mb-3">
                                            <div class="pro-head">
                                                <h4 class="pro-titles mb-0">Réseaux Sociaux</h4>
                                            </div>
                                            <div class="pro-body  ">
                                                <div class="form-row align-items-center skill-cont">
                                                    <div class="input-block col-lg-4">
                                                        <label class="form-label">Facebook</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->profil->facebook }}" name="facebook">
                                                    </div>
                                                    <div class="input-block col-lg-4">
                                                        <label class="form-label">Instagram </label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->profil->instagram }}" name="instagram">
                                                    </div>
                                                    <div class="input-block col-lg-4">
                                                        <label class="form-label">LinkedIn</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->profil->linkedin }}" name="linkedin">
                                                    </div>
                                                    <div class="input-block col-lg-4">
                                                        <label class="form-label">Behance</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->profil->behance }}" name="behance">
                                                    </div>
                                                    <div class="input-block col-lg-4">
                                                        <label class="form-label">Youtube </label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->profil->youtube }}" name="youtube">
                                                    </div>
                                                    <div class="input-block col-lg-4">
                                                        <label class="form-label">Twitter</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->profil->twitter }}" name="twitter">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card flex-fill mb-3">
                                            <div class="pro-head">
                                                <h4 class="pro-titles mb-0">Site Web personnel</h4>
                                            </div>
                                            <div class="pro-body  ">
                                                <div class="form-row align-items-center skill-cont">
                                                    <div class="input-block col-lg-12">
                                                        <label class="form-label">URL de site web</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->profil->site_web }}" name="site_web">
                                                    </div>
                                                    <div class="input-block col-lg-3">
                                                        <label class="form-label">Ville</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->profil->ville }}" name="ville">
                                                    </div>
                                                    <div class="input-block col-lg-3">
                                                        <label class="form-label">État / province</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->profil->province }}" name="province">
                                                    </div>
                                                    <div class="input-block col-lg-3">
                                                        <label class="form-label">Code postal</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->profil->code_postal }}" name="code_postal">
                                                    </div>
                                                    <div class="input-block col-md-3">
                                                        <label class="form-label">Pays</label>
                                                        <select class="form-control select" name="pays">
                                                            <option value="1">Burkina Faso</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
   

                                <div class="col-md-12">
                                   <h4 class="mb-3">Heures de travail</h4>
                                </div>
                                    <div class="col-md-6">
                                        <div class="input-block d-flex">
                                            <div class="form-check form-switch d-inline-block work-check position-relative">
                                                <!-- Suppression de la checkbox -->
                                            </div>
                                            <label class="form-label ms-2">Même heure tous les jours</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-hour">
                                            <div class="other-info-list">
                                                <ul>
                                                    @foreach (['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $day)
                                                        <li>
                                                            <span class="work-day-item @if (in_array($day, $workDays)) active-hour @endif"
                                                                id="work_day_{{ strtolower($day) }}">
                                                                {{ $day }}
                                                            </span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

<script>
    // Fonction pour définir un cookie
    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    // Fonction pour obtenir la valeur d'un cookie
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    // Ajouter un gestionnaire d'événements pour chaque élément de jour de travail pour changer leur couleur et gérer les cookies
    document.querySelectorAll('.work-day-item').forEach(function (item) {
        item.addEventListener('click', function () {
            this.classList.toggle('active-hour');
            var day = this.textContent.trim();
            if (this.classList.contains('active-hour')) {
                // Ajouter le jour aux jours sélectionnés
                var selectedDays = JSON.parse(getCookie('selectedDays') || '[]');
                if (!selectedDays.includes(day)) {
                    selectedDays.push(day);
                    setCookie('selectedDays', JSON.stringify(selectedDays), 30); // Cookie expirant dans 30 jours
                }
            } else {
                // Retirer le jour des jours sélectionnés
                var selectedDays = JSON.parse(getCookie('selectedDays') || '[]');
                var index = selectedDays.indexOf(day);
                if (index !== -1) {
                    selectedDays.splice(index, 1);
                    setCookie('selectedDays', JSON.stringify(selectedDays), 30); // Cookie expirant dans 30 jours
                }
            }
        });
    });

    // Initialiser les jours sélectionnés à partir des cookies lors du chargement de la page
    document.addEventListener('DOMContentLoaded', function () {
        var selectedDays = JSON.parse(getCookie('selectedDays') || '[]');
        selectedDays.forEach(function (day) {
            var element = document.getElementById('work_day_' + day.toLowerCase());
            if (element) {
                element.classList.add('active-hour');
            }
        });
    });
</script>



                                <div class="card text-end border-0">
                                    <div class="pro-body">
                                        <button class="btn btn-secondary click-btn btn-plan">Annuler</button>
                                        <button class="btn btn-primary click-btn btn-plan" type="submit">Mise à
                                            jour</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
