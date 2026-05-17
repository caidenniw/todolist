<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OtpController; // <-- 1. Tambahkan OtpController di sini

// Setup route (hapus setelah migration selesai)
require __DIR__.'/setup.php';

// Auth Routes (Login, Register, Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 2. Route OTP (Hanya bisa diakses jika SUDAH LOGIN, untuk proses verifikasi)
Route::middleware('auth')->group(function () {
    Route::get('/verify-otp', [OtpController::class, 'index'])->name('otp.verify');
    Route::post('/verify-otp', [OtpController::class, 'verify'])->name('otp.verify.submit');
    Route::post('/resend-otp', [OtpController::class, 'resend'])->name('otp.resend');
});

// 3. Protected Routes (Todo List - Harus LOGIN dan OTP VERIFIED)
Route::middleware(['auth', 'otp.verified'])->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
});