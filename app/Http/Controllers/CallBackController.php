<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\WalletTransaction;
use App\Models\User;

class CallBackController extends Controller
{
    public function callback(Request $request)
    {

        Log::info("Callback Function");
        Log::info($request->all());

        // return "success";

        try {
            // Récupérez le contenu de la demande
            $payload = $request->getContent();
            $event = json_decode($payload);

            // Vérifiez si le décodage JSON a réussi
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('JSON decoding error: ' . json_last_error_msg());
                return response()->json(['status' => 'error', 'message' => 'Invalid JSON'], 400);
            }

            // Assurez-vous que les données nécessaires sont présentes
            if (!isset($event->token) || !isset($event->transaction_id) || !isset($event->status)) {
                Log::error('Callback data missing required fields', ['data' => $event]);
                return response()->json(['status' => 'error', 'message' => 'Missing required fields'], 400);
            }

            // Extraire les informations de la demande
            $token = $event->token;
            // $transaction_id = $event->transaction_id;
            $status = $event->status;

            // Trouvez la transaction associée
            $transaction = WalletTransaction::where('token', $token)->first();

            if ($transaction) {

                $user = User::findOrFail($transaction->user_id);

                Log::info(["user" => $user]);

                if ($status === "completed") {
                    // Mettre à jour le statut de la transaction dans la base de données

                    $transaction->status = "completed";
                    // $transaction->save();

                    // Créditer le compte de l'utilisateur
                    // $user = $transaction->user; // Assurez-vous que la relation user est définie dans le modèle WalletTransaction
                    $user->wallet += $transaction->amount;
                    $user->save();

                    // Mettre à jour le solde dans la transaction
                    $transaction->balance = $user->wallet;
                    $transaction->save();
                } elseif ($status === "failed") {
                    // Mettre à jour le statut de la transaction dans la base de données
                    $transaction->status = "failed";
                    $transaction->save();
                }
            } else {
                Log::warning('Transaction not found', ['token' => $token]);
                return response()->json(['status' => 'error', 'message' => 'Transaction not found'], 404);
            }

            // Répondez à la demande pour confirmer la réception du callback
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Callback processing error: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['status' => 'error', 'message' => 'Internal Server Error'], 500);
        }
    }
}
