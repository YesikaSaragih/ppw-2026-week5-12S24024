<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PeminjamanController extends Controller
{
    /**
     * Tampilkan riwayat transaksi sirkulasi peminjaman & pengembalian buku
     * dengan pencarian dinamis when(), filter status, dan pagination withQueryString().
     */
    public function index(Request $request): View
    {
        // Simpan pencarian terakhir di session sesuai modul
        if ($request->filled('search')) {
            session(['last_peminjaman_search' => $request->search]);
        }

        $query = Peminjaman::with(['buku.kategori']);

        // Filter pencarian dinamis kondisional menggunakan when()
        $query->when($request->search, function ($q, $search) {
            $search = trim($search);
            $q->where(function ($sub) use ($search) {
                $sub->where('kode_pinjam', 'like', "%{$search}%")
                    ->orWhere('nim_peminjam', 'like', "%{$search}%")
                    ->orWhere('nama_peminjam', 'like', "%{$search}%")
                    ->orWhereHas('buku', function ($bookQuery) use ($search) {
                        $bookQuery->where('judul', 'like', "%{$search}%")
                                  ->orWhere('isbn', 'like', "%{$search}%");
                    });
            });
        });

        // Filter status transaksi ('dipinjam' atau 'dikembalikan')
        $query->when($request->status, function ($q, $status) {
            if (in_array($status, ['dipinjam', 'dikembalikan'])) {
                $q->where('status', $status);
            }
        });

        $peminjamans = $query->latest('tanggal_pinjam')
                             ->latest('id')
                             ->paginate(10)
                             ->withQueryString();

        // Statistik ringkas sirkulasi menggunakan Fluent Query Builder DB::table
        $stats = [
            'total_transaksi' => DB::table('peminjamans')->count(),
            'total_dipinjam' => DB::table('peminjamans')->where('status', 'dipinjam')->count(),
            'total_dikembalikan' => DB::table('peminjamans')->where('status', 'dikembalikan')->count(),
        ];

        return view('peminjaman.index', compact('peminjamans', 'stats'));
    }

    /**
     * Tampilkan formulir peminjaman buku baru.
     */
    public function create(Request $request): View
    {
        // Ambil buku yang stoknya tersedia (> 0) untuk form peminjaman
        $bukus = Buku::with('kategori')
            ->where('stok', '>', 0)
            ->orderBy('judul')
            ->get();

        $selectedBukuId = $request->query('buku_id');

        return view('peminjaman.create', compact('bukus', 'selectedBukuId'));
    }

    /**
     * Simpan transaksi peminjaman buku dengan transaksi ACID (DB::transaction & lockForUpdate)
     * serta validasi ketersediaan stok fisik dan pencegahan peminjaman ganda.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'buku_id' => ['required', 'exists:bukus,id'],
            'nim_peminjam' => ['required', 'string', 'min:6', 'max:20'],
            'nama_peminjam' => ['required', 'string', 'min:3', 'max:150'],
            'tanggal_pinjam' => ['required', 'date'],
            'tanggal_jatuh_tempo' => ['required', 'date', 'after_or_equal:tanggal_pinjam'],
        ], [
            'buku_id.required' => 'Buku yang dipinjam wajib dipilih.',
            'buku_id.exists' => 'Buku yang dipilih tidak terdaftar di perpustakaan.',
            'nim_peminjam.required' => 'NIM mahasiswa peminjam wajib diisi.',
            'nim_peminjam.min' => 'NIM peminjam minimal 6 karakter.',
            'nama_peminjam.required' => 'Nama mahasiswa peminjam wajib diisi.',
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib ditentukan.',
            'tanggal_jatuh_tempo.required' => 'Tanggal jatuh tempo wajib ditentukan.',
            'tanggal_jatuh_tempo.after_or_equal' => 'Tanggal jatuh tempo tidak boleh sebelum tanggal pinjam.',
        ]);

        $nim = strtoupper(trim($validated['nim_peminjam']));
        $nama = trim($validated['nama_peminjam']);
        $bukuId = (int) $validated['buku_id'];

        try {
            // Transaksi ACID dengan isolasi tinggi dan Pessimistic Locking lockForUpdate()
            $peminjaman = DB::transaction(function () use ($validated, $bukuId, $nim, $nama) {
                // Kunci baris buku untuk mencegah Race Condition stok
                $buku = Buku::where('id', $bukuId)->lockForUpdate()->firstOrFail();

                // Pemeriksaan stok: tolak dan rollback transaksi jika stok = 0
                if ($buku->stok < 1) {
                    throw new \RuntimeException("Buku '{$buku->judul}' sedang habis (stok fisik 0) dan tidak dapat dipinjam!");
                }

                // Pencegahan peminjaman ganda: periksa apakah NIM yang sama masih meminjam buku yang sama
                $pinjamanAktif = Peminjaman::where('buku_id', $buku->id)
                    ->where('nim_peminjam', $nim)
                    ->where('status', 'dipinjam')
                    ->lockForUpdate()
                    ->first();

                if ($pinjamanAktif) {
                    throw new \RuntimeException("Mahasiswa dengan NIM {$nim} saat ini masih meminjam buku ini (Kode: {$pinjamanAktif->kode_pinjam}) dan belum mengembalikannya.");
                }

                // Generate kode peminjaman unik: PINJ-YYYYMMDD-XXXX
                do {
                    $kodePinjam = 'PINJ-' . date('Ymd') . '-' . strtoupper(Str::random(5));
                } while (Peminjaman::where('kode_pinjam', $kodePinjam)->exists());

                // Kurangi stok buku secara atomik
                $buku->decrement('stok');

                // Catat transaksi peminjaman ke database
                return Peminjaman::create([
                    'kode_pinjam' => $kodePinjam,
                    'buku_id' => $buku->id,
                    'nim_peminjam' => $nim,
                    'nama_peminjam' => $nama,
                    'tanggal_pinjam' => $validated['tanggal_pinjam'],
                    'tanggal_jatuh_tempo' => $validated['tanggal_jatuh_tempo'],
                    'tanggal_kembali' => null,
                    'status' => 'dipinjam',
                ]);
            }, 3);

            // Simpan state sesi peminjam terakhir untuk mempermudah operasional pustakawan
            session([
                'last_borrower_nim' => $nim,
                'last_borrower_name' => $nama,
            ]);

            return redirect()->route('peminjaman.index')->with(
                'success',
                "Peminjaman buku berhasil dicatat secara atomik (Kode: {$peminjaman->kode_pinjam}). Stok buku berhasil diperbarui."
            );
        } catch (\RuntimeException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('[DB EXCEPTION - PEMINJAMAN]: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Terjadi kesalahan sistem database saat memproses peminjaman.');
        }
    }

    /**
     * Proses pengembalian buku dengan transaksi ACID (DB::transaction & lockForUpdate),
     * memperbarui tanggal kembali, mengubah status, dan mengembalikan stok fisik buku.
     */
    public function kembalikan(Request $request, Peminjaman $peminjaman): RedirectResponse
    {
        try {
            DB::transaction(function () use ($peminjaman) {
                // Kunci baris peminjaman dengan lockForUpdate()
                $loan = Peminjaman::where('id', $peminjaman->id)->lockForUpdate()->firstOrFail();

                if ($loan->status === 'dikembalikan') {
                    throw new \RuntimeException("Transaksi peminjaman {$loan->kode_pinjam} sudah tercatat dikembalikan sebelumnya!");
                }

                // Kunci baris buku terkait untuk mengembalikan stok secara atomik
                $buku = Buku::where('id', $loan->buku_id)->lockForUpdate()->firstOrFail();

                // Perbarui status transaksi peminjaman
                $loan->update([
                    'status' => 'dikembalikan',
                    'tanggal_kembali' => now()->toDateString(),
                ]);

                // Kembalikan stok fisik buku (+1)
                $buku->increment('stok');
            }, 3);

            return redirect()->route('peminjaman.index')->with(
                'success',
                "Buku dengan kode peminjaman {$peminjaman->kode_pinjam} berhasil dikembalikan. Stok buku bertambah kembali."
            );
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('[DB EXCEPTION - PENGEMBALIAN]: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan sistem database saat memproses pengembalian buku.');
        }
    }
}
