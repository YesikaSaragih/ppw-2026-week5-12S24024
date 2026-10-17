<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman utama Dashboard Perpustakaan dengan metrik analitik
     * yang dihitung menggunakan Fluent Query Builder (DB::table()) sesuai Modul Minggu 6.
     */
    public function index(): View
    {
        // 1. Rekapitulasi Analitik menggunakan Fluent Query Builder (DB::table)
        $totalJudul = DB::table('bukus')->count();
        $totalStok = (int) DB::table('bukus')->sum('stok');
        $totalDipinjam = DB::table('peminjamans')->where('status', 'dipinjam')->count();
        $totalDikembalikan = DB::table('peminjamans')->where('status', 'dikembalikan')->count();
        $totalKategori = DB::table('kategoris')->count();
        $stokKosong = DB::table('bukus')->where('stok', 0)->count();

        // 2. Koleksi 5 Buku Terbaru dengan Eager Loading dan withCount peminjamans (Bebas N+1)
        $recentBukus = Buku::with('kategori')
            ->withCount('peminjamans')
            ->latest()
            ->take(5)
            ->get();

        // 3. Sirkulasi 5 Peminjaman Aktif Terbaru
        $recentPeminjamans = Peminjaman::with('buku')
            ->where('status', 'dipinjam')
            ->latest('tanggal_pinjam')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalJudul',
            'totalStok',
            'totalDipinjam',
            'totalDikembalikan',
            'totalKategori',
            'stokKosong',
            'recentBukus',
            'recentPeminjamans'
        ));
    }
}
