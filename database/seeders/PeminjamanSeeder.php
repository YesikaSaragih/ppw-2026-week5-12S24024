<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bukus = Buku::take(5)->get();

        if ($bukus->count() < 3) {
            return;
        }

        $sampleLoans = [
            [
                'kode_pinjam' => 'PINJ-20261010-DEL01',
                'buku_id' => $bukus[0]->id,
                'nim_peminjam' => '12S24001',
                'nama_peminjam' => 'Jonathan Situmorang',
                'tanggal_pinjam' => '2026-10-10',
                'tanggal_jatuh_tempo' => '2026-10-17',
                'tanggal_kembali' => null,
                'status' => 'dipinjam',
            ],
            [
                'kode_pinjam' => 'PINJ-20261011-DEL02',
                'buku_id' => $bukus[1]->id,
                'nim_peminjam' => '12S24015',
                'nama_peminjam' => 'Maria Simanjuntak',
                'tanggal_pinjam' => '2026-10-11',
                'tanggal_jatuh_tempo' => '2026-10-18',
                'tanggal_kembali' => null,
                'status' => 'dipinjam',
            ],
            [
                'kode_pinjam' => 'PINJ-20261005-DEL03',
                'buku_id' => $bukus[2]->id,
                'nim_peminjam' => '14S23002',
                'nama_peminjam' => 'Daniel Hutapea',
                'tanggal_pinjam' => '2026-10-05',
                'tanggal_jatuh_tempo' => '2026-10-12',
                'tanggal_kembali' => '2026-10-11',
                'status' => 'dikembalikan',
            ],
            [
                'kode_pinjam' => 'PINJ-20261006-DEL04',
                'buku_id' => $bukus[0]->id,
                'nim_peminjam' => '11S22019',
                'nama_peminjam' => 'Ruth Nainggolan',
                'tanggal_pinjam' => '2026-10-06',
                'tanggal_jatuh_tempo' => '2026-10-13',
                'tanggal_kembali' => '2026-10-12',
                'status' => 'dikembalikan',
            ],
        ];

        foreach ($sampleLoans as $loan) {
            Peminjaman::firstOrCreate(
                ['kode_pinjam' => $loan['kode_pinjam']],
                $loan
            );
        }
    }
}
