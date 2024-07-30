@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Noter un Freelancer pour un Projet</h1>
    <form action="{{ route('notes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="freelancer_id">Freelancer</label>
            <select name="freelancer_id" id="freelancer_id" class="form-control">
                @foreach($freelancers as $freelancer)
                    <option value="{{ $freelancer->id }}">{{ $freelancer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="project_id">Projet</label>
            <select name="project_id" id="project_id" class="form-control">
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="rating">Note</label>
            <select name="rating" id="rating" class="form-control">
                <option value="1">★☆☆☆☆</option>
                <option value="2">★★☆☆☆</option>
                <option value="3">★★★☆☆</option>
                <option value="4">★★★★☆</option>
                <option value="5">★★★★★</option>
            </select>
        </div>


       
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</div>
@endsection
