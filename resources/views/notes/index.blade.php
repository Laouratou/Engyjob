@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mes Notes</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Freelancer</th>
                <th>Note</th>
             
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
                <tr>
                    <td>{{ $note->freelancer->name }}</td>
                    <td>{{ str_repeat('★', $note->rating) . str_repeat('☆', 5 - $note->rating) }}</td>
                  
                    <td>{{ $note->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
