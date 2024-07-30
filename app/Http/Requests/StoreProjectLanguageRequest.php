<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectLanguageRequest extends FormRequest
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
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Le nom est requis',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'image.image' => 'Le fichier doit être une image',
            'image.mimes' => 'Le fichier doit être une image JPG, PNG, JPEG, SVG',
            'image.max' => 'Le fichier ne doit pas dépasser 2Mo',
        ];
    }
}
