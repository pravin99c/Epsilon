<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\User\ChangePasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password_forgot');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password_forgot');

    Route::get('reset-password' , [NewPasswordController::class, 'create'])->name('password_update');

    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


Route::group(['prefix' => 'user', 'middleware' => 'auth', 'as' => 'user.'], function () {
    Route::get('profile/overview', [ProfileController::class, 'overview'])->name('profile.overview');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::PUT('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('change-password', [ChangePasswordController::class, 'index'])->name('change-password');
    Route::post('change-password', [ChangePasswordController::class, 'create'])->name('change-password');
});
