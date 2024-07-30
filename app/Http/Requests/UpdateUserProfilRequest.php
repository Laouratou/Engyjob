<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfilRequest extends FormRequest
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
            'email' => 'required|string|email|max:255',
            'first_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',

            'photo' => 'nullable|image|max:2048',
            'date_naissance' => 'nullable|date|before:today',
            'fonction' => 'nullable|string|max:255',
            'domaine_activite' => 'nullable|string|max:255',
            'apercu' => 'nullable|string',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'behance' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:255',
            'pays' => 'nullable|string|max:255',
            'freelancersType_id' => 'nullable|exists:App\Models\FreelancerType,id',
            'category_id' => 'nullable|exists:App\Models\Category,id',

            'educations.*.name' => 'required|string|max:255',
            'educations.*.university' => 'required|string|max:255',
            'educations.*.year_of_start' => 'required|integer|min:1900',
            'educations.*.year_of_end' => 'required|integer|min:1900',

            'experiences.*.company_name' => 'required|string|max:255',
            'experiences.*.position' => 'required|string|max:255',
            'experiences.*.start_date' => 'required|date',
            'experiences.*.end_date' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est requis',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'email.required' => 'L\'email est requis',
            'email.max' => 'L\'email ne doit pas dépasser 255 caractères',
            'email.email' => 'L\'email doit être une adresse email valide',
            'first_name.max' => 'Le prénom ne doit pas dépasser 255 caractères',
            'first_name.string' => 'Le prénom doit être une chaine de caractères',
            'first_name.required' => 'Le prénom est requis',
            'phone.max' => 'Le numéro de téléphone ne doit pas dépasser 255 caractères',
            'phone.string' => 'Le numéro de téléphone doit être une chaine de caractères',


            'photo.image' => 'Le fichier doit être une image',
            'photo.max' => 'La taille de l\'image ne doit pas dépasser 2Mo',
            'photo.mimes' => 'Le fichier doit être une image JPG, PNG, JPEG, SVG',
            'date_naissance.before' => 'La date de naissance ne doit pas être dans le futur',
            'date_naissance.date' => 'La date de naissance doit être une date valide',
            'domaine_activite.max' => 'Le domaine d\'activité ne doit pas dépasser 255 caractères',
            'ville.max' => 'La ville ne doit pas dépasser 255 caractères',
            'province.max' => 'La province ne doit pas dépasser 255 caractères',
            'code_postal.max' => 'Le code postal ne doit pas dépasser 255 caractères',
            'pays.max' => 'Le pays ne doit pas dépasser 255 caractères',
            'domaine_activite.max' => 'Le domaine d\'activité ne doit pas dépasser 255 caractères',
            'website.max' => 'Le site web ne doit pas dépasser 255 caractères',
            'fonction.max' => 'La fonction ne doit pas dépasser 255 caractères',
            'pays.max' => 'Le pays ne doit pas dépasser 255 caractères',

            'educations.*.name.required' => 'Le nom du diplôme est requis',
            'educations.*.name.max' => 'Le nom du diplôme ne doit pas dépasser 255 caractères',
            'educations.*.university.required' => 'Le nom de l\'école est requis',
            'educations.*.university.max' => 'Le nom de l\'école ne doit pas dépasser 255 caractères',
            'educations.*.year_of_start.required' => 'L\'année de début est requise',
            'educations.*.year_of_start.integer' => 'L\'année de début doit être un entier',
            'educations.*.year_of_start.min' => 'L\'année de début doit être supérieure ou égale à 1900',
            'educations.*.year_of_end.required' => 'L\'année de fin est requise',
            'educations.*.year_of_end.integer' => 'L\'année de fin doit être un entier',
            'educations.*.year_of_end.min' => 'L\'année de fin doit être supérieure ou égale à 1900',

            'experiences.*.company_name.required' => 'Le nom de l\'entreprise est requis',
            'experiences.*.company_name.max' => 'Le nom de l\'entreprise ne doit pas dépasser 255 caractères',
            'experiences.*.position.required' => 'La fonction est requise',
            'experiences.*.position.max' => 'La fonction ne doit pas dépasser 255 caractères',
            'experiences.*.start_date.required' => 'La date de début est requise',
            'experiences.*.start_date.date' => 'La date de début doit être une date valide',
            'experiences.*.end_date.date' => 'La date de fin doit être une date valide',

        ];
    }
}