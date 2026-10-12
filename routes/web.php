<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

// Halaman Utama: Dashboard Perpustakaan SIPUS-Del
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Resource Routes RESTful untuk Kategori dan Buku
Route::resource('kategori', KategoriController::class);
Route::resource('buku', BukuController::class);
