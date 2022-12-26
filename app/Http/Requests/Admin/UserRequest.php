<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'role_id' => 'required',
                    'full_name' => 'required|string|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'phone' => 'required|numeric|unique:users',
                    'password' => 'required|min:8|max:255',
                    'birthday' => 'nullable',
                    'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:4000'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'role_id' => 'required',
                    'full_name' => 'required|string|max:255',
                    'email' => 'required|email|max:255|unique:users,email,' . $this->route()->user,
                    'phone' => 'required|numeric|unique:users,phone,' . $this->route()->user,
                    'birthday' => 'nullable',
                    'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:4000'
                ];
            }
            default: break;
        }
    }
}
