<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:40|min:2',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:8|max:50|confirmed',
            'username' => [
                'required',
                'string',
                'max:20',
                'min:3',
                'unique:users',
                'regex:/^[A-Za-z0-9_.]+$/'
            ],
        ];
    }
}
