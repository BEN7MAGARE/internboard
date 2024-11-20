<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollegeRequest extends FormRequest
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
            'company.name' => 'required|string|min:2|max:255',
            'company.email' => 'required|email|unique:companies,email',
            'company.phone' => 'required|regex:/^(\+254|0)[17]\d{8}$/',
            'company.address' => 'required|string|min:2',

            'user.first_name' => 'required|string|min:2|max:50',
            'user.last_name' => 'required|string|min:2|max:50',
            'user.role' => 'required|string',
            'user.email' => 'required|email|unique:users,email',
            'user.phone' => 'required|regex:/^(\+254|0)[17]\d{8}$/|unique:users,phone',
            'user.password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'company.name.required' => 'The company name is required.',
            'company.email.required' => 'The company email is required.',
            'company.email.unique' => 'This company email is already taken.',
            'company.phone.regex' => 'Please enter a valid company phone number.',
            'user.first_name.required' => 'First name is required.',
            'user.last_name.required' => 'Last name is required.',
            'user.email.required' => 'The user email is required.',
            'user.email.unique' => 'This user email is already registered.',
            'user.phone.regex' => 'Please enter a valid user phone number.',
            'user.password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
