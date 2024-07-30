@extends('layouts.app')

@section('content')
<div class="content content-page">
    <div class="container">
        <div class="row">
            @include('components.freelancers_side_bar', ['active' => 'dashboard'])

            <div class="col-xl-9 col-lg-8">  <!-- Assure-toi que cette div prend la largeur correcte -->
                <div class="plan-billing-section">
                    <div class="row row-gap">
                        @foreach ($plans as $plan)
                            <div class="col-xl-4 col-md-6">
                                <div class="package-detail">
                                    <h4>{{ $plan->name }}</h4>
                                    <p>{{ $plan->description }}</p>
                                    <h3 class="package-price">{{ number_format($plan->price, 0, ',', ' ') }} CFA <span>/ Mois</span></h3>
                                    <div class="package-feature">
    @if($plan->service)
        <ul class="service-list">
            <li>Nombre de services masqués autorisés : {{ $plan->service->allowed_services }}</li>
            <li>Offres par projet : {{ $plan->service->offers_per_project }}</li>
            <li>Services à coller au sommet : {{ $plan->service->featured_services }}</li> 
        </ul>
    @else
        <p>Aucun service associé.</p>
    @endif
</div>





                                    <button class="btn btn-outline-primary btn-block btn_open_payment_modal mt-3"
                                            data-plan="{{ strtolower($plan->name) }}">Sélectionnez ce plan</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @isset($membership)
                    <div class="page-title mt-4">
                        <h3>Plan actuel</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="member-plan pro-box">
                                <div class="member-detail">
                                    <div class="row">
                                    <div class="col-md-4">
    <h5>{{ $membership->name }}</h5>
    <div class="yr-amt">Populaire pour les petites équipes.</div>
    <div class="expiry-on">
        <span><i class="feather-calendar"></i>Date de renouvellement :</span>
        {{ \Carbon\Carbon::parse($membership->expiry_date)->format('d/m/Y') }}
    </div>
</div>

                                        <div class="col-md-8 change-plan mt-3 mt-md-0">
                                            <div>
                                                <h3>{{ number_format($membership->price ?? 0, 0, ',', ' ') }} CFA</h3>
                                                <div class="yr-duration">Durée: {{ $membership->periodicity }}</div>
                                            </div>
                                            <div class="change-plan-btn">
                                                <button class="btn btn-primary-lite" id="cancel_membership"
                                                        data-membership_id="{{ $membership->id }}">
                                                    Annuler l'abonnement
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endisset

                    <!-- Table -->
                    <div class="table-top-section mt-4">
                        <div class="table-header">
                            <h5 class="mb-0">Bilan</h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date de l'achat</th>
                                    <th>Détails</th>
                                    <th>Date d'expiration</th>
                                    <th>Type</th>
                                    <th>Prix</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($memberships as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->purchase_date)->format('d/m/Y') }}</td>
                                        <td class="invoice-td">
                                            <p class="mb-0 fw-bold">{{ $item->name }}</p>
                                            <a href="javascript:void(0);" class="">Facture : {{ $item->invoice_code }}</a>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->expiry_date)->format('d/m/Y') }}</td>
                                        <td>{{ $item->periodicity }}</td>
                                        <td>{{ number_format($item->price ?? 0, 0, ',', ' ') }} CFA</td>
                                        <td>
                                            @if ($item->is_cancelled || !$item->is_active)
                                                <div class="badge badge-danger-lite">
                                                    <span>Inactif</span>
                                                </div>
                                            @else
                                                <div class="badge badge-paid"><span>Actif</span></div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /Table -->
                </div>
            </div> <!-- Fin de col-xl-9 -->
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $(".btn_open_payment_modal").click(function() {
            var selected_plan = $(this).data('plan');
            $("#selected_plan").val(selected_plan);
            $("#selected_plan_name").text(selected_plan);

            $("#payout_modal").modal('show');
        });

        $("#cancel_membership").click(function() {
            var membership_id = $(this).data('membership_id');
            $("#membership_id").val(membership_id);
            $("#cancel_membership_modal").modal('show');
        });

        $("#confirm_cancel").click(function() {
            var membership_id = $("#membership_id").val();
            
            $.ajax({
                url: '/cancel-membership/' + membership_id, 
                method: 'POST', 
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.message);
                    location.reload();
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message || 'Une erreur s\'est produite.');
                }
            });
        });
    });
</script>
@endsection

<style>
    .service-list {
        list-style-type: disc; /* Puces */
        padding-left: 20px; /* Indentation */
    }
    .service-list li {
        color: green; /* Couleur du texte */
        margin: 5px 0; /* Espacement entre les éléments */
    }
</style>
