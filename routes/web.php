<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\ClassesController;
use App\Http\Controllers\Admin\SubscriptionCategoryController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\SettingController;


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
    Route::get('/new-customer-class', [ClassesController::class, 'new_customer'])->name('classes.new_customer');
    Route::post('/new-customer-class', [ClassesController::class, 'new_customer_store'])->name('classes.new_customer_store');

    /* ================= Subscription Categories ================= */
    Route::resource('subscription_categories', SubscriptionCategoryController::class);

    /* ================= Subscriptions ================= */
    Route::resource('subscriptions', SubscriptionController::class);

    /* ================= Products ================= */
    Route::resource('products', ProductController::class);

    /* ================= Users ================= */
    Route::resource('users', UserController::class);

    /* ================= Branches ================= */
    Route::resource('branches', BranchController::class);

    /* ================= Settings ================= */
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    /* ================= Admin Profile ================= */
    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('profile/{id}', [AdminController::class, 'update_profile'])->name('profile.update');

    /* ================= Logout ================= */
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
