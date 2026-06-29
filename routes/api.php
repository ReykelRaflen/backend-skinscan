<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RiwayatController;

// Rute Publik (Tanpa Login)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/verify-user', [AuthController::class, 'verifyUser']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Rute Terproteksi (Wajib Mengirimkan Bearer Token di Header)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'getCurrentUser']);
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);

    // Verifikasi OTP Email
    Route::post('/send-otp', [AuthController::class, 'sendVerificationOtp']);
    Route::post('/verify-otp', [AuthController::class, 'verifyEmailOtp']);

    // Manajemen Riwayat
    Route::get('/riwayat', [RiwayatController::class, 'index']);
    Route::post('/riwayat', [RiwayatController::class, 'store']);
    Route::delete('/riwayat/{id}', [RiwayatController::class, 'destroy']);
});
