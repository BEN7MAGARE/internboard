<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'id'=>['nullable','exists:jobs,id'],
            'corporate_id' => ['nullable', 'exists:corporates,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'type' => ['required', 'max:80'],
            'job_type' => ['required', 'max:100'],
            'experience_level' => ['required', 'max:100'],
            'location' => ['required', 'max:255'],
            'education_level' => ['required', 'string'],
            'skills' => ['json'],
            'salary_range' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'application_end_date' => ['nullable', 'string', 'date_format:Y-m-d'],
            'start_date' => ['required', 'string', 'date_format:Y-m-d'],
            'no_of_positions' => ['required', 'numeric', 'min:1'],
            'requirements' => ['required', 'json'],
            'qualifications' => ['required', 'json']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }

}
