<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
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
Route::get('/discounts', [MenuItemController::class, 'discountedItems']);
Route::get('/not-in-discounts', [MenuItemController::class, 'notInDiscounts']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/ingredients', [IngredientController::class, 'index']);
Route::get('popular-items', [MenuItemController::class, 'popularItems']);

//Auth útvonalak
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/add-to-basket', [BasketController::class, 'addToBasket']);
    Route::post('/order-basket', [BasketController::class, 'orderBasket']);

    Route::get('/user/order/{id}', [OrderController::class, 'userOrders']);
    Route::get('/menu-item/{id}', [MenuItemController::class, 'menuItemWithIngredients']);
    Route::get('/basket', [BasketController::class, 'getUserBasket']);
    Route::get('/active-orders', [OrderController::class, 'activeUserOrders']);

    //profil modositás
    Route::patch('/user/name', [UserController::class, 'updateName']);
    Route::patch('/user/email', [UserController::class, 'updateEmail']);
    Route::patch('/user/address', [UserController::class, 'updateAddress']);

    Route::patch('/user/update-profile', [UserController::class, 'updateProfile']);
    Route::put('/user/update-full-address', [UserController::class, 'updateFullAddress']);
    Route::put('/user/password', [UserController::class, 'changePassword']);

    Route::delete('/delete-basket-item/{id}', [BasketController::class, 'deleteBasketItem']);
});

//Admin útvonalak
Route::middleware(['auth:sanctum', Admin::class])
    ->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/number-of-users', [UserController::class, 'numberOfUsers']);
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/number-of-orders', [OrderController::class, 'numberOfOrders']);
        Route::get('/pending-orders', [OrderController::class, 'pendingOrders']);
        Route::get('/total-revenue', [OrderController::class, 'totalRevenue']);
        Route::get('/revenue-by-days/{days}', [OrderController::class, 'revenueByDays']);
        Route::get('/number-of-deliveries', [OrderController::class, 'numberOfDeliveries']);
        Route::get('/number-of-collects', [OrderController::class, 'numberOfCollects']);
        Route::get('/number-of-items-in-a-category/{id}', [MenuItemController::class, 'numberOfItemsInACategory']);

        Route::delete('/users/{id}', [UserController::class, 'destroy']);
        Route::delete('/menu-items/{id}', [MenuItemController::class, 'destroy']);
        Route::delete('order/{id}', [OrderController::class, 'destroy']);

        Route::put('/menu-items/{id}/name', [MenuItemController::class, 'updateName']);
        Route::put('/menu-items/{id}/price', [MenuItemController::class, 'updatePrice']);
        Route::put('/menu-items/{id}/category', [MenuItemController::class, 'updateCategory']);
        Route::put('/menu-items/{id}/description', [MenuItemController::class, 'updateDescription']);
        Route::put('/menu-items/{id}/composition', [MenuItemController::class, 'updateComposition']);
        Route::put('/discounts/{id}', [MenuItemController::class, 'updateDiscountAmount']);
        Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus']);
        Route::put('/users/{id}', [UserController::class, 'updateIsAdmin']);
        Route::put('/reset-reduction/{id}', [MenuItemController::class, 'resetPriceReduction']);

        Route::post('/menu-items/{id}/image', [MenuItemController::class, 'updateImage']);
        Route::post('/menu-items', [MenuItemController::class, 'store']);
    });
