<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GripController;
use App\Http\Controllers\GripModelController;
use App\Http\Controllers\GripTypeController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
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

    Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
        Route::get('/type', [GripTypeController::class, 'index'])->name('type');
        Route::post('/type', [GripTypeController::class, 'store'])->name('type.store');
        Route::patch('/type/{type}', [GripTypeController::class, 'update'])->name('type.update');
        Route::delete('/type/{type}', [GripTypeController::class, 'destroy'])->name('type.destroy')->can('delete', 'type');

        Route::get('/model', [GripModelController::class, 'index'])->name('model');
        Route::post('/model', [GripModelController::class, 'store'])->name('model.store');
        Route::patch('/model/{model}', [GripModelController::class, 'update'])->name('model.update');
        Route::delete('/model/{model}', [GripModelController::class, 'destroy'])->name('model.destroy')->can('delete', 'model');
    });

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::patch('/profile', [UserController::class, 'updateProfile'])->name('profile-update');

    Route::get('/grips', [GripController::class, 'index'])->name('grips');
    Route::post('/grips', [GripController::class, 'store'])->name('grips.store');
    Route::get('/grips/{grip:code}', [GripController::class, 'show'])->name('grips.show');
    Route::get('/grips/{grip:code}/edit', [GripController::class, 'edit'])->name('grips.edit');
    Route::patch('/grips/{grip}', [GripController::class, 'update'])->name('grips.update');
    Route::delete('/grips/{grip}', [GripController::class, 'destroy'])->name('grips.destroy')->can('delete', 'grip');

    Route::get('/stock', [StockController::class, 'index'])->name('stock');
    Route::get('/stock/{grip}', [StockController::class, 'show'])->name('stock.show');
    Route::post('/stock/{grip}', [StockController::class, 'store'])->name('stock.store');
    Route::delete('/stock/{stock}', [StockController::class, 'destroy'])->name('stock.destroy');

    Route::get('/barcode', [BarcodeController::class, 'index'])->name('barcode');

    Route::middleware('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::patch('/users/{user}/update', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
