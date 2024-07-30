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
                            <h3 class="mb-0">Changer votre mot de passe</h3>
                        </div>
                        <form action="{{ route('change_password_post') }}" method="post">
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="input-block">
                                        <label class="focus-label">Votre ancien mot de passe</label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control floating pass-input"
                                                name="old_password" required>
                                            <div class="password-icon ">
                                                <span class="fas toggle-password fa-eye-slash"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-block">
                                        <label class="focus-label">Nouveau mot de passe</label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control floating pass-input1"
                                                name="password">
                                            <div class="password-icon ">
                                                <span class="fas toggle-password1 fa-eye-slash"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-block">
                                        <label class="focus-label">Confirmez le mot de passe </label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control floating pass-inputs"
                                                name="password_confirmation">
                                            <div class="password-icon ">
                                                <span class="fas toggle-passwords fa-eye-slash"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex doc-btn">
                                        <a href="javascript:void(0);" class="btn btn-gray">Annuler</a>
                                        <button type="submit" data-bs-toggle="modal" class="btn btn-primary">Mise à
                                            jour</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
