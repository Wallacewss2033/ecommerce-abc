<?php

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rotas para produtos
Route::get('/products', [ProductController::class, 'index']);

//Rotas para orders
Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders/create', [OrderController::class, 'store']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::delete('/orders/cancel/{id}', [OrderController::class, 'cancel']);
