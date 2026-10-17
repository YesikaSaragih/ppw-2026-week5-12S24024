<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class QueryBuilderAnalyticsTest extends TestCase
{
    use RefreshDatabase;

    public function test_analitik_dashboard_menggunakan_fluent_query_builder_akurat(): void
    {
        $kategori = Kategori::factory()->create(['nama_kategori' => 'Sistem Informasi']);

        $buku1 = Buku::factory()->create([
            'kategori_id' => $kategori->id,
            'stok' => 10,
        ]);
        $buku2 = Buku::factory()->create([
            'kategori_id' => $kategori->id,
            'stok' => 5,
        ]);

        // 1 pinjaman aktif, 1 dikembalikan
        Peminjaman::create([
            'kode_pinjam' => 'PINJ-20261017-001',
            'buku_id' => $buku1->id,
            'nim_peminjam' => '12S24001',
            'nama_peminjam' => 'Mhs 1',
            'tanggal_pinjam' => '2026-10-10',
            'tanggal_jatuh_tempo' => '2026-10-17',
            'status' => 'dipinjam',
        ]);

        Peminjaman::create([
            'kode_pinjam' => 'PINJ-20261017-002',
            'buku_id' => $buku2->id,
            'nim_peminjam' => '12S24002',
            'nama_peminjam' => 'Mhs 2',
            'tanggal_pinjam' => '2026-10-01',
            'tanggal_jatuh_tempo' => '2026-10-08',
            'tanggal_kembali' => '2026-10-07',
            'status' => 'dikembalikan',
        ]);

        // Verifikasi hasil Fluent Query Builder DB::table murni
        $totalJudul = DB::table('bukus')->count();
        $totalStok = (int) DB::table('bukus')->sum('stok');
        $totalDipinjam = DB::table('peminjamans')->where('status', 'dipinjam')->count();
        $totalDikembalikan = DB::table('peminjamans')->where('status', 'dikembalikan')->count();

        $this->assertEquals(2, $totalJudul);
        $this->assertEquals(15, $totalStok);
        $this->assertEquals(1, $totalDipinjam);
        $this->assertEquals(1, $totalDikembalikan);

        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Total Judul Buku');
        $response->assertSee('Total Stok Buku');
        $response->assertSee('Sedang Dipinjam');
        $response->assertSee('Telah Dikembalikan');
    }

    public function test_katalog_buku_memuat_with_count_peminjamans(): void
    {
        $kategori = Kategori::factory()->create();
        $buku = Buku::factory()->create([
            'kategori_id' => $kategori->id,
            'stok' => 8,
        ]);

        Peminjaman::create([
            'kode_pinjam' => 'PINJ-COUNT-1',
            'buku_id' => $buku->id,
            'nim_peminjam' => '12S24010',
            'nama_peminjam' => 'Mhs Count',
            'tanggal_pinjam' => '2026-10-10',
            'tanggal_jatuh_tempo' => '2026-10-17',
            'status' => 'dipinjam',
        ]);

        $bukuWithCount = Buku::withCount('peminjamans')->find($buku->id);
        $this->assertEquals(1, $bukuWithCount->peminjamans_count);

        $response = $this->get(route('buku.index'));
        $response->assertStatus(200);
        $response->assertSee('1x pinjam');
    }

    public function test_filter_dinamis_when_dan_penyimpanan_session_pencarian(): void
    {
        $kategori = Kategori::factory()->create(['nama_kategori' => 'Kecerdasan Buatan']);
        $bukuA = Buku::factory()->create([
            'judul' => 'Machine Learning Lanjut',
            'kategori_id' => $kategori->id,
            'stok' => 10,
        ]);
        $bukuB = Buku::factory()->create([
            'judul' => 'Pemrograman Web Python',
            'kategori_id' => $kategori->id,
            'stok' => 2,
        ]);

        // Filter pencarian
        $response = $this->get(route('buku.index', ['search' => 'Machine Learning']));
        $response->assertStatus(200);
        $response->assertSee('Machine Learning Lanjut');
        $response->assertDontSee('Pemrograman Web Python');

        // Pastikan session last_buku_search tersimpan
        $this->assertEquals('Machine Learning', session('last_buku_search'));

        // Filter stok status
        $responseMenipis = $this->get(route('buku.index', ['stok_status' => 'menipis']));
        $responseMenipis->assertStatus(200);
        $responseMenipis->assertSee('Pemrograman Web Python');
        $responseMenipis->assertDontSee('Machine Learning Lanjut');
    }
}
