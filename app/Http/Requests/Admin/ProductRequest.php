<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                    'name_en' => 'required|max:255',
                    'name_ar' => 'required|max:255',
                    'description_en' => 'required',
                    'description_ar' => 'required',
                    'status' => 'required',
                    'image' => 'required|mimes:jpg,jpeg,png,gif|max:3000',
                    'cost' => 'required|numeric',
                    'price' => 'required|numeric',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name_en' => 'required|max:255',
                    'name_ar' => 'required|max:255',
                    'description_en' => 'required',
                    'description_ar' => 'required',
                    'status' => 'required',
                    'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:3000',
                    'cost' => 'required|numeric',
                    'price' => 'required|numeric'
                ];
            }
            default: break;
        }
    }
}
