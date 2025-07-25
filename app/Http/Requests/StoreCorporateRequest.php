<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCorporateRequest extends FormRequest
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
            'id' => ['nullable', 'exists:corporates,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:60', 'unique:corporates,name,' . $this->id],
            'email' => ['required', 'string', 'email', 'max:80', 'unique:corporates,email,' . $this->id],
            'phone' => ['required', 'string', 'max:20', 'unique:corporates,phone,' . $this->id],
            'alt_phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'size' => ['nullable', 'string', 'max:60'],
            'mission_vision' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'website' => ['required', 'string', 'max:255'],
            'nature_of_business' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
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
