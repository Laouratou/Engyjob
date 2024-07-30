<?php

namespace App\Http\Controllers;

use App\Models\Membership;

use App\Models\Plan;
use Illuminate\Http\Request;

class FreelancerMembershipController extends Controller
{
    public function freelancer_membership()
    {
        $membership = Membership::where('user_id', auth()->user()->id)
            ->where('is_cancelled', false)
            ->latest()
            ->first();

        $memberships = Membership::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
       
      
        $plans = Plan::with('service')->get(); 
        $user = auth()->user();
        $membership = $user->memberships()->where('is_active', true)->first();

        return view('freelancers.membership', compact('membership', 'memberships','plans'));
    }

    public function cancel_membership(Request $request)
    {
        $membership = Membership::where('user_id', auth()->user()->id)
            ->where('id', $request->membership_id)
            ->first();

        $membership->is_cancelled = true;

        $membership->save();
        return redirect()->back()->with('success', 'La souscription a bien été annulée');
    }
}
