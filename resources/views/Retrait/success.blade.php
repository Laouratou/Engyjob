@extends('layouts.app_login')

@section('content')
<div class="login-wrapper">
    <div class="content">
        <!-- Login Content -->
        <div class="account-content">
            <div class="align-items-center justify-content-center">
                <div class="login-right">
                    <div class="login-header text-center">
                        {{-- <a href="/">
                            <img src="assets/img/logo.png" alt="logo" class="img-fluid">
                        </a> --}}
                        <br>
                        <i class="fa-solid fa-circle-check text-success fa-8x"></i>
                        <br>
                        <h2 class="text-success mt-4 fw-bold">Félicitations</h2>
                        <h5 class="my-3">Votre paiement a été éffectué avec succès, vous allez recevoir un email de
                            confirmation</h5>
                    </div>
                    <a href=" @if (auth()->user()->user_type == 'freelancer')
                        {{ route('freelancers.dashboard') }}

                    @else
                        {{ route('company.dashboard') }}
                    @endif"
                        class="btn btn-primary w-100 btn-lg login-btn d-flex align-items-center justify-content-center">
                        Aller au tableau de bord
                    </a>
                </div>
            </div>
        </div>
        <!-- /Login Content -->
    </div>
</div>
@endsection