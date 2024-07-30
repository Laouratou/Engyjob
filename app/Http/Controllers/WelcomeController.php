<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use App\Models\Membership;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', 1)
            ->withCount('projects')
            ->orderBy('projects_count', 'desc')
            ->get();

        $projects = Project::where('is_active', 1)->where('en_vedette', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        $freelancers = User::where('user_type', 'freelancer')
            ->where('is_active', 1)
            ->orderBy('name', 'asc')
            ->limit(24)
            ->get();

        // Exemple de récupération des memberships (à adapter selon votre modèle et logique métier)
        $memberships = Membership::where('is_active', 1)->get();


        return view('welcome', compact('categories', 'projects', 'freelancers', 'memberships'));
    }
}
