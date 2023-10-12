<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'category_id' => ['required', 'exists:categories,id'],
            'type' => ['required', 'max:80'],
            'job_type' => ['required', 'max:100'],
            'experience_level' => ['required', 'max:100'],
            'location' => ['required', 'max:255'],
            'education_level' => ['required','string'],
            'skills' => ['required','json'],
            'salary_range' => ['required','string'],
            'title' => ['required','string'],
            'description' => ['required','string'],
            'start_date' => ['required','string'],
            'no_of_positions' => ['required', 'numeric']
        ];
    }
}
