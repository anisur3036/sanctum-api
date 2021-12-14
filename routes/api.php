<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product:slug}', [ProductController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/products', [ProductController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/products/{product:slug}', [ProductController::class, 'update']);
    Route::delete('/products/{product:slug}', [ProductController::class, 'delete']);
    Route::get('/products/search/{name}', [ProductController::class, 'search']);
});

