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

Route::resource('threads', \App\Http\Controllers\Api\ThreadController::class);
Route::resource('posts', \App\Http\Controllers\Api\PostController::class);
Route::post('auth/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
