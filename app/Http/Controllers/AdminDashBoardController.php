<?php

namespace App\Http\Controllers;

use App\Models\IdVerification;
use App\Models\Membership;
use App\Models\Profil;
use App\Models\Project;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashBoardController extends Controller
{
    public function AdminDashboard()
    {

        $users_count = User::where('user_type', 'freelancer')->orWhere('user_type', 'company')->count();

        $completed_projects = Project::where('status', 'completed')->count();
        $ongoing_projects = Project::where('status', 'ongoing')->count();

        $pending_reviews = Review::where('is_active', 0)->get();
        $active_reviews = Review::where('is_active', 1)->get();
        $reviews = Review::get();

        return view('admin.admin_dashboard', compact(
            'users_count',
            'completed_projects',
            'ongoing_projects',
            'pending_reviews',
            'active_reviews',
            'reviews'
        ));
    }

    function admin_get_all_projects()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();

        return view('admin.projects.all_projects', compact('projects'));
    }

    function admin_get_all_freelancers()
    {
        $freelancers = User::where('user_type', 'freelancer')->get();
        return view('admin.freelancers.all_freelancers', compact('freelancers'));
    }

    function admin_get_all_companies()
    {
        $companies = User::where('user_type', 'company')->get();
        return view('admin.company.all_companies', compact('companies'));
    }

    function admin_get_all_memberships()
    {
        $memberships = Membership::orderBy('created_at', 'desc')->get();
        return view('admin.membership.all_memberships', compact('memberships'));
    }

    function admin_get_all_id_verifications()
    {

        $id_verifications = IdVerification::orderBy('created_at', 'desc')->get();

        return view('admin.id_verifications.all_id_verifications', compact('id_verifications'));
    }

    function change_is_verify_state(Request $request)
    {

        $id_verification = IdVerification::find($request->id);
        $id_verification->is_verified = !$id_verification->is_verified;
        $id_verification->verified_by_user_id = auth()->user()->id;
        $id_verification->save();

        $user = User::find($id_verification->user_id);
        $profil = Profil::where('user_id', $user->id)->first();
        $profil->is_verified = $id_verification->is_verified;
        $profil->save();

        return "success";
    }

    function change_is_rejected_state(Request $request)
    {

        $id_verification = IdVerification::find($request->id);
        $id_verification->is_rejected = !$id_verification->is_rejected;
        $id_verification->verified_by_user_id = auth()->user()->id;

        $id_verification->save();

        if ($id_verification->is_rejected) {

            $user = User::find($id_verification->user_id);
            $profil = Profil::where('user_id', $user->id)->first();
            $profil->is_verified = 0;
            $profil->save();
        }

        return "success";
    }
}
