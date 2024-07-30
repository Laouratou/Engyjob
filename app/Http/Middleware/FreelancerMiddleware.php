<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FreelancerMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Vérifier si l'utilisateur est un freelanceur
        if ($user && $user->user_type === 'freelancer') {
            // Ajouter un message flash à la session et rediriger vers la même page
            return redirect()->back()->with('freelancer_error', 'Désolé, les freelancers ne sont pas autorisés à publier des projets.');
        }

        return $next($request);
    }
}
