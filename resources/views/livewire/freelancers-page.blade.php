<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">

                <!-- Search Filter -->
                <div class="card search-filter">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title mb-0">Filtrer la liste</h4>
                    </div>
                    <div class="card-body">

                        <div class="filter-widget">
                            <h4 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Catégories
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h4>
                            <div id="collapseOne" class="collapse show" data-bs-parent="#accordionExample1">
                                

                                @foreach ($categories as $category)
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="category_id_{{ $category->id }}"
                                                id="category_{{ $category->id }}"
                                                wire:change="addOrRemoveCategory({{ $category->id }})">
                                            <span class="checkmark"></span> {{ $category->name }}
                                            ({{ $category->freelancers->count() }})
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
                                    Disponsibilité
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h4>
                            <div id="collapselanguagea" class="collapse show" data-bs-parent="#accordionExample1">
                                @foreach ($freelancersTypes as $freelancerType)
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="freelancer_type_{{ $freelancerType->id }}"
                                                id="freelancer_type_{{ $freelancerType->id }}"
                                                wire:change="addOrRemoveFreelancerType({{ $freelancerType->id }})">
                                            <span class="checkmark"></span> {{ $freelancerType->name }}
                                            {{-- ({{ $freelancerType->freelancers->count() }}) --}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="filter-widget">
                            <h4 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse"
                                    data-bs-target="#collapsproject" aria-expanded="true" aria-controls="collapseOne">
                                    Compte
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h4>
                            <div id="collapsproject" class="collapse show" data-bs-parent="#accordionExample1">
                                <div>
                                    <label class="custom_check">
                                        <input type="checkbox" name="select_time" wire:change="changeVerified">
                                        <span class="checkmark"></span>Vérifié
                                    </label>
                                </div>
                                {{-- <div>
                                    <label class="custom_check">
                                        <input type="checkbox" name="select_time">
                                        <span class="checkmark"></span>Tout
                                    </label>
                                </div> --}}
                            </div>
                        </div>


                        <div class="btn-search-">
                            {{-- <button type="button" class="btn btn-primary">Search</button> --}}
                            <a href="{{ route('freelancers.liste') }}" class="btn btn-block">Réinitialiser</a>
                        </div>
                    </div>
                </div>
                <!-- /Search Filter -->

            </div>

            <div class="col-md-12 col-lg-8 col-xl-9">
                <div class="sort-tab develop-list-select">
                    <div class="sort-tab develop-list-select">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="d-flex align-items-center mt-6">
                                    <div class="freelance-view">
                                        <h4>{{ count($freelancers_results) }} freelancers trouvés</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-flex justify-content-sm-end d-none">
                            <div class="sort-by">
                              <select class="select ">
                           <option>Pertinence</option>
                             <option>Notation</option>
                                <option>Populaire</option>
                                <option>Récent</option>
                                <option>Gratuit</option>
                            </select>
                        </div>
                        <ul class="list-grid d-flex align-items-center mb-6">
                            <li><a href="#"><i class="fas fa-th-large"></i></a></li>
                            <li><a href="{{ route('freelancers.liste') }}" class="favour-active"><i class="fas fa-list"></i></a></li>
                        </ul>
                    </div>
                <div class="list-book-mark book-mark favour-book">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">

                            @forelse ($freelancers_results as $freelancer)
                                <div class="card list-develop-group">
                                    <div class="about-author d-flex align-items-center">
                                        <div class="about-list-author d-flex align-items-center">
                                            <div class="about-author-img">
                                                <div class="author-img-wrap">
                                                    <a href="{{ route('freelancers.profile', $freelancer->id) }}">
                                                        <img class="img-fluid" alt="Img"
                                                            src="{{ asset($freelancer->profil->photo) }}">
                                                        @if ($freelancer->profil->is_verified)
                                                            <span class="verified">
                                                                <i class="fas fa-check-circle"></i>
                                                            </span>
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="author-details d-flex">
                                                <div class="freelance-info">
                                                    <h3>
                                                        <a href="{{ route('freelancers.profile', $freelancer->id) }}">
                                                            {{ $freelancer->name }} {{ $freelancer->first_name }}
                                                        </a>
                                                    </h3>
                                                    <div class="freelance-specific">
                                                        {{ '@' . $freelancer->profil->username }}
                                                    </div>
                                                    <div class="freelance-location"><i
                                                            class="feather-map-pin me-1"></i>{{ $freelancer->profil->ville }},
                                                        {{ $freelancer->profil->pays }}</div>
                                                </div>
                                                
                                                <div class="freelance-rating">
                                                    <div class="rating">
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star"></i>
                                                        <span class="average-rating">4.7 (32)</span>
                                                    </div>
                                                    <div class="freelance-tags- border-0">
                                                        <a href="javascript:void(0);">
                                                            <span class="badge badge-pill badge-design">
                                                                @if ($freelancer->profil->category)
                                                                    {{ $freelancer->profil->category->name }}
                                                                @endif
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="freelance-price">
                                                    <div class="freelance-price-img">
                                                        <img src="{{ asset('/assets/img/icon/price.png') }}"
                                                            alt="img">
                                                    </div>
                                                    <div class="freelance-price-content">
                                                        <h6>Prix</h6>
                                                        <h5>{{ $freelancer->profil->prix }} CFA / H</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="develop-list-pro">
                                            <div class="cart-hover">
                                                <a href="{{ route('freelancers.profile', $freelancer->id) }}"
                                                    class="btn-cart" tabindex="-1">
                                                    Voir le profil
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center">
                                    <i class="fa-solid fa-cloud-bolt text-primary fa-5x mt-5 mb-3"></i>
                                    <h5 class="text-center text-muted fw-normal">Aucun freelancer n'est disponible pour
                                        le
                                        moment.
                                        <br> selon les critères de recherche
                                    </h5>
                                </div>
                            @endforelse
                        </div>

                        {{--
                        @if (count($freelancers_results) > 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="paginations list-pagination">
                                        <li class="page-item">
                                            <a href="javascript:void(0);">
                                                <i class="feather-chevron-left"></i>
                                            </a>
                                        </li>
                                        <li class="page-item"><a href="javascript:void(0);" class="active">1</a></li>
                                        <li class="page-item"><a href="javascript:void(0);">2</a></li>
                                        <li class="page-item"><a href="javascript:void(0);">3</a></li>
                                        <li class="page-item"><a href="javascript:void(0);">...</a></li>
                                        <li class="page-item"><a href="javascript:void(0);">10</a></li>
                                        <li class="page-item">
                                            <a href="javascript:void(0);">
                                                <i class="feather-chevron-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
