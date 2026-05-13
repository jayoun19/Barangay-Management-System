<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'birthdate' => ['nullable', 'date'], // Idinagdag ito para makuha ang data
            'gender' => ['required', 'string'],
            'civil_status' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'purok' => ['nullable', 'string', 'max:100'],
        ];
    }
}