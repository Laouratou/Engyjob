<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectDurationRequest;
use App\Http\Requests\UpdateProjectDurationRequest;
use App\Models\ProjectDuration;

class ProjectDurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectDurations = ProjectDuration::orderBy('id', 'desc')->get();
        return view('admin.projectDuration.index', compact('projectDurations'));
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
    public function store(StoreProjectDurationRequest $request)
    {
        $projectDuration = new ProjectDuration();
        $projectDuration->name = $request->name;
        $projectDuration->save();

        return redirect()->back()->with('success', 'Durée de projet créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectDuration $projectDuration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectDuration $projectDuration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectDurationRequest $request, ProjectDuration $projectDuration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectDuration $projectDuration)
    {
        //
    }
}
