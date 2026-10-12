<x-layout title="Manajemen Kategori">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h4 fw-bold text-dark mb-1">Manajemen Kategori</h1>
            <p class="text-muted small mb-0">Kelola klasifikasi bidang ilmu dan pengelompokan koleksi perpustakaan.</p>
        </div>
        <div>
            <a href="{{ route('kategori.create') }}" class="btn btn-del">
                <i class="bi bi-plus-lg"></i> Tambah Kategori Baru
            </a>
        </div>
    </div>

    <!-- Panel Pencarian Kategori -->
    <div class="ui-card p-3 mb-4">
        <form action="{{ route('kategori.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text"
                           class="form-control border-start-0 ps-0"
                           id="search"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari berdasarkan nama kategori atau kode...">
                </div>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-del w-100 justify-content-center">
                    Cari Kategori
                </button>
                @if (request('search'))
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary-del" title="Reset">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Kategori -->
    <div class="ui-card">
        <div class="ui-card-header">
            <div class="d-flex align-items-center gap-2">
                <span class="fw-semibold text-dark">Daftar Bidang Ilmu</span>
                <span class="badge bg-light text-secondary border">Total: {{ $kategoris->total() }}</span>
            </div>
            <div class="text-muted small">
                @if ($kategoris->total() > 0)
                    Menampilkan data {{ $kategoris->firstItem() }} &ndash; {{ $kategoris->lastItem() }}
                @endif
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-del align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 20%;">Kode Kategori</th>
                        <th style="width: 50%;">Nama Kategori</th>
                        <th style="width: 15%;" class="text-center">Jumlah Koleksi</th>
                        <th style="width: 15%;" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategoris as $kategori)
                        <tr>
                            <td>
                                <span class="badge bg-light text-secondary border font-monospace py-1 px-2" style="font-size: 0.8rem;">
                                    {{ $kategori->kode_kategori }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('kategori.show', $kategori) }}" class="fw-bold text-dark text-decoration-none">
                                    {{ $kategori->nama_kategori }}
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('kategori.show', $kategori) }}" class="badge-category">
                                    <i class="bi bi-book"></i> {{ $kategori->bukus_count }} Judul
                                </a>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('kategori.show', $kategori) }}" class="btn btn-light border" title="Lihat Detail & Buku">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-light border text-primary" title="Edit Kategori">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori \'{{ addslashes($kategori->nama_kategori) }}\'?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light border text-danger" title="Hapus Kategori">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                @if (request('search'))
                                    <div class="py-4">
                                        <i class="bi bi-search fs-1 text-muted d-block mb-2"></i>
                                        <h5 class="fw-bold text-dark">Kategori Tidak Ditemukan</h5>
                                        <p class="text-muted small mb-3">Tidak ada kategori yang cocok dengan pencarian "{{ request('search') }}".</p>
                                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary-del btn-sm">
                                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Pencarian
                                        </a>
                                    </div>
                                @else
                                    <div class="py-4">
                                        <i class="bi bi-tags fs-1 text-muted d-block mb-2"></i>
                                        <h5 class="fw-bold text-dark">Belum Ada Kategori</h5>
                                        <p class="text-muted small mb-3">Database perpustakaan belum memuat data klasifikasi kategori.</p>
                                        <a href="{{ route('kategori.create') }}" class="btn btn-del btn-sm">
                                            <i class="bi bi-plus-lg me-1"></i> Tambah Kategori Pertama
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($kategoris->hasPages())
            <div class="p-3 border-top d-flex justify-content-center">
                {{ $kategoris->links() }}
            </div>
        @endif
    </div>
</x-layout>
