<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;
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
        if (auth()->user()->isAdmin()) {
            return view('dashboard');
        } elseif (auth()->user()->isKasir()) {
            return redirect()->route('kasir.transaksi');
        }
        return view('dashboard');
    })->name('dashboard');

    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::resource('produk', ProdukController::class);
        // Route::resource('stok', ProdukController::class); // Assuming StokController later
    });

    // Kasir routes
    Route::middleware('role:kasir')->group(function () {
        Route::get('/kasir-transaksi', [TransaksiController::class, 'index'])->name('kasir.transaksi');
        Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
        Route::get('/api/produks', [TransaksiController::class, 'getProduks'])->name('api.produks');
    });

    // Other views, assuming admin
    Route::view('/stok', 'admin.stok.index')->name('stok')->middleware('role:admin');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan')->middleware('role:admin');
    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export')->middleware('role:admin');
    Route::view('/pengguna', 'admin.pengguna.index')->name('pengguna')->middleware('role:admin');
});
