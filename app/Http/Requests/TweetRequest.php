<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TweetRequest extends FormRequest
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
            'content' => 'nullable|string|max:280|required_without:images',
            'images' => 'nullable|array|max:4|required_without:content',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|in:draft,published'
        ];
    }
}
