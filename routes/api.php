<?php

use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::prefix('user')->controller(UserController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout');
});

Route::prefix('product')->controller(ProductController::class)->group(function () {
    Route::get('/list', 'index');
    Route::get('/{id}', 'show');
    Route::post('/create', 'store');
    Route::put('/update/{id}', 'update');
    Route::delete('/delete/{id}', 'destroy');
});

Route::prefix('offer')->controller(OfferController::class)->group(function () {
    Route::get('/list/{productId}', 'index');
    Route::get('/{id}', 'show');
    Route::post('/create', 'store');
    Route::put('/update/{id}', 'update');
    Route::delete('/delete/{id}', 'destroy');
});
