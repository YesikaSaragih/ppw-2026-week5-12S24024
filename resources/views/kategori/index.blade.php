<x-layout title="Daftar Kategori Buku">
    <!-- Header Halaman -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-2 py-1 rounded-pill mb-1" style="background-color: var(--del-soft-blue); border: 1px solid var(--del-border-blue);">
                <i class="bi bi-diagram-3-fill text-primary" style="font-size: 0.75rem;"></i>
                <span class="small fw-bold text-primary" style="font-size: 0.725rem;">Pengelompokan Buku</span>
            </div>
            <h1 class="h4 fw-bold text-dark mb-1">Manajemen Kategori</h1>
            <p class="text-muted small mb-0">Kelola kelompok bidang ilmu untuk merapikan dan memudahkan pencarian buku di perpustakaan Del.</p>
        </div>
        <div>
            <a href="{{ route('kategori.create') }}" class="btn btn-del">
                <i class="bi bi-plus-lg"></i> Tambah Kategori Baru
            </a>
        </div>
    </div>

    <!-- Panel Pencarian Kategori -->
    <div class="ui-card p-3 mb-4" style="background: linear-gradient(180deg, #FFFFFF 0%, var(--del-lightest-blue) 100%);">
        <form action="{{ route('kategori.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted">
                        <i class="bi bi-search text-primary"></i>
                    </span>
                    <input type="text"
                           class="form-control border-start-0 ps-0"
                           id="search"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari kategori berdasarkan nama bidang atau kode kategori...">
                </div>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-del w-100 justify-content-center">
                    <i class="bi bi-search"></i> Cari
                </button>
                @if (request('search'))
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary-del" title="Hapus Pencarian">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Kategori -->
    <div class="ui-card">
        <div class="ui-card-header">
            <div class="d-flex align-items-center gap-2">
                <span class="ui-card-title">
                    <i class="bi bi-tags text-primary"></i> Daftar Kategori Bidang Ilmu
                </span>
                <span class="badge" style="background-color: var(--del-soft-blue); color: var(--del-primary); border: 1px solid var(--del-border-blue); font-weight: 700;">
                    Total: {{ $kategoris->total() }}
                </span>
            </div>
            <div class="text-muted small">
                @if ($kategoris->total() > 0)
                    Menampilkan data <strong>{{ $kategoris->firstItem() }} &ndash; {{ $kategoris->lastItem() }}</strong> dari <strong>{{ $kategoris->total() }}</strong> kategori
                @endif
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-del align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 20%;">Kode Kategori</th>
                        <th style="width: 50%;">Nama Kategori</th>
                        <th style="width: 15%;" class="text-center">Jumlah Buku</th>
                        <th style="width: 15%;" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategoris as $kategori)
                        <tr>
                            <td>
                                <span class="badge font-monospace py-1 px-2" style="background-color: var(--del-lightest-blue); color: var(--del-primary); border: 1px solid var(--del-border-blue); font-size: 0.825rem;">
                                    {{ $kategori->kode_kategori }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('kategori.show', $kategori) }}" class="fw-bold text-dark text-decoration-none">
                                    {{ $kategori->nama_kategori }}
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('kategori.show', $kategori) }}" class="badge-category" title="Lihat koleksi buku di kategori ini">
                                    <i class="bi bi-journal-text"></i> {{ $kategori->bukus_count }} Judul
                                </a>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('kategori.show', $kategori) }}" class="btn btn-light border py-1 px-2" title="Lihat Buku Terdaftar">
                                        <i class="bi bi-eye text-primary"></i>
                                    </a>
                                    <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-light border py-1 px-2" title="Ubah Nama Kategori">
                                        <i class="bi bi-pencil" style="color: #0284C7;"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-light border text-danger py-1 px-2"
                                            title="Hapus Kategori"
                                            onclick="confirmDelete('{{ route('kategori.destroy', $kategori) }}', '{{ addslashes($kategori->nama_kategori) }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                @if (request('search'))
                                    <div class="py-4">
                                        <div class="p-3 d-inline-flex rounded-circle mb-3" style="background-color: var(--del-soft-blue); color: var(--del-primary);">
                                            <i class="bi bi-search fs-2"></i>
                                        </div>
                                        <h5 class="fw-bold text-dark">Kategori Tidak Ditemukan</h5>
                                        <p class="text-muted small mb-3">Tidak ada kategori yang cocok dengan pencarian "{{ request('search') }}".</p>
                                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary-del btn-sm">
                                            <i class="bi bi-arrow-counterclockwise me-1"></i> Tampilkan Semua Kategori
                                        </a>
                                    </div>
                                @else
                                    <div class="py-4">
                                        <div class="p-3 d-inline-flex rounded-circle mb-3" style="background-color: var(--del-soft-blue); color: var(--del-primary);">
                                            <i class="bi bi-tags fs-2"></i>
                                        </div>
                                        <h5 class="fw-bold text-dark">Belum Ada Kategori</h5>
                                        <p class="text-muted small mb-3">Tambahkan kelompok kategori buku pertama untuk perpustakaan.</p>
                                        <a href="{{ route('kategori.create') }}" class="btn btn-del btn-sm">
                                            <i class="bi bi-plus-lg me-1"></i> Tambah Kategori Baru
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($kategoris->hasPages())
            <div class="p-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="small text-muted">
                    Halaman {{ $kategoris->currentPage() }} dari {{ $kategoris->lastPage() }}
                </div>
                <div>
                    {{ $kategoris->links() }}
                </div>
            </div>
        @endif
    </div>
</x-layout>
