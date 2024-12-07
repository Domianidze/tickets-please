<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user'])->name('user');
