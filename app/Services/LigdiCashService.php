<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class LigdiCashService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://app.ligdicash.com/', // URL de base
            'headers'  => [
                'Apikey' => '5MC40YU6SF182UYJP',
                'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF9hcHAiOiIxODQ1MSIsImlkX2Fib25uZSI6NDMzODk1LCJkYXRlY3JlYXRpb25fYXBwIjoiMjAyNC0wNy0yMyAxMToxMDoyMCJ9.1md2Ub72hqkupsWVAWDG5W-ioh6Kdt56E7zgr88AjWU',
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function createInvoice(array $data)
    {
        try {
            $response = $this->client->post('pay/v01/redirect/checkout-invoice/create', [
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            // Capture les erreurs
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'response' => $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
            ];
        }
    }

    public function createWithdrawal(array $data)
    {
        try {
            $response = $this->client->post('pay/v01/straight/payout', [
                'json' => $data
            ]);
    
            // Lire la réponse brute
            $body = $response->getBody()->getContents();
    
            // Afficher le contenu brut pour débogage
            \Log::info('Response Body: ' . $body);
    
            // Assurez-vous que la réponse est bien au format JSON
            $decoded = json_decode($body, true);
    
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('La réponse de l\'API n\'est pas un JSON valide.');
            }
    
            return $decoded;
        } catch (RequestException $e) {
            Log::error('LigdiCash createWithdrawal error: ' . $e->getMessage());
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'response' => $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
            ];
        } catch (\Exception $e) {
            Log::error('LigdiCash createWithdrawal error: ' . $e->getMessage());
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
    

    public function checkTransactionStatus($token)
    {
        try {
            $response = $this->client->get("pay/v01/straight/payout/confirm/?payoutToken={$token}", [
                'headers' => [
                    'Apikey' => '5MC40YU6SF182UYJP',
                    'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF9hcHAiOiIxODQ1MSIsImlkX2Fib25uZSI6NDMzODk1LCJkYXRlY3JlYXRpb25fYXBwIjoiMjAyNC0wNy0yMyAxMToxMDoyMCJ9.1md2Ub72hqkupsWVAWDG5W-ioh6Kdt56E7zgr88AjWU',
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            Log::error('LigdiCash checkTransactionStatus error: ' . $e->getMessage());
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'response' => $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
            ];
        }
    }
}
