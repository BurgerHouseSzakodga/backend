<?php

use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//Get, minden étel
Route::get('/menu-items', [MenuItemController::class, 'index']);

//Admin útvonalak
Route::middleware(['auth:sanctum', Admin::class])
    ->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/number-of-users', [UserController::class, 'numberOfUsers']);
        Route::get('/number-of-orders', [OrderController::class, 'numberOfOrders']);
        Route::get('/total-revenue', [OrderController::class, 'totalRevenue']);
        Route::get('/pending-orders', [OrderController::class, 'pendingOrders']);
        Route::put('/users/{id}', [UserController::class, 'updateIsAdmin']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
    });
