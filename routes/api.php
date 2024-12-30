<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserTicketController;
use Illuminate\Support\Facades\Route;

Route::apiResource('tickets', TicketController::class)->only(['index', 'show']);

Route::apiResource('user.tickets', UserTicketController::class)->only(['index', 'show'])->scoped();

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/user', [AuthController::class, 'user'])->name('user');

    Route::apiResource('tickets', TicketController::class)->only(['store', 'update', 'destroy']);

    Route::apiResource('user.tickets', UserTicketController::class)->only(['store', 'update', 'destroy'])->scoped();
});
