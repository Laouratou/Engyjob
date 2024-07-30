<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPaymentRequest extends FormRequest
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
            'etape_cle_payment_id' => 'required|exists:etape_cles,id',
            'user_payment_project_id' => 'required|exists:projects,id',
        ];
    }

    public function messages(): array
    {
        return [
            'etape_cle_payment_id.required' => 'Veuillez selectionner une_etape_cle',
            'user_payment_project_id.required' => 'Veuillez selectionner un projet',
        ];
    }
}
