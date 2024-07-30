@extends('layouts.app_admin')

@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Tableau de bord</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
                            <li class="breadcrumb-item active">Tableau de bord</li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- /Page Header -->


            <div class="row">
                <div class="col-md-8">
                    <!--/Wizard-->
                    <div class="row">
                        <div class="col-md-4 d-flex">
                            <div class="card wizard-card flex-fill">
                                <div class="card-body">
                                    <p class="text-primary mt-0 mb-2">Utilisateurs</p>
                                    <h5>{{ $users_count }}</h5>
                                    <p><a href="#">Voir les détails</a></p>
                                    <span class="dash-widget-icon bg-1">
                                        <i class="fas fa-users"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex">
                            <div class="card wizard-card flex-fill">
                                <div class="card-body">
                                    <p class="text-primary mt-0 mb-2">Projets terminés</p>
                                    <h5>{{ $completed_projects }}</h5>
                                    <p><a href="#">Voir les détails</a></p>
                                    <span class="dash-widget-icon bg-1">
                                        <i class="fas fa-th-large"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex">
                            <div class="card wizard-card flex-fill">
                                <div class="card-body">
                                    <p class="text-primary mt-0 mb-2">Projets actifs</p>
                                    <h5>{{ $ongoing_projects }}</h5>
                                    <p>
                                        <a href="#">Voir les détails</a>
                                    </p>

                                    <span class="dash-widget-icon bg-1">
                                        <i class="fas fa-bezier-curve"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Wizard-->
                    <div class="row">
                        <div class="col-lg-12 d-flex">
                            <div class="card w-100">
                                <div class="card-body pt-0 pb-2">
                                    <div class="card-header">
                                        <h5 class="card-title">Aperçu</h5>
                                    </div>
                                    <div id="chart" class="mt-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="card w-100">
                        <div class="card-body pt-0">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-7">
                                        <p>Content de te revoir,</p>
                                        <h6 class="text-primary">{{ Auth::user()->name . ' ' . Auth::user()->first_name }}
                                        </h6>
                                    </div>
                                    <div class="col-5 text-end">
                                        <span class="welcome-dash-icon bg-1">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="account-balance">
                                <p>Solde du compte</p>
                                <h6>50,000,00 </h6>
                            </div>
                            <div class="mt-3">
                                <h6 class="text-primary">Paiments</h6>
                                <div class="table-responsive">
                                    <table class="table table-center table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-nowrap">Client ou Freelancer</th>
                                                <th>Montant</th>
                                                <th class="text-end">Statut</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-nowrap">Sakib Khan</td>
                                                <td>2222</td>
                                                <td class="text-end">Terminé</td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">Pixel Inc Ltd</td>
                                                <td>7500</td>
                                                <td class="text-end">
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-success me-2">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger me-2">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">Jon M Mullins</td>
                                                <td>3150</td>
                                                <td class="text-end text-nowrap">Payé au freelancer</td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">Rose M Milewski</td>
                                                <td>1455</td>
                                                <td class="text-end text-nowrap">Retourné au client</td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">Gerald K Myers</td>
                                                <td>3000</td>
                                                <td class="text-end">
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-success me-2">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger me-2">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">Marcin Kowalski</td>
                                                <td>895</td>
                                                <td class="text-end">
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-success me-2">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger me-2">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card bg-white projects-card">
                        <div class="card-body pt-0">
                            <div class="card-header">
                                <h5 class="card-title">Commentaires</h5>
                            </div>
                            <div class="reviews-menu-links">
                                <ul role="tablist" class="nav nav-pills card-header-pills nav-justified">
                                    <li class="nav-item">
                                        <a href="#tab-6" data-bs-toggle="tab" class="nav-link active"> En attente de
                                            validation
                                            ({{ count($pending_reviews) }})
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#tab-5" data-bs-toggle="tab" class="nav-link">Actif
                                            ({{ count($active_reviews) }})</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#tab-4" data-bs-toggle="tab" class="nav-link">Tous
                                            ({{ count($reviews) }})</a>
                                    </li>

                                </ul>
                            </div>

                            <div class="tab-content pt-0">
                                <div role="tabpanel" id="tab-6" class="tab-pane fade active show">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover datatable">
                                            <thead>
                                                <tr>
                                                    {{-- <th></th> --}}
                                                    <th>Profil</th>
                                                    <th>Freelancer</th>
                                                    <th>comments</th>
                                                    <th>Projet</th>
                                                    <th>Note</th>
                                                    <th>Catégorie</th>
                                                    <th class="text-end">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pending_reviews as $pr)
                                                    <tr>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="javascript:void(0);">
                                                                    <img class="avatar-img rounded-circle me-2"
                                                                        src="{{ asset($pr->user->profil->photo) }}"
                                                                        alt="User Image">
                                                                    {{ $pr->user->name }} {{ $pr->user->first_name }}
                                                                </a>
                                                            </h2>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="javascript:void(0);">
                                                                    <img class="avatar-img rounded-circle me-2"
                                                                        src="{{ asset($pr->freelancer->profil->photo) }}"
                                                                        alt="User Image">

                                                                    {{ $pr->freelancer->name }}
                                                                    {{ $pr->freelancer->first_name }}
                                                                </a>
                                                            </h2>
                                                        </td>
                                                        <td>
                                                            <div class="desc-info">
                                                                {{ $pr->comment }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ $pr->project->name }}
                                                        </td>
                                                        <td class="text-nowrap">
                                                            @for ($i = 0; $i < $pr->rate; $i++)
                                                                <i class="fas fa-star text-primary"></i>
                                                            @endfor
                                                            @for ($i = 0; $i < 5 - $pr->rate; $i++)
                                                                <i class="fas fa-star text-muted"></i>
                                                            @endfor
                                                        </td>
                                                        <td>
                                                            {{ $pr->project->category->name }}
                                                        </td>
                                                        <td class="text-end text-nowrap">
                                                            <a href="javascript:void(0);"
                                                                class=" btn btn-success text-white me-2"><i
                                                                    class="fa-solid fa-circle-check"></i></a>
                                                            <a href="javascript:void(0);" class="btn btn-danger"><i
                                                                    class="fa-solid fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div role="tabpanel" id="tab-5" class="tab-pane fade">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover datatable">
                                            <thead>
                                                <tr>
                                                    {{-- <th></th> --}}
                                                    <th>Profil</th>
                                                    <th>Freelancer</th>
                                                    <th>comments</th>
                                                    <th>Projet</th>
                                                    <th>Note</th>
                                                    <th>Catégorie</th>
                                                    <th class="text-end">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($active_reviews as $ar)
                                                    <tr>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="javascript:void(0);"><img
                                                                        class="avatar-img rounded-circle me-2"
                                                                        src="{{ asset($ar->user->profil->photo) }}"
                                                                        alt="User Image">
                                                                    {{ $ar->user->name }} {{ $ar->user->first_name }}
                                                                </a>
                                                            </h2>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                            <a href="javascript:void(0);">
    <img class="avatar-img rounded-circle me-2"
         src="{{ isset($pr) ? asset($pr->freelancer->profil->photo) : asset('default-avatar.png') }}"
         alt="User Image">
    {{ isset($ar->freelancer->name) ? $ar->freelancer->name : 'Nom indisponible' }}
    {{ isset($ar->freelancer->first_name) ? $ar->freelancer->first_name : 'Prénom indisponible' }}
