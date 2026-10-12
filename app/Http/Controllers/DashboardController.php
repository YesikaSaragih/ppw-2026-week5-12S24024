<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman utama Dashboard Perpustakaan dengan metrik dan data riil.
     */
    public function index(): View
    {
        // Menghitung statistik riil langsung dari database
        $totalJudul = Buku::count();
        $totalKategori = Kategori::count();
        $totalStok = (int) Buku::sum('stok');
        $stokKosong = Buku::where('stok', 0)->count();

        // Mengambil 5 buku terbaru dengan Eager Loading kategori untuk mitigasi N+1
        $recentBukus = Buku::with('kategori')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalJudul',
            'totalKategori',
            'totalStok',
            'stokKosong',
            'recentBukus'
        ));
    }
}
