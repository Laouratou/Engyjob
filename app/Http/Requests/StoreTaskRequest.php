<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'description' => 'required|string',
            'end_date' => 'nullable|date',
            'task_project_id' => 'required|exists:projects,id',
            'etape_cle_id' => 'required|exists:etape_cles,id',
            'status' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est requis',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'name.string' => 'Le nom doit être une chaîne de caractères',
            'description.required' => 'La description est requise',
            'description.string' => 'La description doit être une chaîne de caractères',
            'end_date.required' => 'La date de fin est requise',
            'task_project_id.required' => 'Le projet est requis',
            'status.required' => 'Le statut est requis',
            'status.max' => 'Le statut ne doit pas dépasser 255 caractères',
            'status.string' => 'Le statut doit être une chaîne de caractères',
            'etapes_cle_id.required' => 'L\'étape clé est requise',
            'etapes_cle_id.exists' => 'L\'étape clé n\'existe pas',
        ];
    }
}
