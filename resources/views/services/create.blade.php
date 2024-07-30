@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Créer un service</h1>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('services.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom du service</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="allowed_services" class="form-label">Services autorisés à masquer</label>
                            <input type="number" class="form-control" id="allowed_services" name="allowed_services" required>
                        </div>
                        <div class="mb-3">
                            <label for="offers_per_project" class="form-label">Offres par projet</label>
                            <input type="number" class="form-control" id="offers_per_project" name="offers_per_project" required>
                        </div>
                        <div class="mb-3">
                            <label for="featured_services" class="form-label">Services à coller au sommet</label>
                            <input type="number" class="form-control" id="featured_services" name="featured_services" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
