<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class KategoriController extends Controller
{
    /**
     * Tampilkan daftar seluruh kategori dengan fitur pencarian dan penghitungan buku.
     */
    public function index(Request $request): View
    {
        $query = Kategori::withCount('bukus');

        // Fitur Pencarian Server-Side kategori
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('nama_kategori', 'like', "%{$search}%")
                  ->orWhere('kode_kategori', 'like', "%{$search}%");
            });
        }

        $kategoris = $query->latest()->paginate(10)->withQueryString();

        return view('kategori.index', compact('kategoris'));
    }

    /**
     * Tampilkan formulir untuk menambah kategori baru.
     */
    public function create(): View
    {
        return view('kategori.create');
    }

    /**
     * Simpan data kategori baru ke database dengan validasi server-side.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode_kategori' => [
                'required',
                'string',
                'max:10',
                'unique:kategoris,kode_kategori',
            ],
            'nama_kategori' => [
                'required',
                'string',
                'max:100',
            ],
        ], [
            'kode_kategori.required' => 'Kode kategori wajib diisi.',
            'kode_kategori.string' => 'Kode kategori harus berupa teks.',
            'kode_kategori.max' => 'Kode kategori tidak boleh melebihi 10 karakter.',
            'kode_kategori.unique' => 'Kode kategori sudah terdaftar, silakan gunakan kode unik lain.',
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.string' => 'Nama kategori harus berupa teks.',
            'nama_kategori.max' => 'Nama kategori tidak boleh melebihi 100 karakter.',
        ]);

        Kategori::create($validated);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail kategori beserta daftar buku di dalamnya.
     */
    public function show(Kategori $kategori): View
    {
        $bukus = $kategori->bukus()->latest()->paginate(10);

        return view('kategori.show', compact('kategori', 'bukus'));
    }

    /**
     * Tampilkan formulir untuk mengedit data kategori.
     */
    public function edit(Kategori $kategori): View
    {
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Perbarui data kategori di database dengan validasi server-side.
     */
    public function update(Request $request, Kategori $kategori): RedirectResponse
    {
        $validated = $request->validate([
            'kode_kategori' => [
                'required',
                'string',
                'max:10',
                Rule::unique('kategoris', 'kode_kategori')->ignore($kategori->id),
            ],
            'nama_kategori' => [
                'required',
                'string',
                'max:100',
            ],
        ], [
            'kode_kategori.required' => 'Kode kategori wajib diisi.',
            'kode_kategori.string' => 'Kode kategori harus berupa teks.',
            'kode_kategori.max' => 'Kode kategori tidak boleh melebihi 10 karakter.',
            'kode_kategori.unique' => 'Kode kategori sudah terdaftar pada kategori lain.',
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.string' => 'Nama kategori harus berupa teks.',
            'nama_kategori.max' => 'Nama kategori tidak boleh melebihi 100 karakter.',
        ]);

        $kategori->update($validated);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Data kategori berhasil diperbarui.');
    }

    /**
     * Hapus data kategori dari database dengan perlindungan integritas referensial.
     */
    public function destroy(Kategori $kategori): RedirectResponse
    {
        $jumlahBuku = $kategori->bukus()->count();

        // Validasi perlindungan data referensial
        if ($jumlahBuku > 0) {
            return back()->with('error', "Kategori '{$kategori->nama_kategori}' tidak dapat dihapus karena masih memuat {$jumlahBuku} koleksi buku aktif.");
        }

        $nama = $kategori->nama_kategori;
        $kategori->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', "Kategori '{$nama}' berhasil dihapus.");
    }
}
