<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
   
    public function toggle(Project $project)
    {
        $user = Auth::user();
    
        if ($user->favorites()->where('project_id', $project->id)->exists()) {
            $user->favorites()->detach($project->id);
            $message = 'Le projet a été retiré de vos favoris.';
        } else {
            $user->favorites()->attach($project->id);
            $message = 'Le projet a été ajouté à vos favoris.';
        }
    
        return back();
    }
     
    public function index(Request $request)
    {
        // Récupère l'utilisateur authentifié
        $user = Auth::user();
    
        // Récupère les IDs des projets favoris de l'utilisateur
        $favoriteIds = $user->favorites()->pluck('project_id')->toArray();
    
        // Si un category_id est passé dans la requête, stockez-le en session
        if ($request->category_id) {
            session()->put('category_id', $request->category_id);
        }
    
        // Récupère tous les projets actifs
        $projects = Project::where('is_active', 1)->get();
    
        // Récupère tous les projets (si nécessaire, selon la logique métier)
        // $projects = Project::all();
    
        // Récupère les projets favoris de l'utilisateur avec leurs informations paginées
        $favorites = $user->favorites()->with('category')->paginate(10);
    
        // Récupérer les profils associés aux utilisateurs des favoris
        $profiles = Profil::whereIn('user_id', $favorites->pluck('user_id'))->get();
    
        // Retourne la vue avec les données nécessaires
        return view('favorites.index', compact('favorites', 'favoriteIds', 'projects', 'profiles'));
    }
    
}
