<?php

use App\Http\Controllers\V1\CartController;
use App\Http\Controllers\V1\InventoryController;
use App\Http\Controllers\V1\JwtAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api'], function($router) {
    Route::post('/register', [JwtAuthController::class, 'register']);
    Route::post('/login', [JwtAuthController::class, 'login']);
    Route::post('/logout', [JwtAuthController::class, 'logout']);

    Route::get('/inventories', [InventoryController::class, 'index']);
    Route::get('/inventories/{id}', [InventoryController::class, 'show']);
    Route::post('/inventories', [InventoryController::class, 'store']);
    Route::put('/inventories', [InventoryController::class, 'update']);
    Route::delete('/inventories', [InventoryController::class, 'destroy']);

    Route::post('/carts', [CartController::class, 'store']);
});


