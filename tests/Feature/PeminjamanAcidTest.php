<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeminjamanAcidTest extends TestCase
{
    use RefreshDatabase;

    protected User $librarian;
    protected Kategori $kategori;

    protected function setUp(): void
    {
        parent::setUp();
        $this->librarian = User::factory()->create([
            'email' => 'pustakawan@del.ac.id',
        ]);
        $this->kategori = Kategori::factory()->create([
            'kode_kategori' => 'KAT-RPL',
            'nama_kategori' => 'Rekayasa Perangkat Lunak',
        ]);
    }

    public function test_guest_dialihkan_ke_login_saat_mengakses_sirkulasi(): void
    {
        $response = $this->get(route('peminjaman.index'));
        $response->assertRedirect(route('login'));

        $createResponse = $this->get(route('peminjaman.create'));
        $createResponse->assertRedirect(route('login'));
    }

    public function test_transaksi_peminjaman_berhasil_dan_mengurangi_stok_secara_atomik(): void
    {
        $this->actingAs($this->librarian);

        $buku = Buku::factory()->create([
            'kategori_id' => $this->kategori->id,
            'stok' => 5,
        ]);

        $payload = [
            'buku_id' => $buku->id,
            'nim_peminjam' => '12S24001',
            'nama_peminjam' => 'Jonathan Situmorang',
            'tanggal_pinjam' => '2026-10-17',
            'tanggal_jatuh_tempo' => '2026-10-24',
        ];

        $response = $this->post(route('peminjaman.store'), $payload);

        $response->assertRedirect(route('peminjaman.index'));
        $response->assertSessionHas('success');

        // Pastikan record transaksi peminjaman tersimpan
        $this->assertDatabaseHas('peminjamans', [
            'buku_id' => $buku->id,
            'nim_peminjam' => '12S24001',
            'nama_peminjam' => 'Jonathan Situmorang',
            'status' => 'dipinjam',
        ]);

        // Verifikasi stok buku berkurang secara atomik (5 - 1 = 4)
        $this->assertEquals(4, $buku->fresh()->stok);

        // Verifikasi session borrower tersimpan
        $this->assertEquals('12S24001', session('last_borrower_nim'));
    }

    public function test_transaksi_peminjaman_ditolak_dan_dirollback_jika_stok_buku_nol(): void
    {
        $this->actingAs($this->librarian);

        $buku = Buku::factory()->create([
            'kategori_id' => $this->kategori->id,
            'stok' => 0,
        ]);

        $payload = [
            'buku_id' => $buku->id,
            'nim_peminjam' => '12S24002',
            'nama_peminjam' => 'Maria Simanjuntak',
            'tanggal_pinjam' => '2026-10-17',
            'tanggal_jatuh_tempo' => '2026-10-24',
        ];

        $response = $this->post(route('peminjaman.store'), $payload);

        $response->assertSessionHas('error');

        // Pastikan tidak ada transaksi yang tersimpan (Rollback Atomik)
        $this->assertDatabaseMissing('peminjamans', [
            'buku_id' => $buku->id,
            'nim_peminjam' => '12S24002',
        ]);

        // Pastikan stok tetap 0 (tidak menjadi negatif)
        $this->assertEquals(0, $buku->fresh()->stok);
    }

    public function test_mencegah_peminjaman_ganda_oleh_nim_yang_sama_untuk_buku_yang_sama(): void
    {
        $this->actingAs($this->librarian);

        $buku = Buku::factory()->create([
            'kategori_id' => $this->kategori->id,
            'stok' => 3,
        ]);

        // Peminjaman pertama
        Peminjaman::create([
            'kode_pinjam' => 'PINJ-20261017-TEST1',
            'buku_id' => $buku->id,
            'nim_peminjam' => '12S24003',
            'nama_peminjam' => 'Daniel Hutapea',
            'tanggal_pinjam' => '2026-10-17',
            'tanggal_jatuh_tempo' => '2026-10-24',
            'status' => 'dipinjam',
        ]);
        $buku->decrement('stok'); // stok jadi 2

        // Coba pinjam lagi buku yang sama dengan NIM yang sama sebelum dikembalikan
        $payload = [
            'buku_id' => $buku->id,
            'nim_peminjam' => '12S24003',
            'nama_peminjam' => 'Daniel Hutapea',
            'tanggal_pinjam' => '2026-10-17',
            'tanggal_jatuh_tempo' => '2026-10-24',
        ];

        $response = $this->post(route('peminjaman.store'), $payload);

        $response->assertSessionHas('error');
        // Stok tetap 2
        $this->assertEquals(2, $buku->fresh()->stok);
    }

    public function test_transaksi_pengembalian_buku_mengembalikan_stok_secara_atomik(): void
    {
        $this->actingAs($this->librarian);

        $buku = Buku::factory()->create([
            'kategori_id' => $this->kategori->id,
            'stok' => 2,
        ]);

        $pinjaman = Peminjaman::create([
            'kode_pinjam' => 'PINJ-20261017-TEST2',
            'buku_id' => $buku->id,
            'nim_peminjam' => '12S24004',
            'nama_peminjam' => 'Ruth Nainggolan',
            'tanggal_pinjam' => '2026-10-10',
            'tanggal_jatuh_tempo' => '2026-10-17',
            'status' => 'dipinjam',
        ]);

        $response = $this->post(route('peminjaman.kembalikan', $pinjaman));

        $response->assertRedirect(route('peminjaman.index'));
        $response->assertSessionHas('success');

        // Status berubah menjadi dikembalikan dan tanggal_kembali terisi
        $pinjamanFresh = $pinjaman->fresh();
        $this->assertEquals('dikembalikan', $pinjamanFresh->status);
        $this->assertNotNull($pinjamanFresh->tanggal_kembali);

        // Stok bertambah kembali (2 + 1 = 3)
        $this->assertEquals(3, $buku->fresh()->stok);
    }
}