</a>

                                                            </h2>
                                                        </td>
                                                        <td>
                                                            <div class="desc-info">
                                                                {{ $ar->comment }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ $ar->project->name }}
                                                        </td>
                                                        <td class="text-nowrap">
                                                            @for ($i = 0; $i < $ar->rate; $i++)
                                                                <i class="fas fa-star text-primary"></i>
                                                            @endfor
                                                            @for ($i = 0; $i < 5 - $ar->rate; $i++)
                                                                <i class="fas fa-star text-muted"></i>
                                                            @endfor
                                                        </td>
                                                        <td>
                                                            {{ $ar->project->category->name }}
                                                        </td>
                                                        <td class="text-end text-nowrap">
                                                            <a href="javascript:void(0);"
                                                                class=" btn btn-success text-white me-2"><i
                                                                    class="fa-solid fa-circle-check"></i></a>
                                                            <a href="javascript:void(0);" class="btn btn-danger"><i
                                                                    class="fa-solid fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div role="tabpanel" id="tab-4" class="tab-pane fade">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover datatable">
                                            <thead>
                                                <tr>
                                                    {{-- <th></th> --}}
                                                    <th>Profil</th>
                                                    <th>Freelancer</th>
                                                    <th>comments</th>
                                                    <th>Projet</th>
                                                    <th>Note</th>
                                                    <th>Catégorie</th>
                                                    <th class="text-end">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($reviews as $pr)
                                                    <tr>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="javascript:void(0);">
                                                                    <img class="avatar-img rounded-circle me-2"
                                                                        src="{{ asset($pr->user->profil->photo) }}"
                                                                        alt="User Image">
                                                                    {{ $pr->user->name }} {{ $pr->user->first_name }}
                                                                </a>
                                                            </h2>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="javascript:void(0);">
                                                                    <img class="avatar-img rounded-circle me-2"
                                                                        src="{{ asset($pr->freelancer->profil->photo) }}"
                                                                        alt="User Image">
                                                                    {{ $pr->freelancer->name }}
                                                                    {{ $pr->freelancer->first_name }}
                                                                </a>
                                                            </h2>
                                                        </td>
                                                        <td>
                                                            <div class="desc-info">
                                                                {{ $pr->comment }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ $pr->project->name }}
                                                        </td>
                                                        <td class="text-nowrap">
                                                            @for ($i = 0; $i < $pr->rate; $i++)
                                                                <i class="fas fa-star text-primary"></i>
                                                            @endfor
                                                            @for ($i = 0; $i < 5 - $pr->rate; $i++)
                                                                <i class="fas fa-star text-muted"></i>
                                                            @endfor
                                                        </td>
                                                        <td>
                                                            {{ $pr->project->category->name }}
                                                        </td>
                                                        <td class="text-end text-nowrap">
                                                            <a href="javascript:void(0);"
                                                                class=" btn btn-success text-white me-2"><i
                                                                    class="fa-solid fa-circle-check"></i></a>

                                                            <a href="javascript:void(0);" class="btn btn-danger"><i
                                                                    class="fa-solid fa-trash"></i></a>
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
        </div>
        <!-- /Page Wrapper -->

    </div>
@endsection
