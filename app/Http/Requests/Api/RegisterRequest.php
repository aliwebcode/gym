<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|min:8|max:255|confirmed',
            'birthday' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:4000',
        ];
    }
    public function messages()
    {
        return [
            'full_name' => 'Full Name',
        ];
    }
}
