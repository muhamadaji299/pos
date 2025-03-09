<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasirAuthController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTransaksiController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\delete;

Route::get('/', function () {
    return view('welcome');
});



// Login Admin

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Admin
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard/index', function () {
        return view('admin.dashboard.index');
    })->name('admin.dashboard.index');
});

// Route untuk kasir
Route::middleware('kasir')->group(function () {
    Route::get('/kasir/dashboard/index', function () {
        return view('kasir.dashboard.index');
    })->name('kasir.dashboard.index');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard/index', [AdminController::class, 'index'])->name('admin.dashboard.index');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('category', CategoryController::class);
});

Route::middleware(['auth', 'admin'])->group(function (){
    Route::resource('products', ProductController::class);
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/transaksi/index', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/admin/transaksi/store', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/admin/transaksi/{id}', [TransactionController::class, 'show'])->name('transactions.detail');
    Route::delete('/admin/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/laporan/index', [LaporanController::class, 'index'])->name('admin.laporan.index');
});

Route::middleware(['auth', 'kasir'])->group(function () {
    Route::get('/kasir/dashboard/index', [KasirController::class, 'index'])->name('kasir.dashboard.index');
});
Route::middleware(['auth', 'kasir'])->group(function () {
    Route::get('kasir/products/index', [ProductTransaksiController::class, 'index'])->name('kasir.products.index');
    Route::post('/kasir/products/{productId}/add', [ProductTransaksiController::class, 'addToTransaction'])->name('kasir.add_to_transaction');
    Route::get('/kasir/products/transaksi_detail', [ProductTransaksiController::class, 'showTransaction'])->name('kasir.products.transaksi_detail');
    Route::put('/kasir/transaction/{id}/complete', [ProductTransaksiController::class, 'completeTransaction'])
     ->name('kasir.complete_transaction');
    Route::delete('/kasir/transaction-detail/{detailId}', [ProductTransaksiController::class, 'removeProduct'])->name('kasir.remove_product');
    Route::get('/kasir/transaksi/edit/{id}', [ProductTransaksiController::class, 'editProduct'])->name('kasir.products.edit');
Route::post('/kasir/transaksi/update/{id}', [ProductTransaksiController::class, 'updateProduct'])->name('kasir.products.update');

}); 

