@extends('layouts.app')

@section('content')
    <div class="content content-page">
        <div class="container">
            <div class="row">
                @if (auth()->user()->user_type == 'freelancer')
                    @include('components.freelancers_side_bar')
                @else
                    @include('components.company_side_bar', ['active' => 'dashboard'])
                @endif


                <div class="col-xl-9 col-lg-8">
                    <div class="dashboard-sec payout-section freelancer-statements">
                        <div class="page-title portfolio-title">
                            <h3 class="mb-0">Vérifier votre identité</h3>
                        </div>



                        @if (auth()->user()->profil->is_verified)
                            <div class="text-center border pb-4 border-success rounded bg-100 bg-success-light">
                                {{-- <i class="fa-solid fa-cloud-bolt"></i> --}}
                                <i class="fa-solid fa-user-check text-success fa-5x mt-5 mb-3"></i>
                                <h5 class="text-center text-muted fw-normal">Félicitations!<br> Votre identité est verifiée
                                </h5>
                            </div>
                        @else
                            @if ($user_verification != null)
                                <div class="alert alert-primary" role="alert">
                                    <h4>Information</h4>
                                    <h5 class="fw-light">Vous avez déjà envoyé le document de vérifiaction</h5>
                                </div>
                            @endif
                            <form action="{{ route('verify_identity_post') }}" method="post" id="verification-form"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label class="focus-label">Type de Document</label>
                                            <select class="form-control select" name="type" required>
                                                <option value="id">Carte d'identité</option>
                                                <option value="passport">Passeport</option>
                                                <option value="driving_license">Permit de travail</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label class="focus-label">Numéro de document</label>
                                            <input type="text" class="form-control" name="number" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-block">
                                            <label class="form-label">Sélectionner le document</label>
                                            <div class="upload-sets">
                                                <label class="upload-filesview">
                                                    Parcourir
                                                    <input type="file" name="document" required>
                                                </label>
                                                <h6>Ou glisser & déposer ici</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex doc-btn">
                                            <button class="btn btn-primary" id="submit-verification-">
                                                Soumettre la vérification
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    @if (session()->has('success_id'))
        <script>
            $(document).ready(function() {
                // open modal
                $('#success-verified').modal('show');
            })
        </script>
    @endif
    <script>
        $(document).ready(function() {
            // $("#submit-verification").click(function() {
            //     // submit form
            //     $("#verification-form").submit();
            // })
        })
    </script>
@endsection
