<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/

// Admin
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingProfileController;

// Customer
use App\Http\Controllers\Customer\AuthCustomerController;
use App\Http\Controllers\Customer\ProfileCustomerController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;

// Frontend
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\FrontendProductController;

/*
|--------------------------------------------------------------------------
| HALAMAN UMUM / FRONTEND
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/home', [PageController::class, 'home'])->name('home.redirect');

Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::get('/aboutus', [PageController::class, 'aboutus'])->name('aboutus');
Route::get('/kebijakan-privasi', [PageController::class, 'kebijakanPrivasi'])->name('kebijakan');
Route::get('/syarat-ketentuan', [PageController::class, 'syaratKetentuan'])->name('syarat');



/*
/*
|--------------------------------------------------------------------------
| PRODUK FRONTEND
|--------------------------------------------------------------------------
*/

Route::get('/produk', [FrontendProductController::class, 'index'])->name('produk.index');
Route::get('/produk/{id}', [FrontendProductController::class, 'show'])->name('produk.show');
Route::get('/buy-now/{id}', [FrontendProductController::class, 'buyNow'])->name('buy.now');

/*
|--------------------------------------------------------------------------
| AUTH ADMIN & CUSTOMER
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthCustomerController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthCustomerController::class, 'authenticate'])
    ->name('login.process');

Route::get('/register', [AuthCustomerController::class, 'showRegister'])
    ->name('customer.register');

Route::post('/register', [AuthCustomerController::class, 'register'])
    ->name('customer.register.process');


/*
|--------------------------------------------------------------------------
| CUSTOMER AREA (LOGIN WAJIB)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {

    // Account & Profile
    Route::get('/account', [ProfileCustomerController::class, 'account'])
        ->name('account');

    Route::get('/profile', [ProfileCustomerController::class, 'index'])
        ->name('profile.index');

    Route::post('/profile/store', [ProfileCustomerController::class, 'store'])
        ->name('profile.store');

    Route::post('/profile/update', [ProfileCustomerController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile/{id}', [ProfileCustomerController::class, 'destroy'])
        ->name('profile.delete');

    // 🔥 BUY NOW → langsung ke checkout
    Route::post('/buy-now/{id}', [FrontendProductController::class, 'buyNow'])
        ->name('buy.now');


    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    //Route::post('/cart/buy/{id}', [CartController::class, 'buy'])->name('cart.buy');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', fn() => view('frontend.checkout.success'))
        ->name('checkout.success');

    // Logout customer
    Route::post('/logout', [AuthCustomerController::class, 'logout'])
        ->name('logout');
});



/*
|--------------------------------------------------------------------------
| ADMIN AREA (ADMIN & SUPER ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Produk
    Route::resource('/products', ProductController::class);

    // =====================
    // TRANSACTIONS - CUSTOM ACTIONS
    // =====================

    // Print
    Route::get('/transactions/print', [TransactionController::class, 'print'])
        ->name('transactions.print');

    Route::get('/transactions/print-pdf', [TransactionController::class, 'printPdf'])
        ->name('transactions.printPdf');

    // Status (button actions)
    Route::get('/transactions/proses/{id}', [TransactionController::class, 'proses'])
        ->name('transactions.proses');

    Route::get('/transactions/terkirim/{id}', [TransactionController::class, 'terkirim'])
        ->name('transactions.terkirim');

    // Update status (PUT)
    Route::put('/transactions/update-status/{id}', [TransactionController::class, 'updateStatus'])
        ->name('transactions.updateStatus');

    // Print single (PASTI DI BAWAH print)
    Route::get('/transactions/print/{id}', [TransactionController::class, 'printSingle'])
        ->name('transactions.printSingle');

    // =====================
    // TRANSACTIONS - RESOURCE (PALING BAWAH)
    // =====================
    Route::resource('/transactions', TransactionController::class)
        ->except(['create', 'store']);


    // User (Super Admin)
    Route::resource('/users', UserController::class)->except(['show']);

    // Profil admin
    Route::get('/profile', [SettingProfileController::class, 'index'])
        ->name('profile.index');

    Route::post('/profile', [SettingProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/profile/view', [SettingProfileController::class, 'show'])
        ->name('profile.show');

    // Logout admin
    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->name('logout');
});
