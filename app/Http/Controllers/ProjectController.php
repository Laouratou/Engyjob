<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Category;
use App\Models\FreelancerLevel;
use App\Models\FreelancerType;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\ProjectDuration;
use App\Models\ProjectFileUploaded;
use App\Models\ProjectLanguage;
use App\Models\ProjectLanguageLevel;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\WalletTransaction;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;



class ProjectController extends Controller
{
        /**
          * Display a listing of the resource.
          */
        public function index()
        {
        }

        /**
          * Show the form for creating a new resource.
          */
        public function create()
        {

                $categories = Category::where('is_active', 1)->get();
                $projectDurations = ProjectDuration::where('is_active', 1)->get();
                $freelancerTypes = FreelancerType::where('is_active', 1)->get();
                $freelancerLevels = FreelancerLevel::where('is_active', 1)->get();

                //skills
                $skills = Skill::where('is_active', 1)->get();

                // languages
                $projectLanguages = ProjectLanguage::where('is_active', 1)->get();
                $projectLanguageLevels = ProjectLanguageLevel::where('is_active', 1)->get();
                $config = Config::first(); 

                return view('project.create', compact(
                        'categories',
                        'projectDurations',
                        'freelancerTypes',
                        'freelancerLevels',
                        'projectLanguages',
                        'projectLanguageLevels',
                        'skills',
                        'config'
                ));
        }

