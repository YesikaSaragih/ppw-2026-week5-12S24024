<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'kode_kategori' => 'KAT-RPL',
                'nama_kategori' => 'Rekayasa Perangkat Lunak & Web',
            ],
            [
                'kode_kategori' => 'KAT-SI',
                'nama_kategori' => 'Sistem Informasi & Manajemen Data',
            ],
            [
                'kode_kategori' => 'KAT-AI',
                'nama_kategori' => 'Kecerdasan Buatan & Sains Data',
            ],
            [
                'kode_kategori' => 'KAT-SEC',
                'nama_kategori' => 'Jaringan Komputer & Keamanan Siber',
            ],
            [
                'kode_kategori' => 'KAT-MAT',
                'nama_kategori' => 'Matematika Komputasi & Algoritma',
            ],
            [
                'kode_kategori' => 'KAT-DEL',
                'nama_kategori' => 'Karakter Del & Kepemimpinan',
            ],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::firstOrCreate(
                ['kode_kategori' => $kategori['kode_kategori']],
                ['nama_kategori' => $kategori['nama_kategori']]
            );
        }
    }
}
