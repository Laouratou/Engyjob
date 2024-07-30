@extends('layouts.app')

@section('content')
    <div class="content content-page">

        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">{{ __('Accès non autorisé') }}</div>
                        <div class="card-body">
                            {{ __("Vous n'êtes pas autorisé à accéder à cette page.") }}
                            <br>
                            <a href="{{ route('login') }}" class="btn btn-primary mt-2">{{ __('Réessayer') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
