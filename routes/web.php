<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\TransactionController;

// Alihkan route 'login' standar ke halaman login admin
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Halaman utama tampilkan produk (customer)
Route::get('/', [AdminProductController::class, 'index'])->name('products.index');

// Keranjang belanja
Route::post('/add-to-cart', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'view'])->name('cart.view');

// Proses checkout
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

// Login Admin
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Semua route admin harus login dulu (guard admin)
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // CRUD produk admin
    Route::resource('products', AdminProductController::class, ['as' => 'admin']);

    // Lihat transaksi
    Route::get('/transactions', [TransactionController::class, 'index'])->name('admin.transactions.index');
});
