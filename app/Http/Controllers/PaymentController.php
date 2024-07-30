<?php

namespace App\Http\Controllers;

use App\Services\LigdiCashService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction; // Assurez-vous d'importer le modèle Transaction si vous l'utilisez
use App\Models\WalletTransaction; // Assurez-vous d'importer le modèle Transaction si vous l'utilisez
use App\Models\User;

class PaymentController extends Controller
{
    protected $ligdiCashService;

    public function __construct(LigdiCashService $ligdiCashService)
    {
        $this->ligdiCashService = $ligdiCashService;
    }

    public function createInvoice(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $totalAmount = (int) $request->input('amount');

        $data = [
            'commande' => [
                'invoice' => [
                    'items' => [
                        [
                            'name' => 'Recharge portefeuille',
                            'description' => 'Recharge portefeuille sur cacheJob',
                            'quantity' => 1,
                            'unit_price' => $totalAmount,
                            'total_price' => $totalAmount
                        ],
                    ],
                    'total_amount' => $totalAmount,
                    'devise' => 'XOF',
                    'description' => 'Recharge de portefeuille sur https://cachejob.com',
                    'customer' => '',
                    'customer_firstname' => auth()->user()->first_name,
                    'customer_lastname' => auth()->user()->name,
                    'customer_email' => auth()->user()->email,
                    'external_id' => '',
                    'otp' => ''
                ],
                'store' => [
                    'name' => 'Ma boutique',
                    'website_url' => 'https://cachejob.com'
                ],
                'actions' => [
                    'cancel_url' => route('error_payment'), // URL d'erreur
                    'return_url' => route('success_payment'), // URL de succès
                    'callback_url' => 'https://cachejob.com/callback',

                ],
                'custom_data' => [
                    'order_id' => 'TR-' . time(),
                    'transaction_id' => 'TR-' . time()
                ]
            ]
        ];

        $response = $this->ligdiCashService->createInvoice($data);

        if ($response['response_code'] === '00') {
            // Rediriger vers l'URL de paiement

            $wallet_transaction = new WalletTransaction();
            $wallet_transaction->code = "WT-" . auth()->user()->id . rand(100000, 999999) . '-' . substr(time(), 0, 4);
            $wallet_transaction->user_id = auth()->user()->id;
            $wallet_transaction->amount = $totalAmount;
            $wallet_transaction->type = 'credit';
            $wallet_transaction->payment_method = "LigdiCash";
            $wallet_transaction->token = $response['token'];

            $user = User::where('id', auth()->user()->id)->first();
            // $user->update(['wallet' => $user->wallet + $request->amount]);
            $wallet_transaction->balance = $user->wallet;
            $wallet_transaction->save();

            return redirect($response['response_text']);
        } else {
            // Gérer les erreurs
            return redirect()->back()->with('error', 'Erreur lors de la création de la facture: ' . $response['response_text']);
        }
    }

