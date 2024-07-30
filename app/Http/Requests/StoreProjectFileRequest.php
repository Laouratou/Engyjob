<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectFileRequest extends FormRequest
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
            'name' => 'required|max:255',
            'description' => 'nullable',
            'choosen_file' => 'required|file|max:12048',
        ];
    }

    public function messages()
    {
        return [
            'choosen_file.required' => 'Le fichier est requis.',
            'choosen_file.max' => 'Le fichier ne doit pas dépasser 12Mo.',
            'choosen_file.file' => 'Le fichier doit être un fichier valide.',

            'name.required' => 'Le nom est requis.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
        ];
    }
}
