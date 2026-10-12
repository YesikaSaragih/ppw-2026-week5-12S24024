<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dapat_menampilkan_halaman_dashboard_dengan_statistik_akurat(): void
    {
        $kategori = Kategori::factory()->create(['nama_kategori' => 'Teknologi Informasi']);

        Buku::factory()->create([
            'judul' => 'Buku Pemrograman Web',
            'kategori_id' => $kategori->id,
            'stok' => 10,
        ]);

        Buku::factory()->create([
            'judul' => 'Buku Basis Data',
            'kategori_id' => $kategori->id,
            'stok' => 0,
        ]);

        $response = $this->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Dashboard Perpustakaan');
        $response->assertSee('Buku Pemrograman Web');
        $response->assertSee('Buku Basis Data');
        $response->assertSee('Teknologi Informasi');
    }
}
