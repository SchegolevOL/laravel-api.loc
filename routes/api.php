<?php

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
Route::prefix('v1')->middleware(['throttle:api'])->group(function (){
    Route::post('register', [\App\Http\Controllers\Api\V1\AuthController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\Api\V1\AuthController::class, 'login']);
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::prefix('v1')->middleware(['throttle:api', 'auth:sanctum'])->group(function (){
    Route::apiResource('category', \App\Http\Controllers\Api\V1\CategoryController::class);
    Route::apiResource('posts', \App\Http\Controllers\Api\V1\PostController::class);
    Route::get('logout',[\App\Http\Controllers\Api\V1\AuthController::class, 'logout']);
});


