<?php

namespace App\Http\Controllers\Freelancers;

use App\Http\Controllers\Controller;
use App\Models\EtapeCle;
use App\Models\Project;
use App\Models\UserPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    public function FreelancersDashboard()
    {

        $project_termines = Project::where('freelancer_id', auth()->user()->id)
            ->where('status', 'completed')
            ->get();

        $etape_cle_termines = EtapeCle::where('freelancer_id', auth()->user()->id)
            ->where('status', 'completed')
            ->get();

        $user_payment = UserPayment::where('user_id', auth()->user()->id)
            ->get();
            $user = Auth::user(); // Récupère l'utilisateur connecté

        return view('freelancers.dashboard', compact('project_termines', 'etape_cle_termines', 'user_payment','user'));
    }

    public function user_payments()
    {

        $user_payment = UserPayment::where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('freelancers.user_payments', compact('user_payment'));
    }
}
