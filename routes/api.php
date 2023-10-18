<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;

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

Route::prefix('user')->group(function () {
    Route::post('register', [UserApiController::class, 'register']);
    Route::post('login', [UserApiController::class, 'authentication']);

    Route::post('/', [UserApiController::class, 'loadUser'])->middleware('jwt.verify');
    Route::post('forgot-password', [UserApiController::class, 'forgotPassword'])->middleware('guest')->name('password.forgot');
    Route::post('reset-password', [UserApiController::class, 'resetPassword'])->middleware('guest')->name('password.update');
    Route::get('logout', [UserApiController::class, 'jwtTokenLogout'])->middleware('jwt.verify');
});

