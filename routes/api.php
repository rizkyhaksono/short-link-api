<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/links', [LinksController::class, 'index']);
Route::get('/links/{id}', [LinksController::class, 'show']);
Route::post('/links', [LinksController::class, 'store']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::put('/links/{id}', [LinksController::class, 'update']);
    Route::delete('/links/{id}', [LinksController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
