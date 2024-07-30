<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFreelancerLevelRequest;
use App\Http\Requests\UpdateFreelancerLevelRequest;
use App\Models\FreelancerLevel;

class FreelancerLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $freelancerLevels = FreelancerLevel::orderBy('name')->get();
        return view('admin.freelancerLevel.index', compact('freelancerLevels'));
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
    public function store(StoreFreelancerLevelRequest $request)
    {
        $freelancerLevel = new FreelancerLevel([
            'name' => $request->get('name'),
        ]);

        $freelancerLevel->save();

        return redirect()->back()->with('success', 'Niveau de freelance créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(FreelancerLevel $freelancerLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FreelancerLevel $freelancerLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFreelancerLevelRequest $request, FreelancerLevel $freelancerLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FreelancerLevel $freelancerLevel)
    {
        //
    }
}
