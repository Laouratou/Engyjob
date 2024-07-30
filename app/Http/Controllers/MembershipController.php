<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Http\Requests\StoreMembershipRequest;
use App\Http\Requests\UpdateMembershipRequest;
use App\Models\User;
use App\Models\Plan;
use App\Models\UserPayment;
use App\Models\WalletTransaction;
use Carbon\Carbon;

class MembershipController extends Controller
{
    
    public function index()
{
   

    return view('welcome', compact('plans', 'membership'));
}


    public function create()
    {
        
    }

    public function store(StoreMembershipRequest $request)
    {
        $user = auth()->user();
        
        // Récupérer le plan basé sur le nom du plan fourni
        $plan = Plan::where('name', $request->name)->first(); // Assurez-vous que le nom est correct
    
        if (!$plan) {
            return redirect()->back()->with('error', 'Le plan sélectionné est invalide.');
        }
    
        // Calculer le prix basé sur le prix du plan et la périodicité
        $price = $this->calculatePrice($plan->price, $request->periodicity);
    
        // Créer un nouvel abonnement
        $membership = new Membership();
        $membership->name = $plan->name;  // Utiliser le nom du plan
        $membership->invoice_code = "IV" . rand(100000, 999999) . '-' . substr(time(), 0, 4);
        $membership->purchase_date = Carbon::now();
        $membership->price = $price; // Utiliser le prix calculé
    
        // Déterminer la date d'expiration en fonction de la périodicité
        if ($request->periodicity == 'yearly') {
            $membership->expiry_date = Carbon::now()->addYear();
        } else {
            $membership->expiry_date = Carbon::now()->addMonth();
        }
    
        $membership->user_id = $user->id;
        $membership->user_type = $user->user_type;
        $membership->payment_method = $request->payment_method;
        $membership->periodicity = $request->periodicity; 
        $membership->is_active = true;
        $membership->is_cancelled = false;
    
        // Vérifier le solde du portefeuille de l'utilisateur
        if ($user->wallet < $membership->price) {
            return redirect()->back()->with('error', 'Le montant de votre solde est insuffisant. Veuillez contacter le support.');
        }
    
        // Créer une transaction de portefeuille
        $wallet_transaction = new WalletTransaction();
        $wallet_transaction->code = "WT-" . $user->id . rand(100000, 999999) . '-' . substr(time(), 0, 4);
        $wallet_transaction->user_id = $user->id;
        $wallet_transaction->amount = $membership->price;
        $wallet_transaction->type = 'debit';
        $wallet_transaction->payment_method = $request->payment_method;
        $wallet_transaction->balance = $user->wallet - $membership->price;
    
        // Mettre à jour le solde du portefeuille de l'utilisateur
        $user->wallet -= $membership->price;
        $user->save();
    
        // Sauvegarder la transaction et l'abonnement
        $wallet_transaction->save();
        $membership->save();
    
        // Désactiver les anciens abonnements de l'utilisateur
        $memberships = Membership::where('user_id', $user->id)
                                  ->where('id', '!=', $membership->id)
                                  ->get();
    
        foreach ($memberships as $oldMembership) {
            if ($oldMembership->created_at < $membership->created_at) {
                $oldMembership->is_active = false;
                $oldMembership->is_cancelled = true;
                $oldMembership->save();
            }
        }
    
        return redirect()->back()->with('success', 'La souscription a bien été enregistrée. Merci pour votre confiance.');
    }
    
    private function calculatePrice($planPrice, $periodicity)
    {
        if ($periodicity == 'yearly') {
            return (int)$planPrice * 12;
        } else {
            return (int)$planPrice;
        }
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMembershipRequest $request, Membership $membership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membership $membership)
    {
        //
    }
}
