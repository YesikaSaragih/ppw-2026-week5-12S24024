<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BukuCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_dapat_menampilkan_halaman_index_buku(): void
    {
        $kategori = Kategori::factory()->create(['nama_kategori' => 'Teknologi Informasi']);
        $buku = Buku::factory()->create([
            'judul' => 'Pemrograman Laravel Lanjut',
            'kategori_id' => $kategori->id,
        ]);

        $response = $this->get(route('buku.index'));

        $response->assertStatus(200);
        $response->assertSee('Manajemen Buku');
        $response->assertSee('Pemrograman Laravel Lanjut');
        $response->assertSee('Teknologi Informasi');
    }

    public function test_pencarian_buku_berdasarkan_judul(): void
    {
        $kategori = Kategori::factory()->create();
        Buku::factory()->create([
            'judul' => 'Algoritma Pemrograman C++',
            'kategori_id' => $kategori->id,
        ]);
        Buku::factory()->create([
            'judul' => 'Desain Pola Arsitektur',
            'kategori_id' => $kategori->id,
        ]);

        $response = $this->get(route('buku.index', ['search' => 'Algoritma']));

        $response->assertStatus(200);
        $response->assertSee('Algoritma Pemrograman C++');
        $response->assertDontSee('Desain Pola Arsitektur');
    }

    public function test_filter_buku_berdasarkan_kategori_dan_stok(): void
    {
        $kategori1 = Kategori::factory()->create(['nama_kategori' => 'Kategori Khusus A']);
        $kategori2 = Kategori::factory()->create(['nama_kategori' => 'Kategori Khusus B']);

        Buku::factory()->create([
            'judul' => 'Buku Kategori A Tersedia',
            'kategori_id' => $kategori1->id,
            'stok' => 15,
        ]);
        Buku::factory()->create([
            'judul' => 'Buku Kategori B Habis',
            'kategori_id' => $kategori2->id,
            'stok' => 0,
        ]);

        // Filter kategori A
        $responseKat = $this->get(route('buku.index', ['kategori_id' => $kategori1->id]));
        $responseKat->assertStatus(200);
        $responseKat->assertSee('Buku Kategori A Tersedia');
        $responseKat->assertDontSee('Buku Kategori B Habis');

        // Filter stok habis
        $responseStok = $this->get(route('buku.index', ['stok_status' => 'habis']));
        $responseStok->assertStatus(200);
        $responseStok->assertSee('Buku Kategori B Habis');
        $responseStok->assertDontSee('Buku Kategori A Tersedia');
    }

    public function test_dapat_menampilkan_halaman_tambah_buku(): void
    {
        $response = $this->get(route('buku.create'));

        $response->assertStatus(200);
        $response->assertSee('Tambah Buku Baru');
    }

    public function test_dapat_menyimpan_buku_baru_dengan_relasi_kategori(): void
    {
        $kategori = Kategori::factory()->create();

        $data = [
            'isbn' => '978-602-9999-01-1',
            'judul' => 'Buku Uji Coba Praktikum PPW',
            'penulis' => 'Penulis Praktikum',
            'penerbit' => 'Del Publishing',
            'tahun_terbit' => 2024,
            'kategori_id' => $kategori->id,
            'stok' => 15,
            'sinopsis' => 'Sinopsis pengujian lengkap.',
        ];

        $response = $this->post(route('buku.store'), $data);

        $response->assertRedirect(route('buku.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('bukus', [
            'isbn' => '978-602-9999-01-1',
            'judul' => 'Buku Uji Coba Praktikum PPW',
            'stok' => 15,
            'kategori_id' => $kategori->id,
        ]);
    }

    public function test_validasi_isbn_duplikat_ditolak(): void
    {
        $kategori = Kategori::factory()->create();
        Buku::factory()->create([
            'isbn' => '978-602-DUPLIKAT-1',
            'kategori_id' => $kategori->id,
        ]);

        $response = $this->post(route('buku.store'), [
            'isbn' => '978-602-DUPLIKAT-1',
            'judul' => 'Judul Buku Lain',
            'penulis' => 'Penulis Lain',
            'penerbit' => 'Penerbit Lain',
            'tahun_terbit' => 2023,
            'kategori_id' => $kategori->id,
            'stok' => 5,
        ]);

        $response->assertSessionHasErrors(['isbn']);
    }

    public function test_validasi_judul_kurang_dari_5_karakter_ditolak(): void
    {
        $kategori = Kategori::factory()->create();

        $response = $this->post(route('buku.store'), [
            'isbn' => '978-602-TEST-002',
            'judul' => 'Buku', // Hanya 4 karakter
            'penulis' => 'Penulis',
            'penerbit' => 'Penerbit',
            'tahun_terbit' => 2024,
            'kategori_id' => $kategori->id,
            'stok' => 5,
        ]);

        $response->assertSessionHasErrors(['judul']);
    }

    public function test_validasi_stok_negatif_ditolak(): void
    {
        $kategori = Kategori::factory()->create();

        $response = $this->post(route('buku.store'), [
            'isbn' => '978-602-TEST-003',
            'judul' => 'Judul Buku Stok Negatif',
            'penulis' => 'Penulis',
            'penerbit' => 'Penerbit',
            'tahun_terbit' => 2024,
            'kategori_id' => $kategori->id,
            'stok' => -1,
        ]);

        $response->assertSessionHasErrors(['stok']);
    }

    public function test_validasi_kategori_tidak_valid_ditolak(): void
    {
        $response = $this->post(route('buku.store'), [
            'isbn' => '978-602-TEST-004',
            'judul' => 'Judul Buku Kategori Invalid',
            'penulis' => 'Penulis',
            'penerbit' => 'Penerbit',
            'tahun_terbit' => 2024,
            'kategori_id' => 99999, // ID tidak ada
            'stok' => 5,
        ]);

        $response->assertSessionHasErrors(['kategori_id']);
    }

    public function test_dapat_menampilkan_detail_buku(): void
    {
        $kategori = Kategori::factory()->create(['nama_kategori' => 'Kategori Detail']);
        $buku = Buku::factory()->create([
            'judul' => 'Buku Detail Spesifik',
            'kategori_id' => $kategori->id,
        ]);

        $response = $this->get(route('buku.show', $buku));

        $response->assertStatus(200);
        $response->assertSee('Buku Detail Spesifik');
        $response->assertSee('Kategori Detail');
    }

    public function test_dapat_memperbarui_data_buku(): void
    {
        $kategori = Kategori::factory()->create();
        $buku = Buku::factory()->create([
            'judul' => 'Judul Sebelum Update',
            'kategori_id' => $kategori->id,
        ]);

        $response = $this->put(route('buku.update', $buku), [
            'isbn' => $buku->isbn,
            'judul' => 'Judul Sesudah Update Berhasil',
            'penulis' => 'Penulis Terkini',
            'penerbit' => 'Penerbit Terkini',
            'tahun_terbit' => 2025,
            'kategori_id' => $kategori->id,
            'stok' => 20,
            'sinopsis' => 'Sinopsis baru.',
        ]);

        $response->assertRedirect(route('buku.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('bukus', [
            'id' => $buku->id,
            'judul' => 'Judul Sesudah Update Berhasil',
            'stok' => 20,
        ]);
    }

    public function test_dapat_menghapus_buku(): void
    {
        $buku = Buku::factory()->create();

        $response = $this->delete(route('buku.destroy', $buku));

        $response->assertRedirect(route('buku.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('bukus', [
            'id' => $buku->id,
        ]);
    }

    public function test_eager_loading_mencegah_n_plus_1_problem(): void
    {
        $kategori = Kategori::factory()->create();
        Buku::factory()->count(10)->create([
            'kategori_id' => $kategori->id,
        ]);

        $queries = [];
        DB::listen(function ($query) use (&$queries) {
            $queries[] = $query->sql;
        });

        $response = $this->get(route('buku.index'));
        $response->assertStatus(200);

        // Dengan eager loading with('kategori'), total query kueri data sangat efisien (<= 4 query)
        $this->assertLessThanOrEqual(4, count($queries), 'Jumlah query melebihi batas toleransi eager loading (N+1 terdeteksi).');
    }
}
