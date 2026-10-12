<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

// Redirect halaman utama ke daftar buku
Route::get('/', function () {
    return redirect()->route('buku.index');
});

// Resource routes untuk Kategori dan Buku
Route::resource('kategori', KategoriController::class);
Route::resource('buku', BukuController::class);
