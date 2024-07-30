<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'description' => 'required|string|max:65535',
            'category_id' => 'required|integer',
            'deadline' => 'required|string',
            'budget_type' => 'required|string',
            'budget' => 'nullable|integer|min:0|max:100000000',
            'min_budget' => 'nullable|integer|min:0|max:100000000',
            'max_budget' => 'nullable|integer|min:0|max:100000000',
            'project_duration_id' => 'required|integer',
            'freelancer_type_id' => 'required|integer',
            'freelancer_level_id' => 'required|integer',
            'cover_image' => 'nullable|mimes:jpeg,jpg,png|max:2048',
            // 'budget' => 'required|integer|min:0|max:100000000',
            //array
            'tags' => 'array',
            //project_file
            'project_files.*' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png,svg,gif,mp4,mkv,webm,webp,xls,xlsx,csv,txt,odt,zip,rar|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le titre est obligatoire',
            'name.string' => 'Le titre doit être une chaîne',
            'name.max' => 'Le titre doit être inférieur à 255 caractères',

            'description.required' => 'La description est obligatoire',
            'description.string' => 'La description doit être une chaîne',
            'description.max' => 'La description doit être inférieur à 65535 caractères',

            'deadline.required' => 'La deadline est obligatoire',
            'deadline.date' => 'La deadline doit être une date',

            'cover_image.required' => 'La image est obligatoire',

            'budget_type.required' => 'Le type de budget est obligatoire',
            'budget_type.string' => 'Le type de budget doit être une chaîne',

            'budget.required' => 'Le budget est obligatoire',
            'budget.integer' => 'Le budget doit être un entier',
            'budget.min' => 'Le budget doit être inférieur à 0',
            'budget.max' => 'Le budget doit être inférieur à 100000000',

            'max_budget.min' => 'Le budget maximum doit être inférieur à 0',
            'max_budget.max' => 'Le budget maximum doit être inférieur à 100000000',


            'category_id.required' => 'La catégorie est obligatoire',
            'category_id.integer' => 'La catégorie doit être un entier',


            'project_duration_id.required' => 'La durée est obligatoire',
            'project_duration_id.integer' => 'La durée doit être un entier',

            'freelancer_type_id.required' => 'Le type de freelance est obligatoire',
            'freelancer_type_id.integer' => 'Le type de freelance doit être un entier',

            'freelancer_level_id.required' => 'Le niveau de freelance est obligatoire',
            'freelancer_level_id.integer' => 'Le niveau de freelance doit être un entier',

            'tags.array' => 'Les tags doivent être un tableau',
        ];
    }
}
