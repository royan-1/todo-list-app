<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController; // Pastikan TaskController di-import
use Illuminate\Support\Facades\Route;

// Rute utama - mengarahkan ke dashboard
Route::get('/', fn() => redirect('/dashboard'));

// --- Rute yang Membutuhkan Autentikasi ---
Route::middleware(['auth'])->group(function () {

    // Rute untuk Dashboard dan Tugas
    Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard');
    Route::resource('tasks', TaskController::class);
    Route::patch('/tasks/{task}/complete', [TaskController::class, 'markAsComplete'])->name('tasks.complete');

    

    // Rute untuk Profil Pengguna
    
    // Menggunakan prefix 'profile' agar URL lebih rapi dan konsisten
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        
    });
});

// --- Rute Autentikasi Bawaan Laravel ---
// Menginclude file auth.php terpisah untuk menjaga kebersihan
require __DIR__.'/auth.php';