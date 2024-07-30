@extends('layouts.app')

@section('content')
    <div class="content content-page">
        <div class="container">
            <div class="row">
                @include('components.company_side_bar', ['active' => 'dashboard'])

                <div class="col-xl-9 col-lg-8">
                    <div class="page-title">
                        <h3>Projets en favoris</h3>
                    </div>
         
                <div class="row">
                    @forelse ($favorites as $project)
                        <div class="col-lg-12 mb-4">
                            <div class="project-list-card">
                                <form id="toggle-favorite-form-{{ $project->id }}"
                                      action="{{ route('projects.favorite.toggle', $project->id) }}"
                                      method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-link add-fav-list {{ $project->isFavorited() ? 'favorited' : 'not-favorited' }}"
                                            data-id="{{ $project->id }}">
                                        <i class="fa {{ $project->isFavorited() ? 'fas' : 'far' }} fa-heart"></i>
                                    </button>
                                </form>

                                <div class="company-detail-image">
                                    <img src="{{ asset($project->category->image) }}" class="img-fluid"
                                         alt="logo">
                                </div>
                                <div>
                                    <div class="company-title">
                                        <p>{{ $project->category->name }}</p>
                                        <h4>{{ $project->name }}</h4>
                                    </div>
                                    <div class="company-splits">
                                        <div>
                                            <div class="company-address">
                                                <ul>
                                                    <li><i class="feather-map-pin"></i>Ouagadougou</li>
                                                    <li><i class="feather-calendar"></i>publié le
                                                        {{ \Carbon\Carbon::parse($project->created_at)->format('d M, Y') }}
                                                    </li>
                                                    <li><i class="feather-file-2"></i>{{ $project->proposals->count() }}
                                                        Proposition(s)
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="company-description-"
                                                 style="display: -webkit-box;
                                                        -webkit-line-clamp: 2;
                                                        -webkit-box-orient: vertical;
                                                        overflow: hidden;">
                                                {!! $project->description !!}
                                            </div>
                                            @if (count($project->skills ?? []) > 0)
                                                <div class="company-description">
                                                    <div class="tags">
                                                        @foreach ($project->skills as $item)
                                                            <a href="javascript:void(0);">
                                                                <span class="badge badge-pill badge-design">{{ $item }}</span>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="company-split-price">
                                            <h5>
                                                @if ($project->budget_type == 'hourly')
                                                    {{ number_format($project->budget ?? 0, 0, ',', ' ') }} CFA -
                                                    {{ number_format($project->max_budget ?? 0, 0, ',', ' ') }} CFA
                                                @else
                                                    {{ number_format($project->budget ?? 0, 0, ',', ' ') }} CFA
                                                @endif
                                            </h5>
                                            <h6>Budget @if ($project->budget_type == 'hourly')
                                                        par heure
                                                    @else
                                                        fixe
                                                    @endif
                                            </h6>
                                            <a href="{{ route('projects/details', $project) }}"
                                               class="btn btn-submits"><i class="fa-solid fa-eye"></i> Voir le projet
                                            </a>

                                            <!-- Ajout des détails supplémentaires -->
                                            <div class="project-details">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-12 text-center">
                            <i class="fa-solid fa-cloud-bolt text-primary fa-5x mt-5 mb-3"></i>
                            <h5 class="text-center text-muted fw-normal">Aucun projet favori disponible pour le moment.</h5>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
