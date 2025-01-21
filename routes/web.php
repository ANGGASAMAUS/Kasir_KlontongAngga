<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

// Route untuk halaman beranda (opsional)
Route::get('/', function () {
    return redirect()->route('produk.index');
});

// Middleware untuk autentikasi
Route::middleware('auth')->group(function () {
    // Route untuk Produk
    Route::resource('produk', ProdukController::class);

    // Route untuk Transaksi
    Route::resource('transaksi', TransaksiController::class);
    
    // Route untuk Kasir
    Route::resource('kasir', KasirController::class);
    Route::get('/transaksi/print', [TransaksiController::class, 'print'])->name('transaksi.print');

    
    // Route untuk Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route untuk autentikasi (Login, Register, Logout)
Auth::routes();

// Route setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home');
