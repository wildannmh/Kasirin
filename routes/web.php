<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// 1. Route Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// 2. Route Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. Route Halaman Utama (Sidebar Menu)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->isKasir()) {
            return redirect()->route('kasir.transaksi');
        }
        // Admin stays on dashboard
        return app(DashboardController::class)->index();
    })->name('dashboard');

    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::resource('produk', ProdukController::class);
        // Route::resource('stok', ProdukController::class); // Assuming StokController later
    });

    // Kasir routes
    Route::prefix('kasir')->name('kasir.')->middleware('role:kasir')->group(function () {
        Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
        Route::post('/transaksi', [TransaksiController::class, 'store'])->name('store');
        Route::get('/api/produks', [TransaksiController::class, 'getProduks'])->name('produks');
    });

    // Other views, assuming admin
    Route::resource('pengguna', UserController::class)->middleware('role:admin');
    Route::get('/laporan', [LaporanController::class, 'index'])->middleware('role:admin')->name('laporan');
    Route::view('/stok', 'admin.stok.index')->name('stok')->middleware('role:admin');
});
