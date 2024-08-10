<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GripController;
use App\Http\Controllers\GripModelController;
use App\Http\Controllers\GripTypeController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

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
    });

    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::patch('/profile', [AdminController::class, 'updateProfile'])->name('profile-update');

    Route::get('/stock', [StockController::class, 'index'])->name('stock');
    Route::get('/stock/{grip}', [StockController::class, 'show'])->name('stock.show');
    Route::post('/stock/{grip}', [StockController::class, 'store'])->name('stock.store');
    Route::delete('/stock/{stock}', [StockController::class, 'destroy'])->name('stock.destroy');

    Route::get('/barcode', [BarcodeController::class, 'index'])->name('barcode');

    Route::group(['middleware' => 'admin', 'prefix' => 'users', 'as' => 'user.'], function () {
        Route::get('/admins', [AdminController::class, 'index'])->name('admins');
        Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
        Route::get('/admins/{admin}/edit', [AdminController::class, 'edit'])->name('admins.edit');
        Route::patch('/admins/{admin}/update', [AdminController::class, 'update'])->name('admins.update');
        Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
