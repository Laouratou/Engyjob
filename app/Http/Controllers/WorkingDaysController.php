<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkingDaysController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $selectedDays = $user->workingDays->pluck('name')->toArray();
        
        return view('work-hours', compact('selectedDays'));
    }

    public function update(Request $request)
    {
        // Valider les données
        $validatedData = $request->validate([
            'days' => 'nullable|array', // Assurez-vous que 'days' est un tableau
            'days.*' => 'string|in:Lun,Mar,Mer,Jeu,Ven,Sam,Dim', // Assurez-vous que chaque élément est parmi les jours de la semaine
        ]);

        // Mettre à jour les jours de travail pour l'utilisateur
        auth()->user()->workingDays()->sync($validatedData['days'] ?? []);

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Heures de travail mises à jour avec succès.');
    }
}
