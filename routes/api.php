<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserTicketController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::apiResource('users', UserController::class)->only(['index', 'show']);

Route::apiResource('tickets', TicketController::class)->only(['index', 'show']);

Route::apiResource('user.tickets', UserTicketController::class)->only(['index', 'show'])->scoped();

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::apiResource('users', UserController::class)->only(['store', 'update', 'destroy']);

    Route::apiResource('tickets', TicketController::class)->only(['store', 'update', 'destroy']);

    Route::apiResource('user.tickets', UserTicketController::class)->only(['store', 'update', 'destroy'])->scoped();
});
