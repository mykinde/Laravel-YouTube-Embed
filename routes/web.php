<?php

// routes/web.php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function () {
        return view('dashboard'); // A simple dashboard view
    })->name('dashboard');
});

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
/*
 use App\Http\Controllers\Auth\EmailVerificationController; // You'll create this

Route::middleware('auth')->group(function () {
    // ... other auth routes

    Route::get('/email/verify', [EmailVerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
    Route::post('/email/resend', [EmailVerificationController::class, 'resend'])->name('verification.send');
});

// Protect routes that require verification
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
}); 
*/

Route::get('/videos', 'App\Http\Controllers\VideoController@index')->name('videos.index');
Route::get('/videos/create', 'App\Http\Controllers\VideoController@create')->name('videos.create');
Route::post('/videos', 'App\Http\Controllers\VideoController@store')->name('videos.store');
Route::get('/videos/{id}/edit', 'App\Http\Controllers\VideoController@edit')->name('videos.edit');
Route::put('/videos/{id}', 'App\Http\Controllers\VideoController@update')->name('videos.update');
Route::delete('/videos/{id}', 'App\Http\Controllers\VideoController@destroy')->name('videos.destroy');
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'welcome'])->name('welcome');
Route::get('/videos/{video}', [LandingController::class, 'show'])->name('videos.show');
