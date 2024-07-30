<?php

namespace App\Http\Controllers;

use App\Models\ProjectFile;
use App\Http\Requests\StoreProjectFileRequest;
use App\Http\Requests\UpdateProjectFileRequest;
use App\Models\Project;

class ProjectFileController extends Controller
{
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
    public function store(StoreProjectFileRequest $request)
    {
        $project = Project::findOrFail($request->file_project_id);

        $projectFile = new ProjectFile();
        $projectFile->name = $request->name;
        $projectFile->description = $request->description;

        if ($request->hasFile('choosen_file')) {
            $file = $request->file('choosen_file');
            $fileNameWithExtension = $request
                ->file('choosen_file')
                ->getClientOriginalName();
            $name = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $filename = $name . '_' . substr(time(), 0, 4) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public', $filename);

            $projectFile->file_type = $file->getClientOriginalExtension();
            $projectFile->file_size = filesize($file);
            $projectFile->added_by_user_id = auth()->user()->id;
            $projectFile->project_id = $project->id;
            $projectFile->user_id = $project->user_id;
            $projectFile->freelancer_id = $project->freelancer_id;
            $projectFile->path = $filename;
        }

        $projectFile->save();

        return redirect()->back()->with('success', 'Fichier enregistré avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectFile $projectFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectFile $projectFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectFileRequest $request, ProjectFile $projectFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectFile $projectFile)
    {
        //
    }
}
