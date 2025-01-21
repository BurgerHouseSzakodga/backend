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

//Auth útvonalak
Route::middleware('auth:sanctum')->put('/user/profile', [UserController::class, 'userDataUpdate']);


//Guest útvonalak
Route::get('/menu-items', [MenuItemController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/ingredients', [IngredientController::class, 'index']);

//Admin útvonalak
Route::middleware(['auth:sanctum', Admin::class])
    ->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/number-of-users', [UserController::class, 'numberOfUsers']);
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/number-of-orders', [OrderController::class, 'numberOfOrders']);
        Route::get('/total-revenue', [OrderController::class, 'totalRevenue']);
        Route::get('/revenue-by-days/{days}', [OrderController::class, 'revenueByDays']);
        Route::get('/pending-orders', [OrderController::class, 'pendingOrders']);

        Route::put('/users/{id}', [UserController::class, 'updateIsAdmin']);

        Route::delete('/users/{id}', [UserController::class, 'destroy']);
        Route::delete('/menu-items/{id}', [MenuItemController::class, 'destroy']);

        Route::put('/menu-items/{id}/name', [MenuItemController::class, 'updateName']);
        Route::put('/menu-items/{id}/price', [MenuItemController::class, 'updatePrice']);
        Route::put('/menu-items/{id}/category', [MenuItemController::class, 'updateCategory']);
        Route::post('/menu-items/{id}/image', [MenuItemController::class, 'updateImage']);
        Route::put('/menu-items/{id}/description', [MenuItemController::class, 'updateDescription']);
        Route::put('/menu-items/{id}/composition', [MenuItemController::class, 'updateComposition']);

        Route::post('/menu-items', [MenuItemController::class, 'store']);
    });
