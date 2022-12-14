<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BranchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgot_password']);

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
    // Get Branches
    Route::get('/branches', [BranchController::class, 'index']);

    // Save Cart Items
    Route::post('/cart/store', [CartController::class, 'store']);

    // Get User Orders
    Route::get('/orders', [OrderController::class, 'index']);

    // Check OTP
    Route::post('/check-otp', [AuthController::class, 'check_otp']);

    // Refresh Token
    Route::get('/refresh-token', [AuthController::class, 'refresh_token']);

    // Change Class Date
    Route::post('/change-class-date', [ClassController::class, 'change_class_date']);

    /* ================= Profile ================= */
    Route::post('update', [AuthController::class, 'update']);

});
