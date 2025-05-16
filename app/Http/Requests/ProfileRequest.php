<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'title' => ['nullable', 'string'],
            'education' => ['nullable', 'string'],
            'work' => ['nullable', 'string'],
            'specialization' => ['nullable', 'string'],
            'summary' => ['nullable', 'string', 'max:1000'],
            'first_name' => ['string', 'nullable', ''],
            'last_name' => ['string', 'nullable', ''],
            'address' => ['string', 'nullable'],
            'phone' => ['string', 'nullable', 'max:16', 'unique:users,phone,' . auth()->id()],
            'email' => ['string', 'required', 'unique:users,email,' . auth()->id()],
            'twitter' => ['string', 'nullable', 'max:255'],
            'facebook' => ['string', 'nullable', 'max:255'],
            'instagram' => ['string', 'nullable', 'max:255'],
            'linkedin' => ['string', 'nullable', 'max:255'],
            'level' => ['string', 'nullable'],
            'years_of_experience' => ['string', 'nullable'],
        ];
    }
}
