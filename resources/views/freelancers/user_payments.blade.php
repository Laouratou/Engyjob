@extends('layouts.app')

@section('content')
    <div class="content content-page">
        <div class="container">
            <div class="row">
                @include('components.freelancers_side_bar', ['active' => 'dashboard'])

                <div class="col-xl-9 col-lg-8">
                    <div class="dashboard-sec payout-section freelancer-statements plan-billing">
                        <div class="page-title portfolio-title">
                            <h3 class="mb-0">Transactions de portefeuille</h3>
                        </div>

                        <div class="text-end">
                            <button class="btn btn-primary btn_open_add_wallet" data-bs-toggle="modal"
                                data-bs-target="#wallet_add_modal"> Recharger mon
                                portefeuille</button>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table datatable table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Détails</th>
                                        <th>Type</th>
                                        <th>Montant</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($user_payment as $payment)
                                        <tr>
                                            <td>{{ $payment->project->name }}
                                                <div>
                                                    <small class="text-primary">{{ $payment->etapecle->name ?? '' }}
                                                    </small>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($payment->user_id == auth()->user()->id)
                                                    @if ($payment->type == 'debit')
                                                        <span class=" text-danger  ">
                                                            {{ $payment->formatType($payment->type) }}
                                                        </span>
                                                    @else
                                                        <span class=" text-success  ">
                                                            {{ $payment->formatType($payment->type) }}
                                                        </span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{ number_format($payment->amount ?? 0, 0, ',', ' ') }} CFA
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d/m/Y H:i') }}
                                            </td>

                                        </tr>

                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        <!-- /Table -->

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
