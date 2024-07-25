<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GripController;
use App\Http\Controllers\GripModelController;
use App\Http\Controllers\GripSizeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'master'], function () {
        Route::get('/model', [GripModelController::class, 'index']);
        Route::post('/model', [GripModelController::class, 'store']);
        Route::delete('/model/{model}', [GripModelController::class, 'destroy'])->can('delete', 'model');

        Route::get('/size', [GripSizeController::class, 'index']);
        Route::post('/size', [GripSizeController::class, 'store']);
        Route::delete('/size/{size}', [GripSizeController::class, 'destroy'])->can('delete', 'size');
    });

    Route::get('/grips', [GripController::class, 'index']);
    Route::post('/grips', [GripController::class, 'store']);
    Route::get('/grips/{grip}', [GripController::class, 'edit'])->can('update', 'grip');
    Route::patch('/grips/{grip}', [GripController::class, 'update'])->can('update', 'grip');
    Route::delete('/grips/{grip}', [GripController::class, 'destroy'])->can('delete', 'grip');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
