<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Kategori>
 */
class KategoriFactory extends Factory
{
    protected $model = Kategori::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_kategori' => strtoupper(fake()->unique()->bothify('KAT##')),
            'nama_kategori' => fake()->randomElement([
                'Pemrograman & Rekayasa Perangkat Lunak',
                'Kecerdasan Buatan & Sains Data',
                'Jaringan Komputer & Keamanan Siber',
                'Sistem Informasi & Basis Data',
                'Matematika Diskrit & Komputasi',
                'Desain UI/UX & Interaksi Manusia Komputer',
                'Pengembangan Diri & Profesionalisme',
            ]),
        ];
    }
}
