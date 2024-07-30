@extends('layouts.app_project')

@section('content')

<div class="content content-page bookmark">                    
    <div class="container">                    
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h1 class="card-title">Politique de Confidentialité</h1>
                    </div>
                    <div class="card-body">
                        @if($configs->isNotEmpty())
                            @foreach ($configs as $config)
                                <div class="mb-4">
                                    <p class="text-justify" style="line-height: 1.6;"> {{ $config->confidentialite }}</p>
                                </div>
                            @endforeach
                        @else
                            <p>Aucune information de confidentialité trouvée.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.footer')

@endsection