        public function getFavoriteProjectsCount()
{
    $userId = Auth::id(); // Récupérer l'ID de l'utilisateur authentifié

    $favoriteCount = Favorite::where('user_id', $userId) // Assurez-vous que le modèle Favorite existe
        ->count();

    return response()->json(['count' => $favoriteCount]);
}

public function publishedProjects(): JsonResponse
    {
        try {
            // Assurez-vous que l'utilisateur est authentifié
            $userId = Auth::id();

            // Récupérer le nombre de projets publiés pour l'utilisateur authentifié
            $projectsCount = DB::table('projects')
                ->where('user_id', $userId)
                ->count();

            return response()->json(['total_projects' => $projectsCount]);
        } catch (Exception $e) {
            Log::error('Error retrieving projects: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getHiredProjects()
    {
        // Compte le nombre de projets où un freelancer est assigné
        $count = Project::whereNotNull('freelancer_id')->count();
        
        return response()->json(['count' => $count]);
    }
    




        public function getProposedProjects()
        {
            // Supposons que l'utilisateur est authentifié
            $userId = auth()->id(); // ID de l'utilisateur connecté
    
            // Compte le nombre de projets uniques pour lesquels l'utilisateur a fait des propositions
            $proposedProjectsCount = Proposal::where('user_id', $userId)
                                              ->distinct('project_id') // Assurez-vous que 'project_id' est le bon nom de colonne
                                              ->count('project_id'); // Compte les projets distincts
    
            return response()->json(['count' => $proposedProjectsCount]);
        }

        public function getUserProposalsCount()
{
    // Récupérer l'utilisateur authentifié
    $userId = Auth::id();

    // Compter le nombre de propositions faites par l'utilisateur
    $proposalsCount = Proposal::where('user_id', $userId)->count();

    return response()->json(['count' => $proposalsCount]);
}


        public function getUserProjectsWithProposals()
        {
            // Récupérer l'utilisateur authentifié
            $user = Auth::user();
    
            // Récupérer les projets auxquels l'utilisateur a fait des propositions
            $projects = Proposal::where('user_id', $user->id)
                ->with('project') // Assurez-vous que le modèle Proposal a la relation 'project'
                ->get()
                ->pluck('project'); // Extraire uniquement les projets
    
            return response()->json($projects);
        }
     

          public function store(StoreProjectRequest $request)
          {
              // Récupérer les configurations
              $config = Config::first(); // ou une méthode pour récupérer la config pertinente
          
              // Créer un nouveau projet
              $project = new Project();
          
              // Format de la date limite
              $project->deadline = Carbon::parse($request->deadline)->format('Y-m-d');
              $project->name = $request->name;
              $project->description = $request->description;
              $project->category_id = $request->category_id;
              $project->budget_type = $request->budget_type;
              $project->budget = $request->budget ?? $request->min_budget;
              $project->max_budget = $request->max_budget;
              $project->project_duration_id = $request->project_duration_id;
              $project->freelancer_type_id = $request->freelancer_type_id;
              $project->freelancer_level_id = $request->freelancer_level_id;
          
              $project->en_vedette = $request->en_vedette ?? 0;
              $project->is_hidden = $request->is_hidden ?? 0;
              $project->user_id = auth()->user()->id;
              $project->skills = $request->services;
          
              // Gestion des images
              if ($request->hasFile('cover_image')) {
                  $image = $request->file('cover_image');
                  $fileNameWithExtension = $image->getClientOriginalName();
                  $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                  $extension = $image->getClientOriginalExtension();
                  $fileNameToStore = '/projects_images/' . $fileName . '_' . time() . '.' . $extension;
                  $destinationPath = 'projects_images/';
                  $image->move($destinationPath, $fileNameToStore);
                  $project->image = $fileNameToStore;
              }
          
              $user = User::findOrFail(auth()->user()->id);
          
              // Vérification du solde pour le projet vedette
              if ($project->en_vedette == 1) {
                  if ($user->wallet < $config->pricevedette) { // Utiliser le prix de vedette de la config
                      return redirect()->back()->with('error', 'Solde insuffisant pour mettre en vedette le projet');
                  }
                  // Traitement de la transaction
                  $this->handleWalletTransaction($user, $config->pricevedette);
              }
          
              // Vérification du solde pour le projet confidentiel
              if ($project->is_hidden == 1) {
                  if ($user->wallet < $config->priceconfidentialite) { // Utiliser le prix de confidentialité de la config
                      return redirect()->back()->with('error', 'Solde insuffisant pour marquer le projet confidentiel');
                  }
                  // Traitement de la transaction
                  $this->handleWalletTransaction($user, $config->priceconfidentialite);
              }
          
              $project->save();
          
              // Gestion des fichiers de projet
              if ($request->hasFile('project_files')) {
                  $files = $request->file('project_files');
                  foreach ($files as $file) {
                      $fileNameWithExtension = $file->getClientOriginalName();
                      $name = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                      $filename = $name . '_' . substr(time(), 0, 4) . '.' . $file->getClientOriginalExtension();
                      $file->storeAs('public', $filename);
                      $projectFile = new ProjectFileUploaded();
                      $projectFile->name = $filename;
                      $projectFile->path = $filename;
                      $projectFile->size = filesize($file);
                      $projectFile->project_id = $project->id;
                      $projectFile->user_id = auth()->user()->id;
                      $projectFile->save();
                  }
              }
          
              return redirect()->back()->with('success', 'Projet enregistré avec succès');
          }
          
          // Fonction pour gérer les transactions de portefeuille
          private function handleWalletTransaction($user, $amount)
          {
              $wallet_transaction = new WalletTransaction();
              $wallet_transaction->code = "WT-" . $user->id . rand(100000, 999999) . '-' . substr(time(), 0, 4);
              $wallet_transaction->user_id = $user->id;
              $wallet_transaction->amount = $amount;
              $wallet_transaction->type = 'debit';
              $wallet_transaction->payment_method = "Portefeuille";
              $wallet_transaction->balance = $user->wallet - $amount;
              $wallet_transaction->save();
              $user->update(['wallet' => $user->wallet - $amount]);
          }
          
        /**
          * Display the specified resource.
          */
        public function show(Project $project)
        {
                //
        }

        public function details($id)
        {
                $project = Project::where('id', $id)->first();
                // dd($project);
                return view('project.details', compact('project'));
        }

        /**
          * Show the form for editing the specified resource.
          */
        public function edit(Project $project)
        {
                //
        }

        /**
          * Update the specified resource in storage.
          */
        public function update(UpdateProjectRequest $request, Project $project)
        {
                //
        }

        /**
          * Remove the specified resource from storage.
          */
        public function destroy(Project $project)
        {
                //
        }

        public function change_project_status(Request $request)
        {

                $project = Project::where('id', $request->change_project_status_id)->first();
                $project->status = $request->change_project_status;
                $project->save();

                return redirect()->back()->with('success', 'Statut du projet mis à jour');
        }
}