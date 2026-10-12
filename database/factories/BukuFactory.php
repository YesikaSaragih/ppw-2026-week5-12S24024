<?php

namespace Database\Factories;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Buku>
 */
class BukuFactory extends Factory
{
    protected $model = Buku::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $judulPilihan = [
            'Pemrograman Web Modern dengan Laravel',
            'Struktur Data dan Algoritma Dasar',
            'Rekayasa Perangkat Lunak Berorientasi Objek',
            'Basis Data Relasional dan Perancangan Skema',
            'Pengantar Kecerdasan Buatan dan Pembelajaran Mesin',
            'Jaringan Komputer dan Komunikasi Data',
            'Keamanan Siber dan Kriptografi Terapan',
            'Desain Pola Arsitektur Perangkat Lunak Modern',
            'Sistem Informasi Manajemen Korporasi',
            'Pengembangan Antarmuka Pengguna Interaktif',
            'Analisis dan Desain Sistem Berbasis Komputer',
            'Pengantar Sains Data Menggunakan Python',
            'Cloud Computing dan Infrastruktur Skalabilitas',
            'Praktikum Pemrograman dan Pengujian Web',
            'Etika Profesi dan Kepemimpinan Teknologi Informasi',
        ];

        return [
            'isbn' => fake()->unique()->isbn13(),
            'judul' => fake()->randomElement($judulPilihan) . ' - Edisi ' . fake()->numberBetween(1, 5),
            'penulis' => fake()->name(),
            'penerbit' => fake()->randomElement([
                'Informatika Bandung',
                'Penerbit Andi',
                'Erlangga',
                'Del Press',
                'Gramedia Pustaka Utama',
                'Gava Media',
            ]),
            'tahun_terbit' => fake()->numberBetween(2015, (int) date('Y')),
            'kategori_id' => Kategori::factory(),
            'stok' => fake()->numberBetween(1, 40),
            'sinopsis' => fake()->paragraph(3),
        ];
    }
}
