<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEtapeCleRequest extends FormRequest
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
            'price' => 'required|numeric|min:0|gt:0',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'etape_project_id' => 'required|exists:projects,id',
            // 'etape_cle_id' => 'required|exists:etape_cles,id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le champ :attribute est requis',
            'name.string' => 'Le champ :attribute doit être une chaîne de caractères',
            'name.max' => 'Le champ :attribute ne doit pas dépasser 255 caractères',
            'price.required' => 'Le champ :attribute est requis',
            'price.numeric' => 'Le champ :attribute doit être un nombre',
            'price.min' => 'Le champ :attribute doit être supérieur ou égal à 0',
            'price.gt' => 'Le champ :attribute doit être supérieur à 0',
            'description.required' => 'Le champ :attribute est requis',
            'description.string' => 'Le champ :attribute doit être une chaîne de caractères',
            'start_date.required' => 'Le champ :attribute est requis',
            'start_date.date' => 'Le champ :attribute doit être une date valide',
            // 'etape_cle_id.required' => 'Le champ :attribute est requis',
            // 'etape_cle_id.exists' => 'Le champ :attribute doit être un projet existant',
        ];
    }
}
