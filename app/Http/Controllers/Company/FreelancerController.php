<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use App\Models\Note;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    public function freelancers_list()
    {
        $notes = Note::all();
        return view('freelancers.freelancers_list',compact('notes'));
    }

    public function freelancers_details($freelancer_id)
    {
        $notes = Note::all();

        $freelancer = User::where('id', $freelancer_id)->first();

        $reviews = Review::where('freelancer_id', $freelancer_id)->get();

        return view('freelancers.freelancers_details', compact('freelancer', 'reviews','notes'));
    }
}
