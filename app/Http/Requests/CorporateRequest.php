<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CorporateRequest extends FormRequest
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
            'email' => 'required|email|unique:companies,email',
            'phone' => 'required|regex:/^(\+254|0)[17]\d{8}$/',
            'address' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The company name is required.',
            'email.required' => 'The company email is required.',
            'email.email' => 'The company email must be a valid email address.',
            'email.unique' => 'The company email is already in use.',
            'phone.required' => 'The company phone number is required.',
            'phone.regex' => 'The company phone number is not valid.',
            'address.required' => 'The company address is required.',
        ];
    }
}
