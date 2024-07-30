<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectDurationRequest extends FormRequest
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
            'name' => 'required|unique:project_durations,name|max:255',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Project duration name is required',
            'name.unique' => 'Project duration name already exists',
            'name.max' => 'Project duration name must not exceed 255 characters',
        ];
    }
}
