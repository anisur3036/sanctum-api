<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product:slug}', [ProductController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/products', [ProductController::class, 'store'])->middleware('auth:sanctum');
Route::put('/products/{product:slug}', [ProductController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/products/{product:slug}', [ProductController::class, 'delete'])->middleware('auth:sanctum');
