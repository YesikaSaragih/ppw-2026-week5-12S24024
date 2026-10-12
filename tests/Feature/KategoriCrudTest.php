<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KategoriCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_dapat_menampilkan_halaman_index_kategori(): void
    {
        Kategori::factory()->create([
            'kode_kategori' => 'KAT01',
            'nama_kategori' => 'Teknologi Informasi',
        ]);

        $response = $this->get(route('kategori.index'));

        $response->assertStatus(200);
        $response->assertSee('Manajemen Kategori');
        $response->assertSee('KAT01');
        $response->assertSee('Teknologi Informasi');
    }

    public function test_pencarian_kategori(): void
    {
        Kategori::factory()->create([
            'kode_kategori' => 'KAT-AI',
            'nama_kategori' => 'Kecerdasan Buatan',
        ]);
        Kategori::factory()->create([
            'kode_kategori' => 'KAT-MAT',
            'nama_kategori' => 'Matematika Terapan',
        ]);

        $response = $this->get(route('kategori.index', ['search' => 'Kecerdasan']));

        $response->assertStatus(200);
        $response->assertSee('Kecerdasan Buatan');
        $response->assertDontSee('Matematika Terapan');
    }

    public function test_dapat_menampilkan_halaman_tambah_kategori(): void
    {
        $response = $this->get(route('kategori.create'));

        $response->assertStatus(200);
        $response->assertSee('Tambah Kategori');
    }

    public function test_dapat_menyimpan_kategori_baru(): void
    {
        $data = [
            'kode_kategori' => 'KAT-TEST',
            'nama_kategori' => 'Kategori Pengujian',
        ];

        $response = $this->post(route('kategori.store'), $data);

        $response->assertRedirect(route('kategori.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('kategoris', [
            'kode_kategori' => 'KAT-TEST',
            'nama_kategori' => 'Kategori Pengujian',
        ]);
    }

    public function test_validasi_kode_kategori_harus_unik(): void
    {
        Kategori::factory()->create([
            'kode_kategori' => 'KAT-UNIK',
            'nama_kategori' => 'Kategori Asli',
        ]);

        $response = $this->post(route('kategori.store'), [
            'kode_kategori' => 'KAT-UNIK',
            'nama_kategori' => 'Kategori Duplikat',
        ]);

        $response->assertSessionHasErrors(['kode_kategori']);
    }

    public function test_validasi_input_wajib_kategori(): void
    {
        $response = $this->post(route('kategori.store'), [
            'kode_kategori' => '',
            'nama_kategori' => '',
        ]);

        $response->assertSessionHasErrors(['kode_kategori', 'nama_kategori']);
    }

    public function test_dapat_menampilkan_detail_kategori(): void
    {
        $kategori = Kategori::factory()->create([
            'kode_kategori' => 'KAT-DET',
            'nama_kategori' => 'Detail Kategori Test',
        ]);

        $response = $this->get(route('kategori.show', $kategori));

        $response->assertStatus(200);
        $response->assertSee('KAT-DET');
        $response->assertSee('Detail Kategori Test');
    }

    public function test_dapat_menampilkan_form_edit_kategori(): void
    {
        $kategori = Kategori::factory()->create();

        $response = $this->get(route('kategori.edit', $kategori));

        $response->assertStatus(200);
        $response->assertSee('Edit Kategori');
    }

    public function test_dapat_memperbarui_kategori(): void
    {
        $kategori = Kategori::factory()->create([
            'kode_kategori' => 'KAT-LAMA',
            'nama_kategori' => 'Nama Lama',
        ]);

        $response = $this->put(route('kategori.update', $kategori), [
            'kode_kategori' => 'KAT-BARU',
            'nama_kategori' => 'Nama Baru',
        ]);

        $response->assertRedirect(route('kategori.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('kategoris', [
            'id' => $kategori->id,
            'kode_kategori' => 'KAT-BARU',
            'nama_kategori' => 'Nama Baru',
        ]);
    }

    public function test_dapat_menghapus_kategori_tanpa_buku(): void
    {
        $kategori = Kategori::factory()->create();

        $response = $this->delete(route('kategori.destroy', $kategori));

        $response->assertRedirect(route('kategori.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('kategoris', [
            'id' => $kategori->id,
        ]);
    }

    public function test_kategori_dengan_buku_ditolak_penghapusannya(): void
    {
        $kategori = Kategori::factory()->create();
        Buku::factory()->create(['kategori_id' => $kategori->id]);

        $response = $this->from(route('kategori.index'))->delete(route('kategori.destroy', $kategori));

        $response->assertRedirect(route('kategori.index'));
        $response->assertSessionHas('error');

        $this->assertDatabaseHas('kategoris', [
            'id' => $kategori->id,
        ]);
    }
}
