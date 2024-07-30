@extends('layouts.app')

@section('content')
<div class="content content-page">
    <div class="container">
        <div class="row">
            @auth
            @if (auth()->user()->user_type == 'freelancer')
            @include('components.freelancers_side_bar', ['active' => 'dashboard'])
            @elseif(auth()->user()->user_type == 'company')
            @include('components.company_side_bar', ['active' => 'dashboard'])
            @endif
            @endauth

            <div class="col-xl-9 col-lg-8">
                <div class="dashboard-sec payout-section freelancer-statements plan-billing">
                    <div class="page-title portfolio-title">
                        <h3 class="mb-0">Transactions de portefeuille</h3>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary btn_open_add_wallet" data-bs-toggle="modal"
                            data-bs-target="#wallet_add_modal"> Recharger mon
                            portefeuille</button>
                        <!-- resources/views/withdrawal.blade.php -->

                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#withdrawal_modal">
                            Retirer
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="withdrawal_modal" tabindex="-1"
                            aria-labelledby="withdrawalModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="withdrawalModalLabel">Retirer des fonds</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="withdrawalForm" action="{{ route('ligdicash.withdrawal') }}"
                                            method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="amount" class="form-label">Montant :</label>
                                                <input type="number" class="form-control" name="amount" id="amount"
                                                    min="100" step="1" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="customer" class="form-label">Numéro de téléphone :</label>
                                                <input type="text"
                                                    class="form-control @error('customer') is-invalid @enderror"
                                                    name="customer" id="customer" required>
                                                @error('customer')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Soumettre</button>
                                        </form>
                                        <div id="responseMessage" class="mt-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-center table-bordered table-hover datatable no-sort">
                                <thead class="thead-pink">
                                    <tr>
                                        <th hidden></th>
                                        <th>S No.</th>
                                        <th>Montant</th>
                                        <th>Type</th>
                                        <th>Solde</th>
                                        <th>Méthode</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($wallet_transactions as $wallet_transaction)
                                    <tr>
                                        <td hidden>{{ $wallet_transaction->id }}</td>
                                        <td>{{ $wallet_transaction->code }}</td>
                                        <td>{{ number_format($wallet_transaction->amount ?? 0, 0, ',', ' ') }} CFA </td>
                                        <td>
                                            <span
                                                class=" @if ($wallet_transaction->type == 'debit') text-danger @else text-success @endif ">

                                                {{ $wallet_transaction->formatType($wallet_transaction->type) }}
                                            </span>
                                        </td>
                                        <td>{{ number_format($wallet_transaction->balance ?? 0, 0, ',', ' ') }} CFA
                                        </td>
                                        <td>{{
                                            $wallet_transaction->formatPaymentMethod($wallet_transaction->payment_method)
                                            }}
                                        </td>
                                        <td>
                                            @if ($wallet_transaction->type == 'debit')
                                            -
                                            @else
                                            {{ $wallet_transaction->status }}
                                            @endif
                                        </td>



                                        <td>{{ \Carbon\Carbon::parse($wallet_transaction->created_at)->format('d/m/Y
                                            H:i') }}
                                        </td>
                                    </tr>
                                    @endforeach

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

    @section('js')

    <script>
        document.getElementById('withdrawalForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Empêche le rechargement de la page

            var form = e.target;
            var formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST'
                    , body: formData
                    , headers: {
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json()) // Changez ici pour obtenir le JSON directement
                .then(data => {
                    //console.log('Réponse JSON:', data); // Affichez la réponse JSON dans la console
                    if (data.error) {

                        // alert(data.error)

                        //  document.getElementById('responseMessage').innerHTML = `
                        //          <div class="alert alert-danger">
                        //          Erreur: ${data.error}<br>
                        //          Code: ${data.code}<br>
                        //          Détails: ${data.details}
                        //         </div>`;

                        window.location.href = "{{ route('error_retrait') }}";
                    } else {

                        // alert(data.response)
                        // console.log(data.response)
                        if(data.response.response_code != '00'){
                            window.location.href = "{{ route('error_retrait') }}";
                        }

                        // document.getElementById('responseMessage').innerHTML = `
                        //     <div class="alert alert-success">
                        //     Succès: ${JSON.stringify(data.response)}
                        //      </div>`;

                            //redirect to
                            //window.location.href = "{{ route('wallet_transactions.index') }}";
                            
                       
                            window.location.href = "{{ route('success_retrait') }}";
                        }
                })
                .catch(error => {
                    // Traitez les erreurs ici
                    document.getElementById('responseMessage').innerHTML = `
                        <div class="alert alert-danger">
                        Erreur: ${error.message}
                        </div>`;
                });
        });

    </script>
    @endsection