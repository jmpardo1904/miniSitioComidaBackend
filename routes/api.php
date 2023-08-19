<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("registro", [UserController::class, 'create']);
Route::post("login",    [UserController::class, 'login']);
Route::post('logout',   [UserController::class, 'logout'])->middleware('auth:api');
Route::get('/comida',   [FoodController::class, 'index']);
Route::post('orders',    [OrderController::class, 'create']);
