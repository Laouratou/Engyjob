@extends('layouts.app_admin')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Tous les projets</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
                            <li class="breadcrumb-item active">Catégories</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        {{-- Boutons et actions supplémentaires peuvent être ajoutés ici --}}
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Nom</th>
                                            <th>Contact</th>
                                            <th>Catégorie</th>
                                            <th>Fonction</th>
                                            <th>Domaine</th>
                                            <th>Prix/h</th>
                                            <th>Adresse</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($freelancers as $key => $freelancer)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>
                                                    <div>
                                                        <a target="_blank"
                                                            href="{{ route('freelancers.profile', $freelancer->id) }}">
                                                            {{ $freelancer->name }} {{ $freelancer->first_name }}
                                                        </a>
                                                        <br>
                                                        @if ($freelancer->profil)
                                                            <span
                                                                class="badge bg-success-light">{{ '@' . $freelancer->profil->username }}</span>
                                                        @else
                                                            <span class="badge bg-warning-light">Profil non défini</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $freelancer->phone }}
                                                    <div>
                                                        <span>{{ $freelancer->email }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($freelancer->profil && $freelancer->profil->category)
                                                        {{ $freelancer->profil->category->name }}
                                                    @else
                                                        Catégorie non définie
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($freelancer->profil)
                                                        {{ $freelancer->profil->fonction ?? 'Fonction non définie' }}
                                                    @else
                                                        Profil non défini
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $freelancer->profil->domaine_activite ?? 'Domaine non défini' }}
                                                </td>
                                                <td>
                                                    {{ $freelancer->profil->prix ?? 'Prix non défini' }} CFA
                                                </td>
                                                <td>
                                                    @if ($freelancer->profil)
                                                        {{ $freelancer->profil->code_postal . ',' . $freelancer->profil->ville . ',' . $freelancer->profil->province . ',' . $freelancer->profil->pays ?? 'Adresse non définie' }}
                                                    @else
                                                        Adresse non définie
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <button
                                                        class="btn btn-sm @if (!$freelancer->is_active) btn-danger @else btn-success @endif toggleActive"
                                                        data-model="User" data-id="{{ $freelancer->id }}">
                                                        <i class="fa-solid fa-circle-check"></i>
                                                    </button>
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
@endsection
