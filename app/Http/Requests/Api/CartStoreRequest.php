<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CartStoreRequest extends FormRequest
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
            'payment_type_id' => 'required',
            'cart_date' => 'required',
            'amount' => 'required',
            'items' => 'required|array',
            'items.*.item_type_id' => 'required',
            'items.*.item_id' => 'required',
            'items.*.purchase_date' => 'required',
            'items.*.payment' => 'required',

            // Class
//            'items.*.class_id' => 'required_if:items.*.purchase_type_id,==,1',
//            'items.*.class_date' => 'required_if:items.*.purchase_type_id,==,1',
            // Subscription
//            'items.*.subscription_id' => 'required_if:items.*.purchase_type_id,==,2',
//            'items.*.start_date' => 'required_if:items.*.purchase_type_id,==,2',
//            'items.*.end_date' => 'required_if:items.*.purchase_type_id,==,2',
        ];
    }
}
