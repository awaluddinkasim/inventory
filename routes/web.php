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

    Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
        Route::get('/model', [GripModelController::class, 'index'])->name('model');
        Route::post('/model', [GripModelController::class, 'store'])->name('model.store');
        Route::delete('/model/{model}', [GripModelController::class, 'destroy'])->name('model.destroy')->can('delete', 'model');

        Route::get('/size', [GripSizeController::class, 'index'])->name('size');
        Route::post('/size', [GripSizeController::class, 'store'])->name('size.store');
        Route::delete('/size/{size}', [GripSizeController::class, 'destroy'])->name('size.destroy')->can('delete', 'size');
    });

    Route::get('/grips', [GripController::class, 'index'])->name('grips');
    Route::post('/grips', [GripController::class, 'store'])->name('grips.store');
    Route::get('/grips/{grip}', [GripController::class, 'edit'])->name('grips.edit')->can('update', 'grip');
    Route::patch('/grips/{grip}', [GripController::class, 'update'])->name('grips.update')->can('update', 'grip');
    Route::delete('/grips/{grip}', [GripController::class, 'destroy'])->name('grips.destroy')->can('delete', 'grip');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
