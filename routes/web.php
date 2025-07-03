<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\TransactionController;

/*
|--------------------------------------------------------------------------
| Redirect Login Umum ke Login Admin
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

/*
|--------------------------------------------------------------------------
| Halaman Utama Customer - Menampilkan Produk
|--------------------------------------------------------------------------
*/
Route::get('/', [ProductController::class, 'index'])->name('products.index');

/*
|--------------------------------------------------------------------------
| Keranjang Belanja
|--------------------------------------------------------------------------
*/
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'view'])->name('view'); // /cart
    Route::post('/tambah', [CartController::class, 'add'])->name('add'); // /cart/tambah
    Route::get('/hapus/{id}', [CartController::class, 'remove'])->name('remove'); // /cart/hapus/1
    Route::get('/clear', [CartController::class, 'clear'])->name('clear'); // /cart/clear
});

/*
|--------------------------------------------------------------------------
| Checkout (optional, jika ingin proses lebih kompleks dari WA langsung)
|--------------------------------------------------------------------------
*/
// Route ini optional jika kamu ingin simpan transaksi dulu
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

/*
|--------------------------------------------------------------------------
| Login & Logout Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

/*
|--------------------------------------------------------------------------
| Admin Area (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class); // CRUD Produk
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
});