    public function createWithdrawal(Request $request)
    {
        // Validation des données de la requête
        $data = $request->validate([
            'amount' => 'required|integer|min:100',
            'customer' => 'required|string',
        ]);

        $my_transaction_id = 'RW-' . time();


        // Vérifier le solde du portefeuille de l'utilisateur connecté
        $user = auth()->user(); // Récupère l'utilisateur actuellement connecté

        // Log du nom de l'utilisateur et du solde du portefeuille
        // \Log::info('Utilisateur connecté:', [
        //     'name' => $user->name,
        //     'wallet_balance' => $user->wallet
        // ]);

        // Vérifiez si l'utilisateur a suffisamment de fonds
        if ($user->wallet < $data['amount']) {
            // \Log::warning('Fonds insuffisants pour le retrait.', [
            //     'requested_amount' => $data['amount'],
            //     'current_balance' => $user->wallet
            // ]);

            return response()->json([
                'error' => 'Fonds insuffisants.',
                'details' => 'Vous ne disposez pas de suffisamment de fonds dans votre portefeuille.'
            ], 400);
        }

        // URL du callback
        $callbackUrl = url('/callback');

        // Construction des données à envoyer à l'API
        $payload = [
            'commande' => [
                'amount' => intval($data['amount']),
                'description' => 'Transfert de fonds',
                'customer' => $data['customer'],
                'callback_url' => $callbackUrl,
                'custom_data' => [
                    'transaction_id' => $my_transaction_id
                ]
            ]
        ];

        // Appel du service pour créer un retrait
        try {
            $response = $this->ligdiCashService->createWithdrawal($payload);

            Log::info([
                'response' => $response
            ]);

            // Si la réponse de l'API contient des informations d'erreur
            if (isset($response['error']) && $response['error']) {
                \Log::error('Erreur API lors du retrait.', [
                    'response_code' => $response['response_code'] ?? 'N/A',
                    'response_text' => $response['response_text'] ?? 'Une erreur s\'est produite lors du traitement de la demande'
                ]);

                return response()->json([
                    'error' => 'Échec de la demande de retrait.',
                    'code' => $response['response_code'] ?? 'N/A',
                    'details' => $response['response_text'] ?? 'Une erreur s\'est produite lors du traitement de la demande.'
                ], 400);
            }

            if ($response['response_code'] != '00') {
                return response()->json([
                    'error' => 'Une erreur s\'est produite lors du traitement de la demande',
                    'details' => 'Vous ne disposez pas de suffisamment de fonds dans votre portefeuille.'
                ], 400);
            }

            // Mettre à jour le portefeuille de l'utilisateur

            if ($response['token'] != '') {

                $user->wallet -= $data['amount'];
                $user->save();

                $wallet_transaction = new WalletTransaction();
                $wallet_transaction->code = $my_transaction_id;
                $wallet_transaction->user_id = auth()->user()->id;
                $wallet_transaction->amount = $data['amount'];
                $wallet_transaction->type = 'debit';
                $wallet_transaction->payment_method = "LigdiCash";
                $wallet_transaction->token = $response['token'];

                $user = User::where('id', auth()->user()->id)->first();
                $wallet_transaction->balance = $user->wallet;
                $wallet_transaction->save();
            }

            // Si tout est correct
            return response()->json([
                'success' => true,
                'message' => 'Retrait effectué avec succès.',
                'response' => $response,
                'payload' => $payload
            ]);
        } catch (\Exception $e) {
            // Gestion des exceptions
            // \Log::error('Erreur lors de la création du retrait.', [
            //     'exception_message' => $e->getMessage()
            // ]);

            return response()->json([
                'error' => 'Erreur lors de la création du retrait.',
                'details' => $e->getMessage()
            ], 500);
        }
    }





    public function checkTransactionStatus(Request $request, $token)
    {
        $response = $this->ligdiCashService->checkTransactionStatus($token);

        return response()->json($response);
    }

    public function handle(Request $request)
    {
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
            $transaction_id = $event->transaction_id;
            $status = $event->status;

            // Trouvez la transaction associée
            $transaction = WalletTransaction::where('transaction_id', $transaction_id)->first(); // Assurez-vous que la transaction est trouvée

            if ($transaction) {
                if ($status === "completed") {
                    // Mettre à jour le statut de la transaction dans la base de données
                    $transaction->status = 'completed';
                    $transaction->save();

                    // Créditer le compte de l'utilisateur
                    $user = $transaction->user; // Assurez-vous que la relation user est définie dans le modèle WalletTransaction

                    // Ajoutez le montant au portefeuille de l'utilisateur
                    $user->wallet += $transaction->amount;
                    $user->save(); // N'oubliez pas de sauvegarder les changements

                    // Mettre à jour le solde dans la transaction
                    $transaction->balance = $user->wallet;
                    $transaction->save();
                } elseif ($status === "failed") {
                    // Mettre à jour le statut de la transaction dans la base de données
                    $transaction->status = 'failed';
                    $transaction->save();
                }

                // Répondez à la demande pour confirmer la réception du callback
                return response()->json(['status' => 'success']);
            } else {
                Log::warning('Transaction not found', ['transaction_id' => $transaction_id]);
                return response()->json(['status' => 'error', 'message' => 'Transaction not found'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Callback processing error: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['status' => 'error', 'message' => 'Internal Server Error'], 500);
        }
    }
}
