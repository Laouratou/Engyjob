<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Models\Skill;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::orderBy('name')->get();

        return view('admin.skill.index', compact('skills'));
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
    public function store(StoreSkillRequest $request)
    {
        $skill = new Skill([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
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
                '/skills_images/' .
                $fileName .
                '_' .
                time() .
                '.' .
                $extension;
            $destinationPath = 'skills_images/';
            $image->move($destinationPath, $fileNameToStore);

            $skill->image = $fileNameToStore;
        }

        $skill->save();

        return redirect()->back()->with('success', 'Skill créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSkillRequest $request, Skill $skill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        //
    }
}
