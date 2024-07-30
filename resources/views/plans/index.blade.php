@extends('layouts.app_admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <!-- Espace à gauche pour le layout -->
        <div class="col-md-2">
            <!-- Cet espace est réservé pour le layout -->
        </div>
        <!-- Contenu principal -->
        <div class="col-md-10">
            <h1 class="mb-4">Liste des plans</h1>
            <a href="{{ route('plans.create') }}" class="btn btn-primary mb-3">Créer un nouveau plan</a>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Description</th>
                            <th>Service</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plans as $plan)
                            <tr>
                                <td>{{ $plan->id }}</td>
                                <td>{{ $plan->name }}</td>
                                <td>{{ $plan->price }}</td>
                                <td>{{ $plan->description }}</td>
                                <td>{{ $plan->service ? $plan->service->name : 'Aucun service associé' }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('plans.show', $plan) }}" class="btn btn-info btn-sm mr-1">Voir</a>
                                    <a href="{{ route('plans.edit', $plan) }}" class="btn btn-warning btn-sm mr-1">Modifier</a>
                                    <form action="{{ route('plans.destroy', $plan) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    
        </div>
    </div>
</div>
@endsection
