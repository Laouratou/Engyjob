@extends('layouts.app_admin')

@section('content')

<div class="container">
    <h1 class="mb-4">Créer une Nouvelle Configuration</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('configs.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="pricevedette" class="form-label">Prix Vedette</label>
                    <input type="number" step="0.01" name="pricevedette" id="pricevedette" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="priceconfidentialite" class="form-label">Prix Confidentialité</label>
                    <input type="number" step="0.01" name="priceconfidentialite" id="priceconfidentialite" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="confidentialite" class="form-label">Politique de Confidentialité</label>
                    <textarea name="confidentialite" id="confidentialite" class="form-control" rows="4"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Créer</button>
            </form>
        </div>
    </div>
</div>

@endsection
