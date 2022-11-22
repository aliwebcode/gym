<?php

namespace App\Http\Controllers;

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
        $classes = GymClass::active()
            ->when(\request()->date != '', function ($query) {
                $query->where('start_date', '<=', \request()->date)
                    ->where('end_date', '>', \request()->date);
            })
            ->when(\request()->training_id != '', function ($query) {
                $query->where('training_id', \request()->training_id);
            })
            ->latest()
            ->get();
        return response($classes, 200);
    }
}
