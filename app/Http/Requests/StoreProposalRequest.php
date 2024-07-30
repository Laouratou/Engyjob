<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProposalRequest extends FormRequest
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
            'price' => 'required|integer|min:0|max:100000000',
            'number_delivery_days' => 'required|integer|min:0',
            'letter_cover' => 'required|string',
            'project_id' => 'required|integer|exists:projects,id',

        ];
    }

    public function messages()
    {
        return [
            'price.required' => 'Le prix est obligatoire',
            'price.integer' => 'Le prix doit être un entier',
            'price.min' => 'Le prix doit être inférieur à 0',
            'price.max' => 'Le prix doit être inférieur à 100000000',
            'number_delivery_days.required' => 'Le nombre de jours est obligatoire',
            'number_delivery_days.integer' => 'Le nombre de jours doit être un entier',
            'number_delivery_days.min' => 'Le nombre de jours doit être inférieur à 0',
            'letter_cover.required' => 'La lettre de couverture est obligatoire',
            'project_id.required' => 'Le projet est obligatoire',
            'project_id.integer' => 'Le projet doit être un entier',
            'project_id.exists' => 'Le projet n\'existe pas',
        ];
    }
}
