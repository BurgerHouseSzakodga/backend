<?php

use App\Http\Controllers\MenuItemController;
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
        Route::get('/menu-items-admin', [MenuItemController::class, 'index']);
    });
