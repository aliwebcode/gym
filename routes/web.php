<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\ClassesController;
use App\Http\Controllers\Admin\SubscriptionCategoryController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\ProductController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


/* ================= ADMIN LOGIN ================= */
Route::group(['prefix' => 'admin', 'middleware' => 'guest', 'as' => 'admin.'], function () {
    Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

/* ================= Admin Dashboard ================= */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {

    /* ================= Dashboard ================= */
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    /* ================= Trainings ================= */
    Route::resource('trainings', TrainingController::class);

    /* ================= Classes ================= */
    Route::resource('classes', ClassesController::class);

    /* ================= Subscription Categories ================= */
    Route::resource('subscription_categories', SubscriptionCategoryController::class);

    /* ================= Subscriptions ================= */
    Route::resource('subscriptions', SubscriptionController::class);

    /* ================= Products ================= */
    Route::resource('products', ProductController::class);

    /* ================= Admin Profile ================= */
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
