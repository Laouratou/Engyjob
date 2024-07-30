<?php

namespace App\Http\Controllers;

use App\Models\EtapeCle;
use App\Http\Requests\StoreEtapeCleRequest;
use App\Http\Requests\UpdateEtapeCleRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class EtapeCleController extends Controller
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
        public function store(StoreEtapeCleRequest $request)
        {
                $project = Project::findOrFail($request->etape_project_id);

                $etapeCle = new EtapeCle();

                $etapeCle->name = $request->name;
                $etapeCle->price = $request->price;
                $etapeCle->description = $request->description;
                $etapeCle->start_date = $request->start_date;
                $etapeCle->end_date = $request->end_date;
                $etapeCle->project_id = $request->etape_project_id;
                $etapeCle->user_id = $project->user_id;
                $etapeCle->freelancer_id = $project->freelancer_id;

                $etapeCle->save();

                return redirect()->back()->with('success', 'Etape clé ajouté avec succès');
        }

        /**
          * Display the specified resource.
          */
        public function show(EtapeCle $etapeCle)
        {
                //
        }

        /**
          * Show the form for editing the specified resource.
          */
        public function edit(EtapeCle $etapeCle)
        {
                //
        }

        /**
          * Update the specified resource in storage.
          */
        public function update(UpdateEtapeCleRequest $request, EtapeCle $etapeCle)
        {
                //
        }

        /**
          * Remove the specified resource from storage.
          */
        public function destroy(EtapeCle $etapeCle)
        {
                //
        }
        public function change_stape_cle_status(Request $request)
        {
            $request->validate([
                'etape_cle_status' => 'required|in:pending,in_progress,cancelled,accepted,finished,rejected',
                'etape_cle_status_id' => 'required|exists:etape_cles,id',
            ], [
                'etape_cle_status.required' => 'Le statut de l\'étape clé est requis.',
                'etape_cle_status.in' => 'Le statut de l\'étape clé n\'est pas valide.',
                'etape_cle_status_id.exists' => 'L\'étape clé n\'existe pas.',
            ]);
        
            // Récupérer l'étape clé
            $etapeCle = EtapeCle::findOrFail($request->etape_cle_status_id);
        
            // Vérifier si l'utilisateur actuel est le créateur de l'étape clé
            if ($etapeCle->user_id === auth()->user()->id) {
                // Utilisateur créateur de l'étape clé
                if (!in_array($request->etape_cle_status, ['in_progress', 'cancelled'])) {
                    return response()->json(['error' => 'Vous ne pouvez pas mettre l\'étape clé à ce statut.'], 403);
                }
            } else {
                // Autres utilisateurs peuvent définir n'importe quel statut valide
                if (!in_array($request->etape_cle_status, ['pending', 'in_progress', 'cancelled', 'accepted', 'finished', 'rejected'])) {
                    return response()->json(['error' => 'Statut de l\'étape clé non valide pour cet utilisateur.'], 403);
                }
            }
        
            // Mettre à jour le statut de l'étape clé
            $newStatus = $request->etape_cle_status;
            $this->updateEtapeCleStatus($etapeCle, $newStatus);
        
            // Retourner une réponse JSON avec le statut mis à jour
            return response()->json(['success' => 'Etape clé modifiée avec succès', 'status' => $etapeCle->status]);
        }
        
        // Méthode pour mettre à jour le statut de l'étape clé
        protected function updateEtapeCleStatus(EtapeCle $etapeCle, $newStatus)
        {
            $etapeCle->status = $newStatus;
            $etapeCle->save();
        
            // Vous pouvez ajouter d'autres logiques ici, par exemple notifier d'autres parties de l'application
        }
        

}
