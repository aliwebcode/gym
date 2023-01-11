<?php

namespace App\Http\Controllers;

use App\Models\AllowedClass;
use App\Models\Branch;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CustomerClass;
use App\Models\CustomerSubscription;
use App\Models\GymClass;
use App\Models\PurchaseType;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $role = $user->role->name;

        if($role == 'Coach') {
            $classes = GymClass::active()->where('coach_id', $user->id)
                ->when(\request()->date != '', function ($query) {
                    $query->where('start_date', '<=', \request()->date)
                        ->where('end_date', '>', \request()->date);
                })
                ->when(\request()->training_id != '', function ($query) {
                    $query->where('training_id', \request()->training_id);
                })
                ->latest()->get();
        } else {
            $classes = GymClass::with('coach')->active()
                ->when(\request()->date != '', function ($query) {
                    $query->where('start_date', '<=', \request()->date)
                        ->where('end_date', '>', \request()->date);
                })
                ->when(\request()->training_id != '', function ($query) {
                    $query->where('training_id', \request()->training_id);
                })
                ->when(\request()->branch_id != '', function ($query) {
                    $query->whereRelation('training', 'branch_id', \request()->branch_id);
                })
                ->latest()
                ->get();
        }

        if(\request()->date)
        {
            $user_subscription_id = auth()->user()->subscription->subscription->id;

            foreach ($classes as $class)
            {
                $allowed = AllowedClass::where('class_id', $class->id)->pluck('subscrib_id')->toArray();
                if(in_array($user_subscription_id, $allowed))
                    $class->price = 0;

                $class->subscribers = CustomerClass::where('class_id', $class->id)
                    ->where('class_date',\request()->date)
                    ->count();
            }
        }

        return response($classes, 200);
    }

    public function change_class_date(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'class_date' => 'required'
        ]);


        $class_capacity = GymClass::findOrFail($request->class_id)->capacity;
        $current_orders = CustomerClass::where('class_id', $request->class_id)
            ->where('class_date', $request->class_date)
            ->count();

        if($current_orders == $class_capacity)
        {
            return response([
                'message' => 'Full Capacity in date ' . $request->class_date
            ], 401);
        }


        $customer_class = CustomerClass::where('user_id', auth()->id())
            ->where('class_id', $request->class_id)->first();

        $customer_class->update([
            'cart_date' => $request->class_date
        ]);

        CartItem::findOrFail($customer_class->cart_item_id)->update([
            'purchase_date' => $request->class_date
        ]);

        return response([
            'message' => 'Success'
        ], 200);
    }

}
