<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\EtapeCle;
use App\Models\Project;
use App\Models\UserPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{

    public function companyDashboard()
    {
        $project_termines = Project::where('user_id', auth()->user()->id)
            ->where('status', 'completed')
            ->get();

        $etape_cle_termines = EtapeCle::where('user_id', auth()->user()->id)
            ->where('status', 'completed')
            ->get();

        $user_payment = UserPayment::where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->limit(12)
            ->get();
            $userType = Auth::user()->user_type;

        return view('company.company_dashboard', compact('project_termines', 'etape_cle_termines', 'user_payment','userType'));
    }

    public function user_payments()
    {

        $user_payment = UserPayment::where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('company.user_payments', compact('user_payment'));
    }
}
