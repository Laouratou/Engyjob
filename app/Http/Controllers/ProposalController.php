<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Http\Requests\StoreProposalRequest;
use App\Http\Requests\UpdateProposalRequest;
use App\Models\User;
use App\Models\Service;
use App\Models\Plan;
use App\Models\Config;
use App\Models\Membership;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;


class ProposalController extends Controller
{

    public function getProposalsReceived()
    {
        try {
            // Compte le nombre total de propositions
            $totalProposals = Proposal::count();

            return response()->json(['total_proposals' => $totalProposals]);
        } catch (\Exception $e) {
            // Gestion des erreurs
            return response()->json(['error' => 'Erreur lors de la récupération des propositions.'], 500);
        }
    }

    public function getPropositionsPerMonth()
{
    $userId = Auth::id(); // Récupérer l'ID de l'utilisateur authentifié

    $propositions = Proposal::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->where('user_id', $userId) // Filtrer par user_id
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

    return response()->json($propositions);
}


public function getHiredProposalsCount()
    {
        // Récupère l'utilisateur authentifié
        $userId = Auth::id(); 

        // Vérifiez la table et les colonnes spécifiques à votre projet
        // Assurez-vous que vous avez un champ 'status' ou similaire dans votre table
        $hiredProposalsCount = Proposal::where('status', 'hired')
                                      ->where('user_id', $userId)
                                      ->count();

        // Retourner la réponse JSON avec le nombre de propositions embauchées
        return response()->json(['count' => $hiredProposalsCount]);
    }


    
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
    public function store(StoreProposalRequest $request)
    {
        $user = auth()->user();
        $memberships = $user->memberships()
            ->where('is_active', true)
            ->where('is_cancelled', false)
            ->get();
    
        // Vérifiez si l'utilisateur a des abonnements actifs
        if ($memberships->isEmpty()) {
            return redirect()->back()->with('error', 'Vous devez avoir un abonnement actif pour faire une proposition.');
        }
    
        // Initialiser un tableau pour contenir les ID des services
        $serviceIds = [];
    
        // Récupérer les services basés sur les abonnements actifs
        foreach ($memberships as $membership) {
            $plan = Plan::where('name', $membership->name)->first();
            
            if ($plan) {
                // Récupérer les services associés au plan via service_id
                $services = Service::where('id', $plan->service_id)->pluck('id');
                $serviceIds = array_merge($serviceIds, $services->toArray());
            }
        }
    
        // Vérifiez si des services ont été trouvés
        if (empty($serviceIds)) {
            return redirect()->back()->with('error', 'Aucun service trouvé pour vos abonnements actifs.');
        }
    
        // Comptez le nombre de propositions existantes pour le projet
        $projectId = $request->project_id;
        $existingOffersCount = Proposal::where('project_id', $projectId)
                                       ->where('user_id', $user->id)
                                       ->count();
    
        // Déterminez la limite maximale d'offres par projet
        $offersPerProjectLimit = Service::whereIn('id', $serviceIds)->max('offers_per_project');
    
        // Vérifiez si la limite est dépassée
        if ($offersPerProjectLimit !== -1 && $existingOffersCount >= $offersPerProjectLimit) {
            return redirect()->back()->with('error', 'Vous avez atteint la limite d\'offres pour ce projet.');
        }
    
        // Récupérez les prix pour les options collées et masquées
        $stickyPrice = Config::where('type', 'sticky')->value('price');
        $hiddenPrice = Config::where('type', 'hidden')->value('price');
    
        // Gérer les transactions de portefeuille pour les options collées et masquées
        $isSticky = $request->is_sticky ?? false;
        $isHidden = $request->is_hidden ?? false;
    
        // Option collée
        if ($isSticky) {
            $stickyOffersCount = Proposal::where('project_id', $projectId)
                                          ->where('is_sticky', true)
                                          ->where('user_id', $user->id)
                                          ->count();
            
            $maxStickyOffers = Service::whereIn('id', $serviceIds)->max('featured_services');
    
            if ($maxStickyOffers !== -1 && $stickyOffersCount >= $maxStickyOffers) {
                return redirect()->back()->with('error', 'Vous avez atteint la limite d\'offres collées pour ce projet.');
            }
    
            if ($user->wallet < $stickyPrice) {
                return redirect()->back()->with('error', 'Solde insuffisant pour coller la proposition au sommet.');
            }
            $user->wallet -= $stickyPrice;
            $this->createWalletTransaction($user, $stickyPrice);
        }
    
        // Option masquée
        if ($isHidden) {
            $hiddenOffersCount = Proposal::where('project_id', $projectId)
                                          ->where('is_hidden', true)
                                          ->where('user_id', $user->id)
                                          ->count();
            
            $maxHiddenOffers = Service::whereIn('id', $serviceIds)->max('allowed_services');
    
            if ($maxHiddenOffers !== -1 && $hiddenOffersCount >= $maxHiddenOffers) {
                return redirect()->back()->with('error', 'Vous avez atteint la limite d\'offres masquées pour ce projet.');
            }
    
            if ($user->wallet < $hiddenPrice) {
                return redirect()->back()->with('error', 'Solde insuffisant pour masquer la proposition.');
            }
            $user->wallet -= $hiddenPrice;
            $this->createWalletTransaction($user, $hiddenPrice);
        }
    
        // Mettez à jour le solde du portefeuille de l'utilisateur
        $user->save();
    
        // Créez la proposition
        $proposal = new Proposal();
        $proposal->price = $request->price;
        $proposal->number_delivery_days = $request->number_delivery_days;
        $proposal->letter_cover = $request->letter_cover;
        $proposal->is_sticky = $isSticky;
        $proposal->is_hidden = $isHidden;
        $proposal->is_active = $request->is_active ?? true;
        $proposal->project_id = $projectId;
        $proposal->user_id = $user->id;
    
        $proposal->save();
    
        return redirect()->back()->with('success', 'Proposition enregistrée avec succès.');
    }
    
    
    private function createWalletTransaction($user, $amount)
    {
        $wallet_transaction = new WalletTransaction();
        $wallet_transaction->code = "WT-" . $user->id . rand(100000, 999999) . '-' . substr(time(), 0, 4);
        $wallet_transaction->user_id = $user->id;
        $wallet_transaction->amount = $amount;
        $wallet_transaction->type = 'debit';
        $wallet_transaction->payment_method = "Portefeuille";
        $wallet_transaction->balance = $user->wallet - $amount;
        $wallet_transaction->save();
    
        $user->update(['wallet' => $user->wallet - $amount]);
    }
    
    

private function handleWalletTransactions($user, $proposal)
{
    if ($proposal->is_sticky && $user->wallet < 2000) {
        return redirect()->back()->with('error', 'Solde insuffisant pour coller votre proposition en haut');
    }

    if ($proposal->is_sticky) {
    $this->createWalletTransaction($user, 2000);
    }

    if ($proposal->is_hidden && $user->wallet < 3500) {
        return redirect()->back()->with('error', 'Solde insuffisant pour cacher votre proposition');
    }

    if ($proposal->is_hidden) {
        $this->createWalletTransaction($user, 3500);
    }
}




    /**
     * Display the specified resource.
     */
    public function show(Proposal $proposal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proposal $proposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProposalRequest $request, Proposal $proposal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proposal $proposal)
    {
        //
    }
}
