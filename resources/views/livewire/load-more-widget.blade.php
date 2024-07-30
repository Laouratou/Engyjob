 <div class="row">
     @forelse ($projects as $project)
         <!--- Project Item  -->
         <div class="col-lg-4 col-md-6 d-flex">
             <div class="project-item feature-project-item aos" data-aos="fade-up">
                 <div class="project-img">
                     <a href="{{ route('projects/details', $project) }}">
                         <img src="{{ asset($project->image) }}" alt="Img" class="img-fluid"></a>
                 </div>
                 <div class="feature-content">
                     <div class="feature-time-blk">
                         <a href="javascript:void(0);"
                             class="btn btn-primary green-active">{{ $project->category->name }}</a>
                         <span><i class="far fa-clock me-1"></i>
                             {{ $project->created_at->diffForHumans() }}</span>
                     </div>
                     <h4><a href="{{ route('projects/details', $project) }}">{{ $project->name }}</a></h4>
                     <ul class="feature-project-list nav">
                         <li><i class="feather-user me-1"></i>{{ $project->category->name }}</li>
                         <li><i class="feather-map-pin me-1"></i>Ouaga.</li>
                     </ul>
                     <div class="feature-foot">
                         <div class="logo-company">
                             <a href="{{ route('projects/details', $project) }}">
                                 <img src="assets/img/icon/logo-icon-01.svg" class="me-1" alt="icon">
                                 <span>{{ $project->user->name }} {{ $project->user->first_name }}</span>
                             </a>
                         </div>
                         <a href="project-details.html" class="bid-now">Voir plus <i
                                 class="feather-arrow-right ms-1"></i></a>
                     </div>
                 </div>
             </div>
         </div>
         <!--- /Project Item  -->
     @empty
         @include('exemples.projects_vedette')
     @endforelse



     <div class="col-xl-12">
         <div class="more-project text-center aos" data-aos="fade-up">
             {{ $projects->links() }}

             <button wire:click="loadMore" class="btn btn-primary">Voir plus de projets</button>
         </div>
     </div>
 </div>
