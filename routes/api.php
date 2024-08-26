<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware('auth:api');
    Route::post('refresh', 'refresh')->middleware('auth:api');
});

Route::apiResource('movies', MovieController::class);

Route::middleware('auth:api')->group(function () {
    Route::post('movies/{movie}/ratings', [RatingController::class, 'store']);
    Route::put('/movies/{movie}/ratings/{rating}', [RatingController::class, 'update']);
    Route::delete('/movies/{movie}/ratings/{rating}', [RatingController::class, 'destroy']);
});
