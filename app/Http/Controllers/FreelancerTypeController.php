<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFreelancerTypeRequest;
use App\Http\Requests\UpdateFreelancerTypeRequest;
use App\Models\FreelancerType;

class FreelancerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $freelancerTypes = FreelancerType::orderBy('name')->get();
        return view('admin.freelancerType.index', compact('freelancerTypes'));
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
    public function store(StoreFreelancerTypeRequest $request)
    {
        $freelancerType = new FreelancerType([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        $freelancerType->save();

        return redirect()->back()->with('success', 'Type de freelance créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(FreelancerType $freelancerType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FreelancerType $freelancerType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFreelancerTypeRequest $request, FreelancerType $freelancerType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FreelancerType $freelancerType)
    {
        //
    }
}
