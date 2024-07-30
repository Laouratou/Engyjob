<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\EtapeCle;
use App\Models\Project;
use App\Models\Review;
use App\Models\ProjectFile;
use App\Models\Proposal;
use App\Models\Task;
use App\Models\User;
use App\Models\Note; 
use App\Models\Config; 
use Illuminate\Support\Facades\Mail;
use App\Mail\FreelancerHiredMail;
use Carbon\Carbon;
use App\Mail\CompanyNotified;

class ProjectController extends Controller
{
        public function projects_liste(Request $request)
        {

                if ($request->category_id) {
                        // session
                        session()->put('category_id', $request->category_id);
                }

                $projects = Project::where('is_active', 1)->get();
                return view('project.project_list', compact('projects'));
        }

        public function all_projects()
        {

                $projects = Project::where('is_active', 1)
                        ->where('user_id', auth()->user()->id)
                        ->get();


                // dd($projects);

                return view('company.projects.all_projects', compact('projects'));
        }
        public function details($id)
{
    // Récupérer le projet en s'assurant qu'il appartient à l'utilisateur connecté
    $project = Project::where('id', $id)
                      ->where('user_id', auth()->user()->id)
                      ->firstOrFail();
    
    // Récupérer les propositions marquées comme "sticky" pour ce projet
    $sticky_proposals = Proposal::where('is_sticky', true)
                                 ->where('project_id', $id)
                                 ->get();
    
    // Récupérer une proposition spécifique si nécessaire
    $proposal = Proposal::where('project_id', $id)
                        ->first();
    
    // Récupérer les évaluations spécifiques à ce projet
    $reviews = Review::where('project_id', $id)
                     ->get();
    
   
    return view('company.projects.details', compact('project', 'sticky_proposals', 'proposal', 'reviews'));
}

        
        

public function hire_freelancer(Request $request)
{
    // Validation des données de la requête
    $request->validate([
        'project_id' => 'required|exists:projects,id',
        'freelancer_id' => 'required|exists:users,id',
        'proposal_id' => 'required|exists:proposals,id',
    ]);

    // Récupération du freelancer, du projet et du modèle Proposal
    $freelancer = User::findOrFail($request->freelancer_id);
    $project = Project::findOrFail($request->project_id);
    $proposal = Proposal::findOrFail($request->proposal_id);

    // Mise à jour des détails du projet avec le freelancer embauché
    $project->freelancer_id = $request->freelancer_id;
    $project->status = 'ongoing';
    $project->hired_on = now();
    $project->proposal_id = $request->proposal_id;
    $project->save();

    // Envoi d'un email au freelancer embauché avec le modèle Proposal
    Mail::to($freelancer->email)->send(new FreelancerHiredMail($proposal));

    // Récupération de l'email de l'entreprise (user_id représentant l'entreprise)
    $company = User::find($project->user_id); // Assurez-vous que user_id correspond à l'entreprise
    if ($company) {
        Mail::to($company->email)->send(new CompanyNotified($freelancer, $project));
    } else {
        \Log::warning('Aucune entreprise associée au projet ' . $project->id);
    }

    // Redirection avec un message de succès
    return redirect()->back()->with('success', $freelancer->name . ' est assigné au projet ' . $project->name . '.');
}




        public function manage_etape_cles($project_id)
        {

                $project = Project::where('id', $project_id)
                        ->where('user_id', auth()->user()->id)
                        ->first();

                $etapes_cles = EtapeCle::where('project_id', $project->id)
                        ->orderBy('id', 'desc')
                        ->get();

                return view('Company.projects.manage_etape_cles', compact(
                        'project',
                        'etapes_cles'
                ));
        }

        public function manage_task($project_id)
        {
                $project = Project::where('id', $project_id)
                        ->where('user_id', auth()->user()->id)
                        ->first();

                $tasks = Task::where('project_id', $project->id)
                        ->orderBy('id', 'desc')
                        ->get();

                $etapes_cles = EtapeCle::where('project_id', $project->id)
                        ->get();

                return view('Company.projects.manage_task', compact('project', 'tasks', 'etapes_cles'));
        }

            public function project_files($project_id)
            {
                // Récupérer le projet pour vérification
                $project = Project::where('id', $project_id)
                    ->where('user_id', auth()->user()->id)
                    ->first();
        
                if (!$project) {
                    return redirect()->back()->with('error', 'Projet non trouvé ou vous n\'avez pas accès à ce projet.');
                }
        
                // Récupérer les fichiers du projet
                $projectFiles = ProjectFile::where('project_id', $project->id)
                    ->orderBy('id', 'desc')
                    ->get();
        
                return view('Company.projects.manage_file', compact('project', 'projectFiles'));
            }
        
            public function delete_project_file($file_id)
            {
                // Récupérer le fichier
                $file = ProjectFile::findOrFail($file_id);
        
                // Vérifier si l'utilisateur actuel est le créateur du fichier
                if ($file->added_by_user_id !== auth()->user()->id) {
                    return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer ce fichier.');
                }
        
                // Supprimer le fichier du système de fichiers
                // Assurez-vous d'ajouter la logique appropriée pour supprimer le fichier physique ici
                // par exemple: Storage::delete($file->path);
        
                // Supprimer le fichier de la base de données
                $file->delete();
        
                return redirect()->back()->with('success', 'Fichier supprimé avec succès.');
            }

        

        public function pending_projects()
        {

                $projects = Project::where('user_id', auth()->user()->id)
                        ->where('status', 'pending')
                        ->where('is_active', 1)
                        ->get();

                return view('company.projects.pending_projects', compact('projects'));
        }

        public function ongoing_projects()
        {

                $projects = Project::where('user_id', auth()->user()->id)
                        ->where('status', 'ongoing')
                        ->where('is_active', 1)
                        ->get();

                return view('company.projects.ongoing_projects', compact('projects'));
        }

        public function completed_projects()
        {

                $projects = Project::where('user_id', auth()->user()->id)
                        ->where('status', 'completed')
                        ->where('is_active', 1)
                        ->get();

                return view('company.projects.completed_projects', compact('projects'));
        }

        public function cancelled_projects()
        {

                $projects = Project::where('user_id', auth()->user()->id)
                        ->where('status', 'cancelled')
                        ->where('is_active', 1)
                        ->get();

                return view('company.projects.cancelled_projects', compact('projects'));
        }

        public function expired_projects()
        {

                //expired projects base on deadline
                $projects = Project::where('user_id', auth()->user()->id)
                        ->where('deadline', '<', date('Y-m-d'))
                        ->where('status', '!=', 'completed')
                        ->where('is_active', 1)
                        ->get();


                return view('company.projects.expired_projects', compact('projects'));
        }
}
