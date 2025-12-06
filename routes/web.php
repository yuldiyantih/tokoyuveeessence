<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingProfileController;

/*
|--------------------------------------------------------------------------
| Redirect halaman utama → login admin
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| LOGIN ADMIN (TANPA MIDDLEWARE)
|--------------------------------------------------------------------------
*/

Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/login', [AdminController::class, 'authenticate'])->name('login.process');


/*
|--------------------------------------------------------------------------
| ADMIN AREA (HARUS LOGIN ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard 
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // CRUD Produk
    Route::resource('/products', ProductController::class);

    // Riwayat transaksi
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');

    // User
    Route::resource('/users', UserController::class)->except(['show']);

    // Lihat Profil Manager
    Route::get('/profile', [SettingProfileController::class, 'show'])
        ->name('profile.show');

    // Edit Profil Manager
    Route::get('/setting-profile', [SettingProfileController::class, 'index'])
        ->name('profile.index');

    // Update Profil Manager
    Route::post('/setting-profile', [SettingProfileController::class, 'update'])
        ->name('profile.update');


    // Logout
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
});
