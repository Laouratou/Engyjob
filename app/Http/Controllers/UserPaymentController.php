<?php

namespace App\Http\Controllers;

use App\Models\UserPayment;
use App\Http\Requests\StoreUserPaymentRequest;
use App\Http\Requests\UpdateUserPaymentRequest;
use App\Models\EtapeCle;
use App\Models\Project;
use App\Models\User;
use App\Models\WalletTransaction;

class UserPaymentController extends Controller
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
    public function store(StoreUserPaymentRequest $request)
    {
        $etape_cle = EtapeCle::findOrFail($request->etape_cle_payment_id);
        $project = Project::findOrFail($request->user_payment_project_id);
        $user = User::findorFail(auth()->user()->id);

        if ($user->wallet < $etape_cle->price) {
            return redirect()->back()->with('error', 'Solde insuffisant');
        }

        $user_payment = new UserPayment();
        $user_payment->code = "UP-" . auth()->user()->id . rand(100000, 999999) . '-' . substr(time(), 0, 4);
        $user_payment->user_id = auth()->user()->id;

        $user_payment->freelancer_id = $project->freelancer_id;
        $user_payment->project_id = $project->id;
        $user_payment->etape_cle_id = $etape_cle->id;
        $user_payment->payment_method = "Portefeuille";
        $user_payment->type = "debit";
        $user_payment->amount = $etape_cle->price;

        $etape_cle->update([
            'pay_status' => true,
        ]);
        $user_payment->save();

        $wallet_transaction = new WalletTransaction();
        $wallet_transaction->code = "WT-" . auth()->user()->id . rand(100000, 999999) . '-' . substr(time(), 0, 4);
        $wallet_transaction->user_id = auth()->user()->id;
        $wallet_transaction->amount = $etape_cle->price;
        $wallet_transaction->type = 'debit';
        $wallet_transaction->payment_method = "Portefeuille";
        $wallet_transaction->balance = $user->wallet - $etape_cle->price;
        $wallet_transaction->save();

        $user->update(['wallet' => $user->wallet - $etape_cle->price]);

        //update freelancer wallet
        $freelancer = User::find($project->freelancer_id);
        $freelancer->update(['wallet' => $freelancer->wallet + $etape_cle->price]);

        //save wallet transaction

        $wallet_transaction_freelancer = new WalletTransaction();
        $wallet_transaction_freelancer->code = "WT-" . $project->freelancer_id . rand(100000, 999999) . '-' . substr(time(), 0, 4);
        $wallet_transaction_freelancer->user_id = $project->freelancer_id;
        $wallet_transaction_freelancer->amount = $etape_cle->price;
        $wallet_transaction_freelancer->type = 'credit';
        $wallet_transaction_freelancer->payment_method = "-";
        $wallet_transaction_freelancer->balance = $user->wallet + $etape_cle->price;
        $wallet_transaction_freelancer->save();


        return redirect()->back()->with('success', 'Paiement effectuée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserPayment $userPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserPayment $userPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserPaymentRequest $request, UserPayment $userPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserPayment $userPayment)
    {
        //
    }
}
