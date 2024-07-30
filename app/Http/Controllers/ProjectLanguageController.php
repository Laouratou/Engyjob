<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectLanguageRequest;
use App\Http\Requests\UpdateProjectLanguageRequest;
use App\Models\ProjectLanguage;

class ProjectLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectLanguages = ProjectLanguage::orderBy('name')->get();
        return view('admin.projectLanguage.index', compact('projectLanguages'));
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
    public function store(StoreProjectLanguageRequest $request)
    {
        $projectLanguage = new ProjectLanguage([
            'name' => $request->get('name'),
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileNameWithExtension = $request
                ->file('image')
                ->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $request
                ->file('image')
                ->getClientOriginalExtension();
            $fileNameToStore =
                '/languages_images/' .
                $fileName .
                '_' .
                time() .
                '.' .
                $extension;
            $destinationPath = 'languages_images/';
            $image->move($destinationPath, $fileNameToStore);

            $projectLanguage->flag = $fileNameToStore;
        }

        $projectLanguage->save();

        return redirect()->back()->with('success', 'La langue créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectLanguage $projectLanguage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectLanguage $projectLanguage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectLanguageRequest $request, ProjectLanguage $projectLanguage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectLanguage $projectLanguage)
    {
        //
    }
}
