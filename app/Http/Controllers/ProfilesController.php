<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    // Méthode pour retourner les données de profil
    public function getProfileData()
    {
        // Exemple de données
        $data = [100, 150, 200, 250, 200, 250, 200, 200, 200, 200, 300, 350];

        return response()->json(['data' => $data]);
    }

    public function getProposalsByMonth()
{
    $userId = auth()->user()->id;

    // Récupérer le nombre de propositions par mois
    $proposalsCount = Proposal::where('user_id', $userId)
        ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Initialiser un tableau pour les mois
    $data = array_fill(0, 12, 0); // 12 mois, initialisé à 0

    // Remplir le tableau avec les données
    foreach ($proposalsCount as $proposal) {
        $data[$proposal->month - 1] = $proposal->count; // -1 car les mois commencent à 1
    }

    return response()->json(['data' => $data]);
}

    }

