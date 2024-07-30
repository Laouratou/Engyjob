@extends('layouts.app')
@section('content')
    <div class="content content-page">
        <div class="container">
            <div class="row">
                @include('components.freelancers_side_bar', ['active' => 'dashboard'])

                <div class="col-xl-9 col-lg-8">
                    <div class="dashboard-sec freelance-favourites">
                        <div class="page-title">
                            <h3>Mes commentaires</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @forelse($reviews as $key => $review)
                                    <div class="review-card">
                                        {{-- <h5>Fast and clear.</h5> --}}
                                        <p>{!! $review->comment !!}</p>
                                        <div class="reviewer-details-block">
                                            <div class="reviewer-img">
                                                <img src="{{ asset($review->user->profil->photo) }}"
                                                    class="avatar rounded-circle" alt="Img">
                                            </div>
                                            <div class="reviewer-details">
                                                <h6>{{ $review->user->name }} {{ $review->user->first_name }}</h6>
                                                <div class="d-flex">
                                                    <div class="rating">
                                                        <span>
                                                            @for ($i = 0; $i < $review->rate; $i++)
                                                                <i class="fas fa-star filled"></i>
                                                            @endfor
                                                            @for ($i = 0; $i < 5 - $review->rate; $i++)
                                                                <i class="fas fa-star"></i>
                                                            @endfor

                                                        </span>
                                                        {{-- <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star"></i> --}}
                                                        <span class="average-rating">({{ $review->rate . '.0' }})</span>
                                                    </div>
                                                    <div class="reviewer-log">
                                                        <i
                                                            class="feather-calendar"></i><span>{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center">
                                        <i class="fa-solid fa-cloud-bolt text-primary fa-5x mt-5 mb-3"></i>
                                        <h5 class="text-center text-muted fw-normal">Aucune donnée n'est disponible pour
                                            <br>le moment.

                                        </h5>
                                    </div>
                                @endforelse

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <ul class="paginations list-pagination">
                                    {{ $reviews->links() }}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- project list -->
                </div>

            </div>
        </div>
    </div>
@endsection
