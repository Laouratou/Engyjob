@extends('layouts.app_login')

@section('content')
<div class="login-wrapper">
    <div class="content">
        <!-- Login Content -->
        <div class="account-content">
            <div class="align-items-center justify-content-center">
                <div class="login-right">
                    <div class="login-header text-center">
                        <a href="/">
                            <img src="assets/img/logo.png" alt="logo" class="img-fluid">
                        </a>
                        <h3>Bienvenu! C'est un plaisir de vous revoir</h3>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-block">
                            <label class="focus-label">Adresse e-mail <span class="label-star"> *</span></label>
                            <input type="text" class="form-control floating  @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" name="email" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-block">
                            <label class="focus-label">Mot de passe <span class="label-star"> *</span></label>
                            <div class="position-relative">
                                <input type="password"
                                    class="form-control floating pass-input @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">
                                <div class="password-icon ">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button
                            class="btn btn-primary w-100 btn-lg login-btn d-flex align-items-center justify-content-center"
                            type="submit">Se Connecter maintenant<i class="feather-arrow-right ms-2"></i></button>
                        {{-- <div class="login-or">
                            <p><span>Ou</span></p>
                        </div>
                        <div class="row social-login">
                            <div class="col-sm-6">
                                <a href="javascript:void(0);" class="btn btn-block"><img
                                        src="assets/img/icon/google-icon.svg" alt="Google">Google</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="javascript:void(0);" class="btn btn-block"><img
                                        src="assets/img/icon/fb-icon.svg" alt="Fb">Facebook</a>
                            </div>
                            <div class="col-sm-4">
                                <a href="javascript:void(0);" class="btn btn-block"><img
                                        src="assets/img/icon/ios-icon.svg" alt="Apple">Apple</a>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-sm-8 dont-have d-flex  align-items-center">Nouveau ici ? <a
                                    href="{{ route('register') }}" class="ms-2">Je m'inscrire?</a></div>
                            <div class="col-sm-4 text-sm-end">
                                <a class="forgot-link" href="{{ route('password.request') }}">Mot de passe oublié?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Login Content -->
    </div>
</div>
@endsection