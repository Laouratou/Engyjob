<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
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
    public function store(StoreTaskRequest $request)
    {
        // dd($request->all());
        $project = Project::findOrFail($request->task_project_id);

        $task = new Task();

        $task->name = $request->name;
        $task->description = $request->description;
        $task->end_date = $request->end_date;
        $task->project_id = $request->task_project_id;
        $task->user_id = $project->user_id;
        $task->freelancer_id = $project->freelancer_id;
        $task->etape_cle_id = $request->etape_cle_id;
        $task->status = $request->status;

        $task->save();

        return redirect()->back()->with('success', 'Tâche ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }

    public function change_task_status(Request $request)
    {
        $request->validate([
            'task_status' => 'required|in:pending,in_progress,completed,cancelled', // ajustez selon vos besoins
            'task_status_id' => 'required|exists:tasks,id',
        ], [
            'task_status.required' => 'Le statut est requis',
            'task_status.in' => 'Le statut de la tâche n\'est pas valide',
            'task_status_id.exists' => 'Cette tâche n\'existe pas',
        ]);
    
        // Récupérer la tâche
        $task = Task::findOrFail($request->task_status_id);
    
        // Vérifier si l'utilisateur actuel est le créateur de la tâche
        if ($task->user_id === auth()->user()->id) {
            // Utilisateur créateur de la tâche, vérifier les statuts restreints
            if (!in_array($request->task_status, ['in_progress', 'cancelled'])) {
                return redirect()->back()->with('error', 'Vous ne pouvez pas mettre la tâche à ce statut.');
            }
        } else {
            // Autres utilisateurs peuvent définir n'importe quel statut valide
            if (!in_array($request->task_status, ['pending', 'in_progress', 'completed', 'cancelled'])) {
                return redirect()->back()->with('error', 'Statut de la tâche non valide pour cet utilisateur.');
            }
        }
    
        // Mettre à jour le statut de la tâche
        $task->status = $request->task_status;
        $task->save();
    
        return redirect()->back()->with('success', 'Tâche modifiée avec succès');
    }
    

}