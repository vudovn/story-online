<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get("/login", [AuthController::class, "login"])->name("auth.login")->middleware("checkNoLogin");
Route::post("/doLogin", [AuthController::class, "doLogin"])->name("auth.doLogin");
Route::post("/doLogout", [AuthController::class, "doLogout"])->name("auth.doLogout");

// Registration routes
Route::get("/register", [AuthController::class, "register"])->name("auth.register")->middleware("checkNoLogin");
Route::post("/doRegister", [AuthController::class, "doRegister"])->name("auth.doRegister");

// Password reset routes
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgot-password')->middleware('checkNoLogin');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('auth.password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('auth.password.update');

// User profile management (requires authentication)
Route::middleware('checkLogin')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('auth.profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('auth.profile.update');
    Route::get('/change-password', [AuthController::class, 'changePassword'])->name('auth.password.change');
    Route::post('/change-password', [AuthController::class, 'updatePassword2'])->name('auth.password.change.update');
});