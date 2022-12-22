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
            $classes = GymClass::with('branch', 'coach')->active()
                ->when(\request()->date != '', function ($query) {
                    $query->where('start_date', '<=', \request()->date)
                        ->where('end_date', '>', \request()->date);
                })
                ->when(\request()->training_id != '', function ($query) {
                    $query->where('training_id', \request()->training_id);
                })
                ->latest()
                ->get();
        }

        if(\request()->date)
        {
            foreach ($classes as $class)
            {
                $class->subscribers = CustomerClass::where('class_id', $class->id)
                    ->where('class_date',\request()->date)
                    ->count();
            }
        }

        return response($classes, 200);
    }
}
