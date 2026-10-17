<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

// 1. Halaman Publik / Tamu (Dashboard & Katalog Index)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

// 2. Rute Autentikasi Tamu (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

// 3. Rute Pustakawan Terproteksi (Auth)
Route::middleware('auth')->group(function () {
    // Logout Sesi Pustakawan
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Mutasi Data Buku (Create, Store, Edit, Update, Destroy)
    Route::resource('buku', BukuController::class)->except(['index', 'show']);

    // Mutasi Data Kategori (Create, Store, Edit, Update, Destroy)
    Route::resource('kategori', KategoriController::class)->except(['index', 'show']);

    // Sirkulasi Peminjaman & Pengembalian Buku (ACID Transactions)
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::post('/peminjaman/{peminjaman}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
});

// 4. Detail Publik (Buku & Kategori) diletakkan setelah rute create agar tidak bentrok
Route::get('/buku/{buku}', [BukuController::class, 'show'])->name('buku.show')->whereNumber('buku');
Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show')->whereNumber('kategori');
