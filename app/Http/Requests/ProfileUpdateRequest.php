<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['string', 'nullable', ''],
            'last_name' => ['string', 'nullable', ''],
            'address' => ['string', 'nullable'],
            'phone' => ['string', 'nullable', 'max:16', 'unique:users,phone,' . auth()->id()],
            'email' => ['string', 'required', 'unique:users,email,' . auth()->id()],
            'twitter' => ['string', 'nullable', 'max:255'],
            'facebook' => ['string', 'nullable', 'max:255'],
            'instagram' => ['string', 'nullable', 'max:255'],
            'linkedin' => ['string', 'nullable', 'max:255'],
        ];
    }
}
