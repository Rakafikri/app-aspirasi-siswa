<?php

use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\InputAspirasiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return view('welcome');
});

// Auth Routes (Breeze)
Route::middleware('guest')->group(function () {
    Route::get('register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);
    Route::get('login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
    Route::get('forgot-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])
        ->name('password.request');
    Route::post('forgot-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])
        ->name('password.email');
    Route::get('reset-password/{token}', [App\Http\Controllers\Auth\NewPasswordController::class, 'create'])
        ->name('password.reset');
    Route::post('reset-password', [App\Http\Controllers\Auth\NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [App\Http\Controllers\Auth\EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [App\Http\Controllers\Auth\VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [App\Http\Controllers\Auth\EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
    Route::get('confirm-password', [App\Http\Controllers\Auth\ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');
    Route::post('confirm-password', [App\Http\Controllers\Auth\ConfirmablePasswordController::class, 'store']);
    Route::put('password', [App\Http\Controllers\Auth\PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Aspirasi Routes (Utama)
    Route::get('/aspirasi', [InputAspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/create', [InputAspirasiController::class, 'create'])->name('aspirasi.create');
    Route::post('/aspirasi', [InputAspirasiController::class, 'store'])->name('aspirasi.store');
    Route::get('/aspirasi/{id}', [InputAspirasiController::class, 'show'])->name('aspirasi.show');
    Route::get('/aspirasi/{id}/edit', [InputAspirasiController::class, 'edit'])->name('aspirasi.edit');
    Route::put('/aspirasi/{id}', [InputAspirasiController::class, 'update'])->name('aspirasi.update');

    // Admin Only Routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/admin/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    });
});

require __DIR__.'/auth.php';
