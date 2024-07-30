@extends('layouts.app_admin')

@section('content')
<div class="container">
    <h1>Liste des services</h1>
    <a href="{{ route('services.create') }}" class="btn btn-primary">Créer un service</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Services autorisés à masquer</th>
                <th>Offres par projet</th>
                <th>Services à coller au sommet</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->name }}</td>
                <td>{{ $service->allowed_services }}</td>
                <td>{{ $service->offers_per_project }}</td>
                <td>{{ $service->featured_services }}</td>
                <td>
                    <a href="{{ route('services.show', $service->id) }}" class="btn btn-info">Voir</a>
                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
