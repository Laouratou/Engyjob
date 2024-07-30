<!-- resources/views/project/edit.blade.php -->

@extends('layouts.app_project')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modifier le projet</div>

                <div class="card-body">
                    <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Champ: Nom du projet -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom du projet</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $project->name) }}">
                        </div>

                        <!-- Champ: Description du projet -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description du projet</label>
                            <textarea id="description" name="description" class="form-control">{{ old('description', $project->description) }}</textarea>
                        </div>

                        <!-- Champ: Catégorie -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Catégorie</label>
                            <select id="category_id" name="category_id" class="form-select">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $project->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Ajouter ici d'autres champs pour les autres attributs du projet -->

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection