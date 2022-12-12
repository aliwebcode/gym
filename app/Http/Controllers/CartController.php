<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\CartStoreRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CustomerClass;
use App\Models\CustomerSubscription;
use App\Models\PaymentType;
use App\Models\PurchaseType;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

        $purchase_types = [
            'class' => PurchaseType::where('name_en', 'Class')->first()->id,
            'subscription' => PurchaseType::where('name_en', 'Subscription')->first()->id,
            'product' => PurchaseType::where('name_en', 'Product')->first()->id
        ];

        $cart = Cart::create([
            'user_id' => auth()->id(),
            'payment_type_id' => $request->payment_type_id,
            'cart_date' => $request->cart_date,
            'amount' => $request->amount
        ]);

        foreach ($request->items as $item) {

            $cart_item = CartItem::create([
                'cart_id' => $cart->id,
                'item_id' => $item['item_id'],
                'item_type_id' => $item['item_type_id'],
                'purchase_date' => $item['purchase_date'],
                'payment' => $item['payment']
            ]);

            if($item['item_type_id'] == $purchase_types['class']) {
                $user_id = auth()->id();
                CustomerClass::create([
                    'user_id' => $user_id,
                    'class_id' => $item['item_id'],
                    'cart_item_id' => $cart_item->id,
                    'class_date' => $item['purchase_date'],
                    'has_subscription' => $request->has_subscription
                ]);
            } else if($item['item_type_id'] == $purchase_types['subscription']) {
                CustomerSubscription::create([
                    'user_id' => auth()->id(),
                    'subscrib_id' => $item['item_id'],
                    'start_date' => $item['purchase_date'],
                    'end_date' => Carbon::now()->addDays(Subscription::find($item['item_id'])->duration),
                    'status_id' => 1
                ]);
            }

        }

        return response([
            'message' => 'Cart Created'
        ], 200);
    }
}
