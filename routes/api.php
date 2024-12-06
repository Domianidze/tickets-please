<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/authorize', [AuthController::class, 'authorize']);

Route::post('/unauthorize', [AuthController::class, 'unauthorize'])->middleware('auth:sanctum');
