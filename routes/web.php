<?php

use Illuminate\Support\Facades\Route;

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// 1. Route Login & Proses Login Dummy
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', function() {
    return redirect('/dashboard');
});

// 2. Route Logout Dummy
// Menggunakan GET karena di HTML Anda menggunakan tag <a href="/logout">
Route::get('/logout', function () {
    // Di aplikasi nyata, di sini kita menghapus session: Auth::logout();
    return redirect()->route('login'); 
})->name('logout');

// 3. Route Halaman Utama (Sidebar Menu)
Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/produk', 'admin.produk.index')->name('produk');
Route::view('/stok', 'admin.stok.index')->name('stok');
Route::view('/laporan', 'admin.laporan.index')->name('laporan');
Route::view('/pengguna', 'admin.pengguna.index')->name('pengguna');
Route::get('/kasir-transaksi', function () {
    return view('kasir.index'); // File view khusus kasir
})->name('kasir.transaksi');