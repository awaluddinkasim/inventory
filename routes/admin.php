<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShaftController;
use App\Http\Controllers\GripSaleController;
use App\Http\Controllers\GripTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GripImageController;
use App\Http\Controllers\GripModelController;
use App\Http\Controllers\ShaftSaleController;
use App\Http\Controllers\ShaftTypeController;
use App\Http\Controllers\ShaftImageController;
use App\Http\Controllers\GripPurchaseController;
use App\Http\Controllers\ShaftPurchaseController;

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

        Route::get('/list', [GripController::class, 'list'])->name('list');
        Route::post('/list', [GripController::class, 'store'])->name('list.store');
        Route::get('/list/{grip:code}', [GripController::class, 'show'])->name('list.show');
        Route::get('/list/{grip:code}/edit', [GripController::class, 'edit'])->name('list.edit');
        Route::patch('/list/{grip}', [GripController::class, 'update'])->name('list.update');
        Route::delete('/list/{grip}', [GripController::class, 'destroy'])->name('list.destroy')->can('delete', 'grip');
        Route::post('/list/{grip:code}/image', [GripImageController::class, 'store'])->name('list.image.store');
        Route::delete('/list/image/{image}', [GripImageController::class, 'destroy'])->name('list.image.destroy');

        Route::get('/export', [GripController::class, 'export'])->name('export');
        Route::get('/barcode', [GripController::class, 'barcode'])->name('barcode');
    });

    Route::group(['prefix' => 'shafts', 'as' => 'shaft.'], function () {
        Route::get('/types', [ShaftTypeController::class, 'index'])->name('type');
        Route::post('/types', [ShaftTypeController::class, 'store'])->name('type.store');
        Route::patch('/types/{type}', [ShaftTypeController::class, 'update'])->name('type.update');
        Route::delete('/types/{type}', [ShaftTypeController::class, 'destroy'])->name('type.destroy')->can('delete', 'type');

        Route::get('/list', [ShaftController::class, 'list'])->name('list');
        Route::post('/list', [ShaftController::class, 'store'])->name('list.store');
        Route::get('/list/{shaft:code}', [ShaftController::class, 'show'])->name('list.show');
        Route::get('/list/{shaft:code}/edit', [ShaftController::class, 'edit'])->name('list.edit');
        Route::patch('/list/{shaft:code}', [ShaftController::class, 'update'])->name('list.update');
        Route::delete('/list/{shaft}', [ShaftController::class, 'destroy'])->name('list.destroy');
        Route::post('/list/{grip:code}/image', [ShaftImageController::class, 'store'])->name('list.image.store');
        Route::delete('/list/image/{image}', [ShaftImageController::class, 'destroy'])->name('list.image.destroy');

        Route::get('/export', [ShaftController::class, 'export'])->name('export');
        Route::get('/barcode', [ShaftController::class, 'barcode'])->name('barcode');
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
        // GRIP
        Route::get('/grip', [GripSaleController::class, 'index'])->name('grip');
        Route::get('/grip/detail', [GripSaleController::class, 'show'])->name('grip.show');
        Route::post('/grip', [GripSaleController::class, 'store'])->name('grip.store');
        Route::delete('/grip/{sale}', [GripSaleController::class, 'destroy'])->name('grip.destroy');
        Route::get('/grip/export/pdf', [GripSaleController::class, 'exportPdf'])->name('grip.export.pdf');

        // SHAFT
        Route::get('/shaft', [ShaftSaleController::class, 'index'])->name('shaft');
        Route::get('/shaft/detail', [ShaftSaleController::class, 'show'])->name('shaft.show');
        Route::post('/shaft', [ShaftSaleController::class, 'store'])->name('shaft.store');
        Route::delete('/shaft/{sale}', [ShaftSaleController::class, 'destroy'])->name('shaft.destroy');
        Route::get('/shaft/export/pdf', [ShaftSaleController::class, 'exportPdf'])->name('shaft.export.pdf');
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
