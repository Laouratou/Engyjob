<?php

namespace App\Http\Controllers;

use App\Models\WalletTransaction;
use App\Http\Requests\StoreWalletTransactionRequest;
use App\Http\Requests\UpdateWalletTransactionRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;




class WalletTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wallet_transactions = WalletTransaction::where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('wallet_transactions.index', compact('wallet_transactions'));
    }
    public function transactionsPerMonth(): JsonResponse
    {
        try {
            // Assurez-vous que l'utilisateur est authentifié
            $userId = Auth::id();
    
            // Récupérer le nombre de transactions par mois pour l'utilisateur authentifié
            $transactions = DB::table('user_payments')
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total_transactions'))
                ->where('user_id', $userId)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->orderBy(DB::raw('MONTH(created_at)'))
                ->get();
    
            return response()->json($transactions);
        } catch (Exception $e) {
            Log::error('Error retrieving transactions: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    
  
    public function create()
    {
        //
    }
    public function store(StoreWalletTransactionRequest $request)
    {
        // $wallet_transaction = new WalletTransaction();
        // $wallet_transaction->code = "WT-" . auth()->user()->id . rand(100000, 999999) . '-' . substr(time(), 0, 4);
        // $wallet_transaction->user_id = auth()->user()->id;
        // $wallet_transaction->amount = $request->amount;
        // $wallet_transaction->type = 'credit';
        // $wallet_transaction->payment_method = $request->payment_method_wallet;
        // $wallet_transaction->status = 'pending';
        // $wallet_transaction->balance = auth()->user()->wallet; // Balance avant la confirmation du paiement
        // $wallet_transaction->save();
    
        // Redirection vers la route createInvoice avec le montant
        return redirect()->route('createInvoice', ['amount' => $request->amount])->with('success', 'Transaction initiée avec succès, en attente de confirmation');
    }
    
    
    

public function withdraw(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'phone_number' => 'required|digits:10', // Ajustez selon le format attendu
        ]);

        // Récupérer l'utilisateur authentifié
        $user = Auth::user();
        $amount = $request->input('amount');

        // Vérifier que l'utilisateur a suffisamment de fonds
        if ($user->wallet < $amount) {
            return redirect()->back()->with('error', 'Fonds insuffisants dans le portefeuille.');
        }

        // Préparer les données pour la requête de retrait
        $response = Http::post('https://api.ligdicash.com/withdrawal', [
            'amount' => $amount,
            'phone_number' => $request->input('phone_number'),
            // Ajoutez d'autres paramètres nécessaires comme les clés API ou les identifiants
        ]);

        // Traiter la réponse de LigdiCash
        if ($response->successful()) {
            $data = $response->json();
            if ($data['response_code'] === '00') {
                // Mise à jour du portefeuille de l'utilisateur
                $user->wallet -= $amount;
                $user->save();

                // Enregistrer la transaction dans la base de données
                $wallet_transaction = new WalletTransaction();
                $wallet_transaction->code = "WT-" . $user->id . rand(100000, 999999) . '-' . substr(time(), 0, 4);
                $wallet_transaction->user_id = $user->id;
                $wallet_transaction->amount = $amount;
                $wallet_transaction->type = 'debit';
                $wallet_transaction->payment_method = 'ligdicash';
                $wallet_transaction->balance = $user->wallet;
                $wallet_transaction->save();

                return redirect()->route('retrait')->with('success', 'Retrait effectué avec succès!');
            } else {
                return redirect()->back()->with('error', 'Erreur lors du retrait: ' . $data['response_text']);
            }
        } else {
            return redirect()->back()->with('error', 'Erreur de communication avec LigdiCash.');
        }
    }

  
    public function show(WalletTransaction $walletTransaction)
    {
        //
    }

   
    public function edit(WalletTransaction $walletTransaction)
    {
        //
    }

  
    public function update(UpdateWalletTransactionRequest $request, WalletTransaction $walletTransaction)
    {
        //
    }

  
    public function destroy(WalletTransaction $walletTransaction)
    {
        
    }
}