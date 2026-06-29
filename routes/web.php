<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminRekomendasiController;
use App\Http\Controllers\Admin\AdminRiwayatController;

Route::get('/', function () {
    return redirect()->route('admin.login');
});

// Sesi Login/Logout Admin
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::middleware(['auth'])->group(function () {
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Dashboard Beranda
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // CRUD User (Pengguna & Admin) kustom
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    // CRUD Rekomendasi (Kondisi Kulit & Tips)
    Route::get('/admin/rekomendasi', [AdminRekomendasiController::class, 'index'])->name('admin.rekomendasi.index');
    Route::get('/admin/rekomendasi/create', [AdminRekomendasiController::class, 'create'])->name('admin.rekomendasi.create');
    Route::post('/admin/rekomendasi', [AdminRekomendasiController::class, 'store'])->name('admin.rekomendasi.store');
    Route::get('/admin/rekomendasi/{id}/edit', [AdminRekomendasiController::class, 'edit'])->name('admin.rekomendasi.edit');
    Route::put('/admin/rekomendasi/{id}', [AdminRekomendasiController::class, 'update'])->name('admin.rekomendasi.update');
    Route::delete('/admin/rekomendasi/{id}', [AdminRekomendasiController::class, 'destroy'])->name('admin.rekomendasi.destroy');

    //riwayat
    Route::get('/admin/riwayat', [AdminRiwayatController::class, 'index'])->name('admin.riwayat.index');
    Route::delete('/admin/riwayat/{id}', [AdminRiwayatController::class, 'destroy'])->name('admin.riwayat.destroy');
});
