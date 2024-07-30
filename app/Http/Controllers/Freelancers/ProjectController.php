<?php

namespace App\Http\Controllers\Freelancers;

use App\Http\Controllers\Controller;
use App\Models\EtapeCle;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\Proposal;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

        public function my_proposals()
        {
                $proposals = Proposal::where('user_id', auth()->user()->id)
                        ->where('is_active', 1)
                        ->orderBy('id', 'desc')
                        ->get();

                return view('freelancers.my_proposals', compact('proposals'));
        }

        public function project_details($id)
        {
                $project = Project::where('id', $id)
                        ->where('freelancer_id', auth()->user()->id)
                        ->first();

                $proposals = Proposal::where('project_id', $project->id)
                        ->where('user_id', auth()->user()->id)
                        ->get();
                       
                return view('freelancers.project_details', compact('project', 'proposals'));
        }

        //etape cles
        public function manage_etape_cles($project_id)
        {

                $project = Project::where('id', $project_id)
                        ->where('freelancer_id', auth()->user()->id)
                        ->first();

                $etapes_cles = EtapeCle::where('project_id', $project->id)
                        ->orderBy('id', 'desc')
                        ->get();

                return view('freelancers.manage_etape_cles', compact(
                        'project',
                        'etapes_cles'
                ));
        }

        
        public function manage_task($project_id)
        {
                $project = Project::where('id', $project_id)
                        ->where('freelancer_id', auth()->user()->id)
                        ->first();

                $tasks = Task::where('project_id', $project->id)
                        ->orderBy('id', 'desc')
                        ->get();

                $etapes_cles = EtapeCle::where('project_id', $project->id)
                        ->get();

                return view('freelancers.manage_task', compact('project', 'tasks', 'etapes_cles'));
        }

        //projectFile
        public function project_files($project_id)
{
    $project = Project::where('id', $project_id)
        ->where('freelancer_id', auth()->user()->id)
        ->first();

    if (!$project) {
        abort(404); // Si le projet n'appartient pas à l'utilisateur authentifié, retourner une erreur 404
    }

    $projectFiles = ProjectFile::where('project_id', $project->id)
        ->orderBy('id', 'desc')
        ->get();

    return view('freelancers.manage_file', compact('project', 'projectFiles'));
}

    // Méthode pour supprimer un fichier
    public function delete(ProjectFile $file)
    {
        // Vérifiez si l'utilisateur est autorisé à supprimer ce fichier
        if ($file->user_id != auth()->user()->id) {
            abort(403, 'Unauthorized action.'); // Retourne une erreur 403 si non autorisé
        }

        // Suppression du fichier de la base de données et/ou du stockage
        $file->delete();

        // Redirection avec un message de succès
        return back()->with('success', 'Le fichier a été supprimé avec succès.');
    }


        

        public function ongoing_projects()
        {

                $projects = Project::where('freelancer_id', auth()->user()->id)
                        ->where('status', 'ongoing')
                        ->where('is_active', 1)
                        ->get();


                return view('freelancers.ongoing_projects', compact('projects'));
        }

        public function completed_projects()
{
    // Récupérer les projets complétés du freelancer authentifié
    $projects = Project::where('freelancer_id', auth()->user()->id)
        ->where('status', 'completed')
        ->where('is_active', 1)
        ->with('reviews') // Charger les critiques avec les projets
        ->get();

    // Récupérer les critiques pour chaque projet
    $reviews = [];
    foreach ($projects as $project) {
        $reviews[$project->id] = $project->reviews;
    }

    return view('freelancers.completed_projects', compact('projects', 'reviews'));
}




        public function cancelled_projects()
        {

                $projects = Project::where('freelancer_id', auth()->user()->id)
                        ->where('status', 'cancelled')
                        ->get();

                return view('freelancers.cancelled_projects', compact('projects'));
        }

        public function expired_projects()
        {

                //expired projects base on deadline
                $projects = Project::where('freelancer_id', auth()->user()->id)
                        ->where('deadline', '<', date('Y-m-d'))
                        ->where('status', '!=', 'completed')
                        ->where('is_active', 1)
                        ->get();


                return view('freelancers.expired_projects', compact('projects'));
        }
}