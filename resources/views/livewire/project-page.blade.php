

<div class="content">
    <div class="container">
        <div class="row">
            <!-- Colonne pour le filtrage -->
            <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
                <!-- Search Filter -->
                <div class="card search-filter">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title mb-0">Filtrer la liste</h4>
                    </div>
                    <div class="card-body">
                        <!-- Contenu du filtre ici... -->
                        <!-- Exemple de contenu de filtre -->
                        <div class="filter-widget">
                            <h4 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Catégorie
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h4>
                            <div id="collapseOne" class="collapse show" data-bs-parent="#accordionExample1">
                                @foreach ($categories as $key => $category)
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="category_id_{{ $category->id }}"
                                                wire:change="addOrRemoveCategory({{ $category->id }})"
                                                id="category_{{ $category->id }}">
                                            <span class="checkmark"></span> {{ $category->name }}
                                            ({{ $category->projects->count() }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="filter-widget">
                            <h4 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse"
                                    data-bs-target="#collapsproject" aria-expanded="true" aria-controls="collapseOne">
                                    Type de projet
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h4>
                            <div id="collapsproject" class="collapse show" data-bs-parent="#accordionExample1">
                                <div>
                                    <label class="custom_check">
                                        <input type="checkbox" name="budget_type_fixe" wire:model="budget_type_fixe()"
                                            wire:change="changeBudgetTypeFixe" value="1" id="budget_type_fixe">
                                        <span class="checkmark"></span>Fixe ({{ $project_fixe_count }})
                                    </label>
                                </div>
                                <div>
                                    <label class="custom_check">
                                        <input type="checkbox" name="budget_type_hourly"
                                            wire:model="budget_type_hourly()" wire:change="changeBudgetTypeHourly"
                                            id="budget_type_hourly" value="1">
                                        <span class="checkmark"></span>Par heure ({{ $project_hourly_count }})
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="filter-widget">
                            <h4 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
                                    Durée du projet
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h4>
                            <div id="collapseOne1" class="collapse show" data-bs-parent="#accordionExample1">
                                @foreach ($project_durations as $key => $project_duration)
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="project_duration_{{ $project_duration->id }}"
                                                id="project_duration_{{ $project_duration->id }}"
                                                wire:change="addOrRemoveProjectDuration({{ $project_duration->id }})">
                                            <span class="checkmark"></span> {{ $project_duration->name }}
                                            ({{ $project_duration->projects->count() }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="filter-widget">
                            <h4 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse"
                                    data-bs-target="#collapselanguagea" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Type de Freelancers
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h4>
                            <div id="collapselanguagea" class="collapse show" data-bs-parent="#accordionExample1">
                                @foreach ($freelancer_types as $key => $freelancer_type)
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="freelancer_type_{{ $freelancer_type->id }}"
                                                id="freelancer_type_{{ $freelancer_type->id }}"
                                                wire:change="addOrRemoveFreelancerType({{ $freelancer_type->id }})">
                                            <span class="checkmark"></span> {{ $freelancer_type->name }}
                                            ({{ $freelancer_type->projects->count() }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-search-">
                            <a href="{{ route('projects.liste') }}" type="button" class="btn btn-block">Réinitialiser</a>
                        </div>
                    </div>
                </div>
                <!-- /Search Filter -->
            </div>
            <!-- /Colonne pour le filtrage -->

            <!-- Colonne pour la liste des projets -->
            <div class="col-md-12 col-lg-8 col-xl-9">
                <div class="sort-tab develop-list-select">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="freelance-view">
                                    <h4>{{ count($projects_results) }} projets trouvés</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-flex justify-content-sm-end">
                            <div class="sort-by" style="display: none;">
                                <select class="select">
                                    <option>Pertinence</option>
                                    <option>Populaire</option>
                                    <option>Récent</option>
                                </select>
                            </div>
                            <ul class="list-grid d-flex align-items-center">
                                <li style="display: none;">
                                    <a href="#">
                                        <i class="fas fa-th-large"></i>
                                    </a>
                                </li>
                                <li style="display: none;">
                                    <a href="{{ route('projects.liste') }}" class="favour-active">
                                        <i class="fas fa-list"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="list-book-mark book-mark favour-book">
                    <div class="row">
                        <div class="col-lg-12">
                            @forelse ($projects_results as $project)
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
                                                @if (count($project->skills ?? []) > 1)
                                                    <div class="company-description">
                                                        <div class="tags">
                                                            @foreach ($project->skills as $item)
                                                                <a href="javascript:void(0);">
                                                                    <span
                                                                        class="badge badge-pill badge-design">{{ $item }}</span>
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
                                                   class="btn btn-submits"><i class="fa-solid fa-eye"></i> Voir le
                                                    projet
                                                </a>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center">
                                    <i class="fa-solid fa-cloud-bolt text-primary fa-5x mt-5 mb-3"></i>
                                    <h5 class="text-center text-muted fw-normal">Aucun projet n'est disponible pour le
                                        moment.
                                        <br> selon les critères de recherche
                                    </h5>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Colonne pour la liste des projets -->
        </div>
    </div>
</div>
