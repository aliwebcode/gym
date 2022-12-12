<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\CustomerClass;
use App\Models\CustomerSubscription;
use App\Models\Product;
use App\Models\ViewUserClass;
use App\Models\ViewUserProduct;
use App\Models\ViewUserSubscription;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {

        if(\request()->type && \request()->type == 'class')
        {
            return response([
                ViewUserClass::select("*")->get()
            ], 200);
        }
        if(\request()->type && \request()->type == 'subscription')
        {
            return response([
                ViewUserSubscription::select("*")->get()
            ], 200);
        }
        if(\request()->type && \request()->type == 'product')
        {
            return response([
                ViewUserProduct::select("*")->get()
            ], 200);
        }
    }
}
