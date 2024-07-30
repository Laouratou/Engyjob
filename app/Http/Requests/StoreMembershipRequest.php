<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMembershipRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'periodicity' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est requis',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'payment_method.required' => 'Le mode de paiement est requis',
            'payment_method.max' => 'Le mode de paiement ne doit pas dépasser 255 caractères',
            'periodicity.required' => 'La périodicité est requise',
            'periodicity.max' => 'La périodicité ne doit pas dépasser 255 caractères',
        ];
    }
}
