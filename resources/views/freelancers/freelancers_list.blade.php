@extends('layouts.app_project')

@section('content')
    <!-- Breadcrumb -->
    <div class="bread-crumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="col-md-12 col-12 text-center">
                    <div class="breadcrumb-list">
                        <h2>Liste des Freelancers</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                                <li class="breadcrumb-item" aria-current="page">Liste des Freelancers</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Page Content -->
    <livewire:freelancers-page />
    <!-- /Page Content -->
@endsection
