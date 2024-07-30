<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function get_freelancer_reviews()
    {
        $reviews = Review::where('freelancer_id', auth()->user()->id)
            ->where('is_active', 1)
            ->paginate(10);

        return view('reviews.freelancers', compact('reviews'));
    }

    public function get_comapny_reviews()
    {
        $reviews = Review::where('user_id', auth()->user()->id)
            ->where('is_active', 1)
            ->paginate(10);

        return view('reviews.company', compact('reviews'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_freelancer_reviews(Request $request)
    {

        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'freelancer_id' => 'required|exists:users,id',
            'comment' => 'required',
            'rating' => 'required|integer|between:1,5',
        ], [
            'project_id.required' => 'Le projet est requis',
            'project_id.exists' => 'Le projet est invalide',
            'freelancer_id.required' => 'Le freelancer est requis',
            'freelancer_id.exists' => 'Le freelancer est invalide',
            'comment.required' => 'Le commentaire est requis',
            'rating.required' => 'La note est requise',
            'rating.integer' => 'La note doit être un nombre',
            'rating.between' => 'La note doit être comprise entre 1 et 5',
        ]);

        $review = new Review();
        $review->user_id = auth()->user()->id;
        $review->project_id = $request->project_id;
        $review->freelancer_id = $request->freelancer_id;
        $review->comment = $request->comment;
        $review->rate = $request->rating;
        $review->save();

        return redirect()->back()->with('success', 'Merci pour votre commentaire.');
    }

    public function store(StoreReviewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
