<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//Guest útvonalak
Route::get('/menu-items', [MenuItemController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);

//Admin útvonalak
Route::middleware(['auth:sanctum', Admin::class])
    ->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/number-of-users', [UserController::class, 'numberOfUsers']);
        Route::get('/number-of-orders', [OrderController::class, 'numberOfOrders']);
        Route::get('/total-revenue', [OrderController::class, 'totalRevenue']);
        Route::get('/revenue-by-days/{days}', [OrderController::class, 'revenueByDays']);
        Route::get('/pending-orders', [OrderController::class, 'pendingOrders']);
        Route::get('/ingredients', [IngredientController::class, 'index']);

        Route::put('/users/{id}', [UserController::class, 'updateIsAdmin']);

        Route::delete('/users/{id}', [UserController::class, 'destroy']);

        Route::put('/menu-items/{id}/name', [MenuItemController::class, 'updateName']);
        Route::put('/menu-items/{id}/price', [MenuItemController::class, 'updatePrice']);
        Route::put('/menu-items/{id}/category', [MenuItemController::class, 'updateCategory']);

        Route::post('/menu-items', [MenuItemController::class, 'store']);
    });
