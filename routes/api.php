<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Get Payment Types
Route::get('/get-payment-types', [CartController::class, 'get_payment_types']);
// Get Purchase Types
Route::get('/get-purchase-types', [CartController::class, 'get_purchase_types']);


Route::group(['middleware' => 'auth:sanctum'], function () {

    // Get Classes
    Route::get('/classes', [ClassController::class, 'index']);
    // Get Subscriptions
    Route::get('/subscriptions', [SubscriptionController::class, 'index']);
    // Get Products
    Route::get('/products', [ProductController::class, 'index']);
    // Get Trainings
    Route::get('/trainings', [TrainingController::class, 'index']);


    // Save Cart Items
    Route::post('/cart/store', [CartController::class, 'store']);


    // Get User Orders
    Route::get('/orders', [OrderController::class, 'index']);

});
