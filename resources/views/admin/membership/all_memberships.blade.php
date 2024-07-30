@extends('layouts.app_admin')


@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Toutes les souscriptions</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a>
                            </li>
                            <li class="breadcrumb-item active">Souscriptions</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        {{-- <a href="javascript:void(0);" class="btn add-button me-2" data-bs-toggle="modal"
                            data-bs-target="#add-category">
                            <i class="fas fa-plus"></i>
                        </a> --}}
                        {{-- <a class="btn filter-btn" href="javascript:void(0);" id="filter_search">
                            <i class="fas fa-filter"></i>
                        </a> --}}
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
                                            <th>Pack</th>
                                            <th>No Facture</th>
                                            <th>Date d'achat</th>
                                            <th>Date de fin</th>
                                            <th>Prix</th>
                                            <th>Utilisateur</th>
                                            <th>Type de compte</th>
                                            <th>Méthode</th>
                                            <th>Périodique</th>
                                            <th>Est actif</th>
                                            <th>Annulé</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($memberships as $key => $item)
                                            <tr>
                                                <td>
                                                    {{ ++$key }}
                                                </td>
                                                <td>
                                                    {{ $item->name }}
                                                </td>
                                                <td>{{ $item->invoice_code }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->purchase_date)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->expiry_date)->format('d/m/Y') }}</td>
                                                <td>{{ number_format($item->price ?? 0, 0, ',', ' ') }}</td>
                                                <td>{{ $item->user->name }} {{ $item->user->first_name }}
                                                    <div>
                                                        <span class="badge bg-success-light">{{ $item->user->email }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($item->user->user_type == 'freelancer')
                                                        <span class="badge bg-success-light">Freelanceur</span>
                                                    @elseif($item->user->user_type == 'company')
                                                        <span class="badge bg-warning-light">Entreprise</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $item->payment_method }}
                                                </td>

                                                <td>{{ $item->periodicity }}</td>

                                                <td>
                                                    @if ($item->is_active)
                                                        <span class="badge bg-success-light">Oui</span>
                                                    @else
                                                        <span class="badge bg-danger-light">Non</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($item->is_cancelled)
                                                        <span class="badge bg-danger-light">Oui</span>
                                                    @else
                                                        <span class="badge bg-success-light">Non</span>
                                                    @endif
                                                </td>


                                                <td class="text-end">
                                                    {{-- <a href="javascript:void(0);" class="btn btn-sm btn-secondary me-2"
                                                        data-bs-toggle="modal" data-bs-target="#edit-category"><i
                                                            class="far fa-edit"></i></a> --}}

                                                    <button
                                                        class="btn btn-sm @if (!$item->is_active) btn-danger
                                                    @else
                                                        btn-success @endif toggleActive"
                                                        data-model="Membership" data-id="{{ $item->id }}">
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
