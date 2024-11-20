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
            'company.name' => 'required|string|max:255',
            'company.email' => 'required|email|unique:companies,email',
            'company.phone' => 'required|regex:/^(\+254|0)[17]\d{8}$/',
            'company.address' => 'required|string|max:255',

            'user.first_name' => 'required|string|max:50',
            'user.last_name' => 'required|string|max:50',
            'user.role' => 'required|string',
            'user.email' => 'required|email|unique:users,email',
            'user.phone' => 'required|regex:/^(\+254|0)[17]\d{8}$/|unique:users,phone',
            'user.password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'company.companyname.required' => 'The company name is required.',
            'company.companyemail.required' => 'The company email is required.',
            'company.companyemail.email' => 'The company email must be a valid email address.',
            'company.companyemail.unique' => 'The company email is already in use.',
            'company.companyphone.required' => 'The company phone number is required.',
            'company.companyphone.regex' => 'The company phone number is not valid.',
            'company.address.required' => 'The company address is required.',
            'user.first_name.required' => 'First name is required.',
            'user.last_name.required' => 'Last name is required.',
            'user.role.required' => 'User role is required.',
            'user.email.required' => 'Email is required.',
            'user.email.email' => 'The email must be a valid address.',
            'user.email.unique' => 'This email is already registered.',
            'user.phone.required' => 'Phone number is required.',
            'user.phone.regex' => 'The phone number is not valid.',
            'user.phone.unique' => 'This phone number is already in use.',
            'user.password.required' => 'Password is required.',
            'user.password.min' => 'Password must be at least 8 characters long.',
            'user.password.confirmed' => 'Passwords do not match.',
        ];
    }
}
