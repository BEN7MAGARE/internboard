<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCollegeRequest extends FormRequest
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
            'id' => ['required', 'exists:colleges,id'],
            'name' => ['required', 'string', 'max:60', 'unique:colleges,name,' . $this->id],
            'email' => ['required', 'string', 'email', 'max:80', 'unique:colleges,email,' . $this->id],
            'phone' => ['required', 'string', 'max:60', 'unique:colleges,phone,' . $this->id],
            'address' => ['required', 'string', 'max:255'], 
            'logo' => ['nullable', 'image', 'max:2048'],
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
