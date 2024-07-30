@extends('layouts.app')

@section('content')
    <div class="content content-page">
        <div class="container">
            <div class="row">
                @include('components.freelancers_side_bar', ['active' => 'dashboard'])


                <div class="col-xl-9 col-lg-8">
                    <div class="page-title">
                        <h3>Gérer les projets</h3>
                    </div>
                    <nav class="user-tabs mb-4">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" href="javascript:void(0)">Aperçu & Discussions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('freelancers.projects.manage_etape_cles', $project->id) }}">
                                    Etapes clés
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('freelancers.projects.manage_tasks', $project->id) }}">
                                    Tâches
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('freelancers.projects.project_files', $project->id) }}">
                                    Fichiers
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="project-payment.html">Payments</a>
                            </li> --}}
                        </ul>
                    </nav>

                    <!-- project list -->
                    <div class="my-projects">
                        <!-- Proposals -->
                        <div class="freelancer-proposals proposal-ongoing">
                            <div class="project-proposals align-items-center freelancer">
                                <div class="proposal-info">
                                    <div class="proposals-details">
                                        <h3 class="proposals-title">{{ $project->name }}</h3>
                                        <ul>

                                            <li>
                                                <div class="proposal-client-price">
                                                    <h4 class="title-info">Budget</h4>
                                                    <h3 class="client-price">
                                                        {{ number_format($project->budget ?? 0, 0, ',', ' ') }} CFA
                                                        <span class="price-type">( @if ($project->budget_type == 'hourly')
                                                                Par heure
                                                            @else
                                                                Fixe
                                                            @endif )</span>
                                                    </h3>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="proposal-job-type">
                                                    <h4 class="title-info">Date limite du projet</h4>
                                                    <h3>{{ \Carbon\Carbon::parse($project->deadline)->format('d m Y') }}
                                                    </h3>
                                                </div>
                                            </li>
                                            @if ($project->freelancer_id)
                                                <li>
                                                    <div class="proposal-img">
                                                        <div class="proposal-client d-flex align-items-center">
                                                            <img src="{{ asset($project->user->profil->photo) }}"
                                                                alt="Img" class="img-fluid me-2">
                                                            <div>
                                                                <h4>{{ $project->user->name }}
                                                                    {{ $project->user->first_name }}</h4>
                                                                <span>{{ $project->user->company_name }} <i
                                                                        class="fa-solid fa-star"></i>5.0</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            @if ($project->status == 'pending')
                                                <li>
                                                    <div class="project-action text-center overview-action">
                                                        <button class="projects-btn btn_change_project_status"
                                                            data-project_id="{{ $project->id }}"
                                                            data-description="Confirmez-vous le début des traveaux de ce projet?"
                                                            data-status="ongoing">
                                                            Les travaux ont-ils débuté ?
                                                        </button>
                                                    </div>
                                                </li>
                                            @elseif($project->status != 'completed')
                                                <li>
                                                    @if ($project->status == 'ongoing')
                                                        <span class="badge badge-pill bg-success-light mx-3 mb-2">Projet
                                                            en cours</span>
                                                    @endif
                                                    {{-- <div class="project-action text-center overview-action">
                                                        <button class="projects-btn btn_change_project_status"
                                                            data-project_id="{{ $project->id }}"
                                                            data-description="Confirmez-vous que le projet est terminé ?"
                                                            data-status="completed">
                                                            Ce projet est-il terminé ?
                                                        </button>
                                                    </div> --}}


                                                </li>
                                            @elseif($project->status == 'completed')
                                                <span class="badge badge-pill bg-success">Projet terminé</span>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Proposals -->
                    </div>
                    <!-- /project list -->

                    <!-- Overview -->
                    <div class="overview-description">
                        <h4>Description</h4>
                        <p>{!! $project->description !!}</p>
                    </div>

                    <!-- /Overview -->

                    <!-- Skills Required -->
                    <div class="skill-required">
                        <h4>Compétences requises</h4>
                        <div class="pro-content">
                            <div class="tags">
                                @forelse ($project->skills as $skill)
                                    <span class="badge badge-pill badge-design">{{ $skill }}</span>
                                @empty
                                @endforelse
                            </div>

                            @if (count($project->skills) == 1)
                                <div class="text-center text-primary">
                                    <i class="fa-brands fa-cloudversify fa-4x"></i>
                                    <h5 class="mt-1">Aucune compétence n'est spécifiée pour<br>le moment.</h5>
                                </div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <!-- /Skills Required -->

                    <div class="proposals-section mb-4">
                        <h4 class="page-subtitle">Propositions</h4>

                        @forelse ($proposals as $proposal)
                            <div class="project-proposals align-items-center">
                                <div class="proposals-info">
                                    <div class="proposer-info">
                                        <div class="proposer-img">
                                            <img src="{{ asset($proposal->user->profil->photo) }}" alt="Img"
                                                class="img-fluid">
                                        </div>
                                        <div class="proposer-detail">
                                            <h4>{{ $proposal->user->name }} {{ $proposal->user->first_name }}</h4>
                                            <ul class="proposal-details">
                                                <li> {{ \Carbon\Carbon::parse($proposal->created_at)->diffForHumans() }}
                                                </li>
                                                <li><i class="fas fa-star text-primary"></i> 4 Commentaires</li>
                                                <li>
                                                    <a href="{{ route('freelancers.profile', $proposal->user->id) }}"
                                                        class="font-semibold text-primary">
                                                        Voir son profil
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="proposer-bid-info">
                                        <div class="proposer-bid">
                                            <h3>{{ number_format($proposal->price ?? 0, 0, ',', ' ') }} CFA @if ($proposal->project->budget_type == 'hourly')
                                                    /heure
                                                @endif
                                            </h3>

                                            <h5>
                                                En {{ $proposal->number_delivery_days }} jours
                                            </h5>
                                        </div>
                                        <div class="proposer-confirm">
    @if ($project->freelancer_id == null)
        <button type="button" id="hireButton" class="projects-btn openHireModalBtn"
                data-id="{{ $proposal->id }}"
                data-freelancer_id="{{ $proposal->user_id }}"
                data-project_id="{{ $proposal->project_id }}"
                data-freelancer_name="{{ $proposal->user->name }} {{ $proposal->user->first_name }}">
            Embaucher
        </button>
    @endif
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#hireButton').on('click', function() {
            var proposalId = $(this).data('id');
            var freelancerId = $(this).data('freelancer_id');
            var projectId = $(this).data('project_id');
            var freelancerName = $(this).data('freelancer_name');

            // Envoyer une requête AJAX vers votre backend
            $.ajax({
                url: '/process-hiring', // Remplacez par l'URL de votre endpoint Laravel
                method: 'POST',
                data: {
                    proposal_id: proposalId,
                    freelancer_id: freelancerId,
                    project_id: projectId,
                    freelancer_name: freelancerName
                },
                success: function(response) {
                    alert('Freelancer embauché avec succès!');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Une erreur s\'est produite lors de l\'embauche du freelancer.');
                }
            });
        });
    });
