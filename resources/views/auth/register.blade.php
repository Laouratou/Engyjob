@extends('layouts.app_login')

@section('content')
<div class="login-wrapper-">
    <div class="content w-100-">
        <!-- Login Content -->
        <div class="account-content" style="min-width: 68vw">
            <div class="row">
                <div class="col-sm-0 col-md-7"
                    style="background-image: url({{ asset('login_back.jpg') }}); border-radius: 15px; overflow: hidden;">
                </div>
                <div class="col-sm-12 col-md-5">
                    <div class="align-items-center justify-content-center mx-3">
                        <div class="login-right">
                            <div class="login-header text-center">
                                <a href="/">
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="logo" class="img-fluid">
                                </a>
                                <h3>Nous sommes heureux de vous voir<br>rejoindre la communauté</h3>
                            </div>


                            <h5>Je suis un :</h5>
                            <ul class="nav nav-tabs nav-justified nav-fill" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                        aria-selected="true">
                                        <span class="h4">Client</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link h3" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                        aria-selected="false">
                                        <span class="h4">Freelancer</span>
                                    </button>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    @include('auth.register_form_company')
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    @include('auth.register_form_freelance')
                                </div>

                            </div>


                            {{-- <nav class="user-tabs mb-4">
                                <ul role="tablist" class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="#company" data-bs-toggle="tab" class="nav-link active my-1">Client</a>
                                    </li>
                                    <li class="nav-item" style="min-width: 215px">
                                        <a href="#developer" data-bs-toggle="tab" class="nav-link my-1">Freelancer</a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="tab-content pt-0">
                                <div role="tabpanel" id="company" class="tab-pane fade active show">
                                    @include('auth.register_form_company')
                                </div>
                                <div role="tabpanel" id="developer" class="tab-pane fade">
                                    @include('auth.register_form_freelance')
                                </div>
                            </div> --}}

                            @include('components.flash_message')
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Login Content -->
    </div>
</div>
@endsection