<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShaftController;
use App\Http\Controllers\GripTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GripImageController;
use App\Http\Controllers\GripModelController;
use App\Http\Controllers\ShaftTypeController;
use App\Http\Controllers\ShaftImageController;
use App\Http\Controllers\GripPurchaseController;
use App\Http\Controllers\GripSaleController;
use App\Http\Controllers\ShaftPurchaseController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['guest:user,admin'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'grips', 'as' => 'grip.'], function () {
        Route::get('/types', [GripTypeController::class, 'index'])->name('type');
        Route::post('/types', [GripTypeController::class, 'store'])->name('type.store');
        Route::patch('/types/{type}', [GripTypeController::class, 'update'])->name('type.update');
        Route::delete('/types/{type}', [GripTypeController::class, 'destroy'])->name('type.destroy')->can('delete', 'type');

        Route::get('/models', [GripModelController::class, 'index'])->name('model');
        Route::post('/models', [GripModelController::class, 'store'])->name('model.store');
        Route::patch('/models/{model}', [GripModelController::class, 'update'])->name('model.update');
        Route::delete('/models/{model}', [GripModelController::class, 'destroy'])->name('model.destroy')->can('delete', 'model');

        Route::get('/items', [GripController::class, 'index'])->name('items');
        Route::post('/items', [GripController::class, 'store'])->name('items.store');
        Route::get('/items/{grip:code}', [GripController::class, 'show'])->name('items.show');
        Route::get('/items/{grip:code}/edit', [GripController::class, 'edit'])->name('items.edit');
        Route::patch('/items/{grip}', [GripController::class, 'update'])->name('items.update');
        Route::delete('/items/{grip}', [GripController::class, 'destroy'])->name('items.destroy')->can('delete', 'grip');
        Route::post('/items/{grip:code}/image', [GripImageController::class, 'store'])->name('items.image.store');
        Route::delete('/items/image/{image}', [GripImageController::class, 'destroy'])->name('items.image.destroy');

        Route::get('/barcode', [GripController::class, 'barcode'])->name('barcode');
    });

    Route::group(['prefix' => 'shafts', 'as' => 'shaft.'], function () {
        Route::get('/types', [ShaftTypeController::class, 'index'])->name('type');
        Route::post('/types', [ShaftTypeController::class, 'store'])->name('type.store');
        Route::patch('/types/{type}', [ShaftTypeController::class, 'update'])->name('type.update');
        Route::delete('/types/{type}', [ShaftTypeController::class, 'destroy'])->name('type.destroy')->can('delete', 'type');

        Route::get('/items', [ShaftController::class, 'index'])->name('items');
        Route::post('/items', [ShaftController::class, 'store'])->name('items.store');
        Route::get('/items/{shaft:code}', [ShaftController::class, 'show'])->name('items.show');
        Route::get('/items/{shaft:code}/edit', [ShaftController::class, 'edit'])->name('items.edit');
        Route::patch('/items/{shaft:code}', [ShaftController::class, 'update'])->name('items.update');
        Route::delete('/items/{shaft}', [ShaftController::class, 'destroy'])->name('items.destroy');
        Route::post('/items/{grip:code}/image', [ShaftImageController::class, 'store'])->name('items.image.store');
        Route::delete('/items/image/{image}', [ShaftImageController::class, 'destroy'])->name('items.image.destroy');
    });

    Route::group(['prefix' => 'clubheads', 'as' => 'clubhead.'], function () {
        // clubhead routes
    });

    Route::group(['prefix' => 'purchases', 'as' => 'purchase.'], function () {
        Route::get('/grip', [GripPurchaseController::class, 'index'])->name('grip');
        Route::get('/grip/{grip:code}', [GripPurchaseController::class, 'show'])->name('grip.show');
        Route::post('/grip/{grip:code}', [GripPurchaseController::class, 'store'])->name('grip.store');
        Route::delete('/grip/{purchase}', [GripPurchaseController::class, 'destroy'])->name('grip.destroy');

        Route::get('/shaft', [ShaftPurchaseController::class, 'index'])->name('shaft');
        Route::get('/shaft/{shaft:code}', [ShaftPurchaseController::class, 'show'])->name('shaft.show');
        Route::post('/shaft/{shaft:code}', [ShaftPurchaseController::class, 'store'])->name('shaft.store');
        Route::delete('/shaft/{purchase}', [ShaftPurchaseController::class, 'destroy'])->name('shaft.destroy');
    });

    Route::group(['prefix' => 'sales', 'as' => 'sale.'], function () {
        Route::get('/grip', [GripSaleController::class, 'index'])->name('grip');
        Route::get('/grip/detail', [GripSaleController::class, 'show'])->name('grip.show');
        Route::post('/grip', [GripSaleController::class, 'store'])->name('grip.store');
        Route::delete('/grip/{sale}', [GripSaleController::class, 'destroy'])->name('grip.destroy');
    });

    Route::group(['middleware' => 'admin', 'prefix' => 'users', 'as' => 'user.'], function () {
        Route::get('/admins', [AdminController::class, 'index'])->name('admins');
        Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
        Route::get('/admins/{admin}/edit', [AdminController::class, 'edit'])->name('admins.edit');
        Route::patch('/admins/{admin}/update', [AdminController::class, 'update'])->name('admins.update');
        Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy');

        Route::get('/members', [UserController::class, 'index'])->name('members');
        Route::get('/members/{user}/edit', [UserController::class, 'edit'])->name('members.edit');
        Route::patch('/members/{user}/update', [UserController::class, 'update'])->name('members.update');
        Route::delete('/members/{user}', [UserController::class, 'destroy'])->name('members.destroy');
    });

    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::patch('/profile', [AdminController::class, 'updateProfile'])->name('profile-update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
