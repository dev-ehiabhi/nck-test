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
    Route::post('/register', [JwtAuthController::class, 'register'])->middleware(['guest']);
    Route::post('/login', [JwtAuthController::class, 'login'])->middleware(['guest'])->name('login');
    Route::post('/logout', [JwtAuthController::class, 'logout'])->middleware(['auth']);

    Route::get('/inventories', [InventoryController::class, 'index'])->middleware(['auth']);
    Route::get('/inventories/{id}', [InventoryController::class, 'show'])->middleware(['auth']);
    Route::post('/inventories', [InventoryController::class, 'store'])->middleware(['auth']);
    Route::put('/inventories/{id}', [InventoryController::class, 'update'])->middleware(['auth']);
    Route::delete('/inventories/{id}', [InventoryController::class, 'destroy'])->middleware(['auth']);

    Route::post('/carts', [CartController::class, 'store'])->middleware(['auth']);

    Route::get('/error', function(){
        return response()->json([
            'error' => 'Authentication error'
        ], 400);
    })->name('error');
});


