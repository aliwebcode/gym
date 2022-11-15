<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\CartStoreRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CustomerClass;
use App\Models\CustomerSubscription;
use App\Models\PaymentType;
use App\Models\PurchaseType;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function get_payment_types()
    {
        $payment_types = PaymentType::get(['id', 'name_en']);
        return response($payment_types, 200);
    }

    public function get_purchase_types()
    {
        $purchase_types = PurchaseType::get(['id', 'name_en']);
        return response($purchase_types, 200);
    }

    public function store(CartStoreRequest $request)
    {

        $cart = Cart::create([
            'user_id' => auth()->id(),
            'payment_type_id' => $request->payment_type_id,
            'cart_date' => $request->cart_date,
            'amount' => $request->amount
        ]);

        $purchase_types = [
            'class' => PurchaseType::where('name_en', 'Class')->first()->id,
            'subscription' => PurchaseType::where('name_en', 'Subscription')->first()->id,
            'product' => PurchaseType::where('name_en', 'Product')->first()->id
        ];

        foreach ($request->items as $item) {

            $cart_item = CartItem::create([
                'cart_id' => $cart->id,
                'purchase_id' => $item['purchase_id'],
                'purchase_type_id' => $item['purchase_type_id'],
                'purchase_date' => $item['purchase_date'],
                'payment' => $item['payment']
            ]);

            if($item['purchase_type_id'] == $purchase_types['class']) {
                CustomerClass::create([
                    'user_id' => auth()->id(),
                    'class_id' => $item['purchase_id'],
                    'cart_item_id' => $cart_item->id,
                    'class_date' => $item['purchase_date'],
                    'has_subscription' => 0
                ]);
            } else if($item['purchase_type_id'] == $purchase_types['subscription']) {
                CustomerSubscription::create([
                    'user_id' => auth()->id(),
                    'subscrib_id' => $item['subscription_id'],
                    'start_date' => $item['start_date'],
                    'end_date' => $item['end_date'],
                    'status_id' => 1
                ]);
            }

        }

        return response([
            'message' => 'Cart Created'
        ], 200);
    }
}
