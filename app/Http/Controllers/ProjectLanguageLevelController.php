<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectLanguageLevelRequest;
use App\Http\Requests\UpdateProjectLanguageLevelRequest;
use App\Models\ProjectLanguageLevel;

class ProjectLanguageLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectLanguageLevels = ProjectLanguageLevel::orderBy('name')->get();
        return view('admin.projectLanguageLevel.index', compact('projectLanguageLevels'));
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
    public function store(StoreProjectLanguageLevelRequest $request)
    {
        $projectLanguageLevel = new ProjectLanguageLevel([
            'name' => $request->get('name'),
        ]);

        $projectLanguageLevel->save();

        return redirect()->back()->with('success', 'Niveau de langue créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectLanguageLevel $projectLanguageLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectLanguageLevel $projectLanguageLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectLanguageLevelRequest $request, ProjectLanguageLevel $projectLanguageLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectLanguageLevel $projectLanguageLevel)
    {
        //
    }
}
