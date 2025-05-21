<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'first_name' => ['required','max:50'],
            'middle_name' => ['nullable','max:50'],
            'last_name' => ['required','max:50'],
            'gender' => ['required','max:50'],
            'title' => ['nullable','max:20'],
            'email' => ['required','max:50','unique:users,email'],
            'phone' => ['nullable','max:50','unique:users,phone','regex:/^(?:\+254|254|0)(7|1)[0-9]{8}$/'],
            'address' => ['nullable','max:50'],
            'county_id' => ['nullable','max:50'],
            'image' => ['nullable','file','mimes:jpg,jpeg,png,avif','max:2048'],
            'college_id' => ['nullable','max:50'],
            'course_id' => ['nullable','max:50'],
            'year_of_study' => ['nullable','max:50'],
            'reg_number' => ['nullable','max:50'],
            'kin_name' => ['nullable','max:50'],
            'kin_phone' => ['nullable','max:50','regex:/^(?:\+254|254|0)(7|1)[0-9]{8}$/'],
            'kin_email' => ['nullable','max:50'],
            'kin_relationship' => ['nullable','max:50'],
        ];
    }
}
