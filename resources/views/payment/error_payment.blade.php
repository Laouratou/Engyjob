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
                        <i class="fa-regular fa-circle-xmark  text-danger fa-8x"></i>
                        <br>
                        <h2 class="text-danger mt-4 fw-bold">Ooops!</h2>
                        <h5 class="my-3">Une erreur est survenue
                            <br>
                            Veuillez reessayer plus tard
                        </h5>
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