<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FrontendProductController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [PageController::class, 'home'])->name('home');

// Tambahan URL /home (opsional)
Route::get('/home', [PageController::class, 'home'])->name('home.redirect');

// Halaman tentang
Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');

// Halaman kontak
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');

// Halaman about us
Route::get('/aboutus', [PageController::class, 'aboutus'])->name('aboutus');

// Halaman kebijakan-privasi
Route::get('/kebijakan-privasi', [PageController::class, 'kebijakanPrivasi'])->name('kebijakan');

// Halaman syarat-ketentuan
Route::get('/syarat-ketentuan', [PageController::class, 'syaratKetentuan'])->name('syarat');

// Checkout
Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process/{id}', [CheckoutController::class, 'process'])->name('checkout.process');


// ============= halaman produk frontend=============
// Halaman daftar produk
Route::get('/produk', [FrontendProductController::class, 'index'])->name('produk.index');

// Halaman detail produk
Route::get('/produk/{id}', [FrontendProductController::class, 'show'])->name('produk.show');

/*
|--------------------------------------------------------------------------
| LOGIN ADMIN (TANPA MIDDLEWARE)
|--------------------------------------------------------------------------
*/

Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/login', [AdminController::class, 'authenticate'])->name('login.process');


/*
|--------------------------------------------------------------------------
| ADMIN AREA (HARUS LOGIN ADMIN) BACKEND
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
