@extends('layouts.app')

@section('content')
    <div class="content content-page">
        <div class="container">
            <div class="row">
                @include('components.company_side_bar', ['active' => 'dashboard'])

                <div class="col-xl-9 col-lg-8">
                    <div class="dashboard-sec">
                        <div class="page-title">
                            <h3 class="">Tableau de bord
                                <span class="text-light bg-success-light p-1 m-2 rounded h6 fw-medium">Entreprise</span>
                            </h3>

                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="dash-widget">
                                    <div class="dash-info">
                                        <div class="dashboard-icon">
                                            <img src="{{ asset('/assets/img/icon/freelancer-dashboard-icon-01.svg') }}"
                                                alt="Img">
                                        </div>
                                        <div class="dash-widget-info">Projets terminés</div>
                                    </div>
                                    <div class="dash-widget-more d-flex align-items-center justify-content-between">
                                        <div class="dash-widget-count">{{ count($project_termines) ?? 0 }}</div>
                                        <a href="#" class="d-flex">Voir Plus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="dash-widget">
                                    <div class="dash-info">
                                        <div class="dashboard-icon dashboard-icon-two">
                                            <img src="{{ asset('/assets/img/icon/freelancer-dashboard-icon-02.svg') }}"
                                                alt="Img">
                                        </div>
                                        <div class="dash-widget-info">Tâche terminée</div>
                                    </div>
                                    <div class="dash-widget-more d-flex align-items-center justify-content-between">
                                        <div class="dash-widget-count">{{ count($etape_cle_termines) ?? 0 }}</div>
                                        <a href="#" class="d-flex">Voir Plus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="dash-widget">
                                    <div class="dash-info">
                                        <div class="dashboard-icon dashboard-icon-three">
                                            {{-- <img src="{{ asset('/assets/img/icon/freelancer-dashboard-icon-03.svg') }}"
                                                alt="Img"> --}}
                                            <i class="fa-solid fa-wallet text-warning"></i>
                                        </div>
                                        <div class="dash-widget-info">Portefeuille</div>
                                    </div>
                                    <div class="dash-widget-more d-flex align-items-center justify-content-between">
                                        <div class="dash-widget-count">
                                            {{ number_format(auth()->user()->wallet ?? 0, 0, ',', ' ') }} CFA</div>
                                        <a href="#" class="d-flex">Voir Plus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="dash-widget">
                                    <div class="dash-info">
                                        <div class="dashboard-icon dashboard-icon-four">
                                            <img src="{{ asset('/assets/img/icon/freelancer-dashboard-icon-04.svg') }}"
                                                alt="Img">
                                        </div>
                                        <div class="dash-widget-info">Revenus</div>
                                    </div>
                                    <div class="dash-widget-more d-flex align-items-center justify-content-between">
                                        <div class="dash-widget-count">
                                            {{ number_format(auth()->user()->total_earnings ?? 0, 0, ',', ' ') }} CFA</div>
                                        <a href="#" class="d-flex">Voir Plus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
        var userType = @json($userType);
    </script>
                        <!-- Chart Content -->
                        <div class="row">
                            <div class="col-xl-8 d-flex">
                                <div class="card flex-fill ongoing-project-card">
                                    <div class="pro-head">
                                        <h5 class="card-title mb-0">Aperçu</h5>
                                        <div class="month-detail">
                                            <select class="form-control">
                                                <option value="0">6 derniers mois</option>
                                                <option value="1">2 derniers mois</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="pro-body p-0">
                                    <div id="charttransactions"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex">
                                <div class="flex-fill card ongoing-project-card">
                                    <div class="pro-head b-0">
                                        <h5 class="card-title mb-0">Analytique statistique</h5>
                                    </div>
                                    <div class="pro-body p-0">
                                        <div id="chartLineCompany"></div>
                                        <div class="d-flex flex-wrap justify-content-between">
                                            <ul class="static-list">
                                                <li>
                                                    <span>
                                                        <i class="fas fa-circle text-violet me-1"></i>
                                                        Projets
                                                    </span>
                                                </li>
                                                <!-- <li><span><i class="fas fa-circle text-pink me-1"></i> Applied Proposals</span></li> -->
                                                <li>
                                                    <span>
                                                        <i class="fas fa-circle text-yellow me-1"></i>
                                                        Propositions
                                                    </span>
                                                </li>
                                                <!-- <li><span><i class="fas fa-circle text-blue me-1"></i>Bookmarked Projects</span></li> -->
                                            </ul>
                                            <ul class="static-list">
                                                <!-- <li><span><i class="fas fa-circle text-violet me-1"></i>Jobs</span></li> -->
                                                <li>
                                                    <span>
                                                        <i class="fas fa-circle text-pink me-1"></i>
                                                        Propositions remportées
                                                    </span>
                                                </li>
                                              
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Chart Content -->

                        <div class="row">

                            <!-- Past Earnings -->
                            <div class="col-xl-12">
                                <div class="card mb-4 ongoing-project-card">
                                    <div class="pro-head">
                                        <h2>Transactions récentes</h2>
                                        <a href="#" class="btn fund-btn">Voir tout</a>
                                    </div>
                                    <div class="table-responsive recent-earnings flex-fill">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Détails</th>
                                                    <th>Type</th>
                                                    <th>Montant</th>
                                                    <th>Freelancer</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($user_payment as $payment)
                                                    <tr>
                                                        <td>{{ $payment->project->name }}
                                                            <div>
                                                                <small
                                                                    class="text-primary">{{ $payment->etapecle->name ?? '' }}
                                                                </small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-success">
                                                                {{ $payment->payment_method }}
                                                            </span>
                                                        </td>
                                                        <td>{{ number_format($payment->amount ?? 0, 0, ',', ' ') }} CFA
                                                        </td>
                                                        <td>
    @if ($payment->freelancer)
        {{ $payment->freelancer->name }}
        {{ $payment->freelancer->first_name }}
    @else
        Freelancer non trouvé
    @endif
</td>

                                                        <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d/m/Y H:i') }}
                                                        </td>

                                                    </tr>

                                                @empty
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /Past Earnings -->
                        </div>



                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