</script>

                                    </div>
                                </div>
                                <div class="description-proposal">
                                    <h5 class="desc-title">Description</h5>
                                    <p>{!! Str::substr($proposal->letter_cover, 0, 400) !!}
                                        <span id="dots">...</span>
                                        <span id="more"> {!! Str::substr($proposal->letter_cover, 400, strlen($proposal->letter_cover) - 400) !!}
                                        </span><span id="myBtn" class="text-primary font-bold readmore">Lire plus</span>
                                    </p>
                                </div>
                            </div>
                        @empty
                        @endforelse

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(".btn_change_project_status").click(function() {
                var id = $(this).data('project_id');
                var description = $(this).data('description');

                var status = $(this).data('status');

                $("#change_project_status_id").val(id);
                $("#change_project_status").val(status);

                //change span text
                $("#project_status").text(description);
                $("#change_project_status_modal").modal('show');

            });

            // $(".openHireModalBtn").click(function() {
            //     var id = $(this).data('id');
            //     var project_id = $(this).data('project_id');
            //     var freelancer_id = $(this).data('freelancer_id');

            //     var name = $(this).data('freelancer_name');

            //     $("#hireFreelancer_proposal_id").val(id);
            //     $("#hireFreelancer_project_id").val(project_id);
            //     $("#hireFreelancer_freelancer_id").val(freelancer_id);
            //     $("#hireFreelancer_freelancer_name").text(name);

            //     $("#hireFreelancerModal").modal('show');
            // })
        })
    </script>
@endsection
