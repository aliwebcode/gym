<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HolidayRequest extends FormRequest
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
                    'from' => 'required',
                    'to' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'from' => 'required',
                    'to' => 'required',
                ];
            }
            default: break;
        }
    }
}
