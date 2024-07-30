<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\User;
use App\Models\Project;
use Auth;

class NoteController extends Controller
{
    public function create()
    {
        // Récupérer tous les freelancers pour le formulaire
        $freelancers = User::where('user_type', 'freelancer')->get();
        $projects = Project::all(); // Si nécessaire, charger tous les projets
        return view('notes.create', compact('freelancers', 'projects'));
    }

    public function store(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'project_id' => 'required|exists:projects,id',
            'freelancer_id' => 'required|exists:users,id',
            'proposal_id' => 'required|exists:proposals,id', // Ajout de la validation pour proposal_id
        ]);

        // Vérifier si l'utilisateur a déjà noté ce projet pour ce freelancer
        $existingNote = Note::where('project_id', $request->project_id)
                            ->where('freelancer_id', $request->freelancer_id)
                            ->where('user_id', Auth::id())
                            ->first();

        if ($existingNote) {
            return redirect()->back()->with('error', 'Vous avez déjà noté ce projet pour ce freelancer.');
        }

        try {
            // Créer une nouvelle note
            $note = new Note();
            $note->rating = $request->rating;
            $note->project_id = $request->project_id;
            $note->freelancer_id = $request->freelancer_id;
            $note->proposal_id = $request->proposal_id; // Enregistrer proposal_id
            $note->user_id = Auth::id();
            
            // Enregistrer la note
            $note->save();

            return redirect()->back()->with('success', 'Note enregistrée avec succès.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'enregistrement de la note : ' . $e->getMessage());
        }
    }
}
