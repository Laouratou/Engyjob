<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWalletTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|gt:0',
            'payment_method_wallet' => 'required|string',

        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'Le montant est requis',
            'amount.numeric' => 'Le montant doit être un nombre',
            'amount.gt' => 'Le montant doit être supérieur à 0',
            'payment_method_wallet.required' => 'Le mode de paiement est requis',
            'payment_method_wallet.max' => 'Le mode de paiement ne doit pas dépasser 255 caractères',
        ];
    }
}
