@extends('layouts.app_admin')

@section('content')

<div class="container">
    <h1 class="mb-4">Liste des Configurations</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prix Vedette</th>
                        <th>Prix Confidentialité</th>
                        <th>Politique de Confidentialité</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($configs as $config)
                        <tr>
                            <td>{{ $config->id }}</td>
                            <td>{{ $config->pricevedette }}</td>
                            <td>{{ $config->priceconfidentialite }}</td>
                            <td>{{ $config->confidentialite }}</td>
                            <td>
                                <a href="{{ route('configs.show', $config->id) }}" class="btn btn-info">Voir</a>
                                <a href="{{ route('configs.edit', $config->id) }}" class="btn btn-warning">Modifier</a>
                                <form action="{{ route('configs.destroy', $config->id) }}" method="POST" style="display:inline;">
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
    </div>
</div>

@endsection
