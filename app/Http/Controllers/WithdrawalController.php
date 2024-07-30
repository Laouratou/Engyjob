<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WithdrawalController extends Controller
{
    public function create(Request $request)
    {
        // Définir les informations API directement dans la méthode
        $apiUrl = 'https://app.ligdicash.com/pay/v01/withdrawal/create';
        $apiKey = '5MC40YU6SF182UYJP'; 
        $apiToken = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF9hcHAiOiIxODQ1MSIsImlkX2Fib25uZSI6NDMzODk1LCJkYXRlY3JlYXRpb25fYXBwIjoiMjAyNC0wNy0yMyAxMToxMDoyMCJ9.1md2Ub72hqkupsWVAWDG5W-ioh6Kdt56E7zgr88AjWU';  
   
        // Valider les données entrantes
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'customer' => 'required|numeric',
            'top_up_wallet' => 'required|boolean',
            'transaction_id' => 'required|string',
        ]);

        // Créer un client Guzzle
        $client = new Client();

        try {
            // Envoyer la requête à l'API LigdiCash
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Apikey' => $apiKey,
                    'Authorization' => $apiToken,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'commande' => [
                        'amount' => $validated['amount'],
                        'description' => $validated['description'],
                        'customer' => $validated['customer'],
                        'top_up_wallet' => $validated['top_up_wallet'],
                        'custom_data' => [
                            'transaction_id' => $validated['transaction_id'],
                        ],
                    ],
                ],
            ]);

            // Décoder la réponse JSON
            $responseData = json_decode($response->getBody(), true);

            // Retourner la réponse
            return response()->json($responseData);
        } catch (\Exception $e) {
            // Gérer les erreurs
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function checkStatus($invoiceToken)
    {
        $statusUrl = 'https://app.ligdicash.com/pay/v01/redirect/checkout-invoice/confirm/?invoiceToken=' . $invoiceToken;

        // Définir les informations API directement dans la méthode
        $apiKey = '5MC40YU6SF182UYJP'; 
        $apiToken = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF9hcHAiOiIxODQ1MSIsImlkX2Fib25uZSI6NDMzODk1LCJkYXRlY3JlYXRpb25fYXBwIjoiMjAyNC0wNy0yMyAxMToxMDoyMCJ9.1md2Ub72hqkupsWVAWDG5W-ioh6Kdt56E7zgr88AjWU';  

        // Créer un client Guzzle
        $client = new Client();

        try {
            // Envoyer la requête à l'API LigdiCash pour vérifier le statut
            $response = $client->get($statusUrl, [
                'headers' => [
                    'Apikey' => $apiKey,
                    'Authorization' => $apiToken,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            // Décoder la réponse JSON
            $responseData = json_decode($response->getBody(), true);

            // Retourner la réponse
            return response()->json($responseData);
        } catch (\Exception $e) {
            // Gérer les erreurs
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
