<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BukuController extends Controller
{
    /**
     * Tampilkan daftar seluruh buku (menggunakan Eager Loading & Pagination).
     */
    public function index(): View
    {
        // Eager Loading relasi 'kategori' untuk mencegah masalah N+1 Query
        $bukus = Buku::with('kategori')->latest()->paginate(10);

        return view('buku.index', compact('bukus'));
    }

    /**
     * Tampilkan formulir untuk menambah buku baru.
     */
    public function create(): View
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('buku.create', compact('kategoris'));
    }

    /**
     * Simpan data buku baru ke database dengan validasi server-side ketat.
     */
    public function store(Request $request): RedirectResponse
    {
        $tahunSekarang = (int) date('Y');

        $validated = $request->validate([
            'isbn' => [
                'required',
                'string',
                'unique:bukus,isbn',
            ],
            'judul' => [
                'required',
                'string',
                'min:5',
                'max:200',
            ],
            'penulis' => [
                'required',
                'string',
                'max:150',
            ],
            'penerbit' => [
                'required',
                'string',
                'max:150',
            ],
            'tahun_terbit' => [
                'required',
                'integer',
                'min:1900',
                "max:{$tahunSekarang}",
            ],
            'kategori_id' => [
                'required',
                'exists:kategoris,id',
            ],
            'stok' => [
                'required',
                'integer',
                'min:0',
            ],
            'sinopsis' => [
                'nullable',
                'string',
            ],
        ], [
            'isbn.required' => 'Nomor ISBN buku wajib diisi.',
            'isbn.string' => 'Nomor ISBN harus berupa teks.',
            'isbn.unique' => 'Nomor ISBN sudah terdaftar, gunakan nomor ISBN unik.',
            'judul.required' => 'Judul buku wajib diisi.',
            'judul.string' => 'Judul buku harus berupa teks.',
            'judul.min' => 'Judul buku minimal harus 5 karakter.',
            'judul.max' => 'Judul buku maksimal 200 karakter.',
            'penulis.required' => 'Nama penulis wajib diisi.',
            'penulis.string' => 'Nama penulis harus berupa teks.',
            'penulis.max' => 'Nama penulis maksimal 150 karakter.',
            'penerbit.required' => 'Nama penerbit wajib diisi.',
            'penerbit.string' => 'Nama penerbit harus berupa teks.',
            'penerbit.max' => 'Nama penerbit maksimal 150 karakter.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.integer' => 'Tahun terbit harus berupa angka.',
            'tahun_terbit.min' => 'Tahun terbit tidak boleh lebih lama dari tahun 1900.',
            'tahun_terbit.max' => "Tahun terbit tidak boleh melebihi tahun sekarang ({$tahunSekarang}).",
            'kategori_id.required' => 'Kategori buku wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid atau tidak terdaftar.',
            'stok.required' => 'Jumlah stok buku wajib diisi.',
            'stok.integer' => 'Jumlah stok buku harus berupa bilangan bulat.',
            'stok.min' => 'Jumlah stok buku tidak boleh kurang dari 0 (tidak boleh negatif).',
            'sinopsis.string' => 'Sinopsis buku harus berupa teks.',
        ]);

        Buku::create($validated);

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku baru berhasil ditambahkan ke perpustakaan.');
    }

    /**
     * Tampilkan rincian detail buku.
     */
    public function show(Buku $buku): View
    {
        $buku->load('kategori');

        return view('buku.show', compact('buku'));
    }

    /**
     * Tampilkan formulir untuk mengedit data buku.
     */
    public function edit(Buku $buku): View
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('buku.edit', compact('buku', 'kategoris'));
    }

    /**
     * Perbarui data buku di database dengan validasi server-side.
     */
    public function update(Request $request, Buku $buku): RedirectResponse
    {
        $tahunSekarang = (int) date('Y');

        $validated = $request->validate([
            'isbn' => [
                'required',
                'string',
                Rule::unique('bukus', 'isbn')->ignore($buku->id),
            ],
            'judul' => [
                'required',
                'string',
                'min:5',
                'max:200',
            ],
            'penulis' => [
                'required',
                'string',
                'max:150',
            ],
            'penerbit' => [
                'required',
                'string',
                'max:150',
            ],
            'tahun_terbit' => [
                'required',
                'integer',
                'min:1900',
                "max:{$tahunSekarang}",
            ],
            'kategori_id' => [
                'required',
                'exists:kategoris,id',
            ],
            'stok' => [
                'required',
                'integer',
                'min:0',
            ],
            'sinopsis' => [
                'nullable',
                'string',
            ],
        ], [
            'isbn.required' => 'Nomor ISBN buku wajib diisi.',
            'isbn.string' => 'Nomor ISBN harus berupa teks.',
            'isbn.unique' => 'Nomor ISBN sudah terdaftar pada buku lain.',
            'judul.required' => 'Judul buku wajib diisi.',
            'judul.string' => 'Judul buku harus berupa teks.',
            'judul.min' => 'Judul buku minimal harus 5 karakter.',
            'judul.max' => 'Judul buku maksimal 200 karakter.',
            'penulis.required' => 'Nama penulis wajib diisi.',
            'penulis.string' => 'Nama penulis harus berupa teks.',
            'penulis.max' => 'Nama penulis maksimal 150 karakter.',
            'penerbit.required' => 'Nama penerbit wajib diisi.',
            'penerbit.string' => 'Nama penerbit harus berupa teks.',
            'penerbit.max' => 'Nama penerbit maksimal 150 karakter.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.integer' => 'Tahun terbit harus berupa angka.',
            'tahun_terbit.min' => 'Tahun terbit tidak boleh lebih lama dari tahun 1900.',
            'tahun_terbit.max' => "Tahun terbit tidak boleh melebihi tahun sekarang ({$tahunSekarang}).",
            'kategori_id.required' => 'Kategori buku wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid atau tidak terdaftar.',
            'stok.required' => 'Jumlah stok buku wajib diisi.',
            'stok.integer' => 'Jumlah stok buku harus berupa bilangan bulat.',
            'stok.min' => 'Jumlah stok buku tidak boleh kurang dari 0 (tidak boleh negatif).',
            'sinopsis.string' => 'Sinopsis buku harus berupa teks.',
        ]);

        $buku->update($validated);

        return redirect()
            ->route('buku.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    /**
     * Hapus data buku dari database.
     */
    public function destroy(Buku $buku): RedirectResponse
    {
        $judul = $buku->judul;
        $buku->delete();

        return redirect()
            ->route('buku.index')
            ->with('success', "Buku '{$judul}' berhasil dihapus dari sistem.");
    }
}
