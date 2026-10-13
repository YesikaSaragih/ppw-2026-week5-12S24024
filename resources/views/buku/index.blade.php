<x-layout title="Manajemen Koleksi Buku">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-2 py-1 rounded-pill mb-1" style="background-color: var(--del-soft-blue); border: 1px solid var(--del-border-blue);">
                <i class="bi bi-journals text-primary" style="font-size: 0.75rem;"></i>
                <span class="small fw-bold text-primary" style="font-size: 0.725rem;">Katalog &amp; Inventaris Pustaka</span>
            </div>
            <h1 class="h4 fw-bold text-dark mb-1">Manajemen Buku</h1>
            <p class="text-muted small mb-0">Kelola katalog, klasifikasi ilmu, dan ketersediaan stok fisik perpustakaan Institut Teknologi Del.</p>
        </div>
        <div>
            <a href="{{ route('buku.create') }}" class="btn btn-del">
                <i class="bi bi-plus-lg"></i> Tambah Buku Baru
            </a>
        </div>
    </div>

    <!-- Panel Pencarian & Filter Server-Side (Modern Soft Blue Card) -->
    <div class="ui-card p-3 mb-4" style="background: linear-gradient(180deg, #FFFFFF 0%, var(--del-lightest-blue) 100%);">
        <form action="{{ route('buku.index') }}" method="GET" class="row g-2 align-items-end">
            <!-- Input Kata Kunci -->
            <div class="col-md-5">
                <label for="search" class="form-label">
                    <i class="bi bi-search text-primary me-1"></i> Cari Berdasarkan Kata Kunci
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted">
                        <i class="bi bi-search text-primary"></i>
                    </span>
                    <input type="text"
                           class="form-control border-start-0 ps-0"
                           id="search"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Ketik judul buku, nomor ISBN, atau nama penulis...">
                </div>
            </div>

            <!-- Filter Kategori -->
            <div class="col-md-3">
                <label for="kategori_id" class="form-label">
                    <i class="bi bi-tags text-primary me-1"></i> Filter Kategori
                </label>
                <select class="form-select" id="kategori_id" name="kategori_id">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Stok -->
            <div class="col-md-2">
                <label for="stok_status" class="form-label">
                    <i class="bi bi-layers text-primary me-1"></i> Status Stok
                </label>
                <select class="form-select" id="stok_status" name="stok_status">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('stok_status') == 'tersedia' ? 'selected' : '' }}>Tersedia (&gt; 5)</option>
                    <option value="menipis" {{ request('stok_status') == 'menipis' ? 'selected' : '' }}>Menipis (1-5)</option>
                    <option value="habis" {{ request('stok_status') == 'habis' ? 'selected' : '' }}>Habis (0)</option>
                </select>
            </div>

            <!-- Tombol Aksi Filter -->
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-del w-100 justify-content-center">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                @if (request()->hasAny(['search', 'kategori_id', 'stok_status']) && (request('search') || request('kategori_id') || request('stok_status')))
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary-del" title="Reset Filter">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Buku -->
    <div class="ui-card">
        <div class="ui-card-header">
            <div class="d-flex align-items-center gap-2">
                <span class="ui-card-title">
                    <i class="bi bi-collection text-primary"></i> Daftar Koleksi Buku
                </span>
                <span class="badge" style="background-color: var(--del-soft-blue); color: var(--del-primary); border: 1px solid var(--del-border-blue); font-weight: 700;">
                    Total: {{ $bukus->total() }}
                </span>
            </div>
            <div class="text-muted small">
                @if ($bukus->total() > 0)
                    Menampilkan data <strong>{{ $bukus->firstItem() }} &ndash; {{ $bukus->lastItem() }}</strong> dari <strong>{{ $bukus->total() }}</strong>
                @endif
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-del align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 14%;">ISBN</th>
                        <th style="width: 32%;">Judul &amp; Penulis</th>
                        <th style="width: 20%;">Kategori</th>
                        <th style="width: 8%;" class="text-center">Tahun</th>
                        <th style="width: 12%;" class="text-center">Stok</th>
                        <th style="width: 14%;" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bukus as $buku)
                        <tr>
                            <td>
                                <span class="badge bg-light text-secondary border font-monospace py-1 px-2" style="font-size: 0.775rem;">
                                    {{ $buku->isbn }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('buku.show', $buku) }}" class="fw-bold text-dark text-decoration-none" style="transition: color 0.15s ease;">
                                    {{ $buku->judul }}
                                </a>
                                <div class="small text-muted mt-1">
                                    <i class="bi bi-person me-1"></i>{{ $buku->penulis }}
                                </div>
                            </td>
                            <td>
                                @if ($buku->kategori)
                                    <a href="{{ route('kategori.show', $buku->kategori) }}" class="badge-category">
                                        <i class="bi bi-tag-fill"></i> {{ $buku->kategori->nama_kategori }}
                                    </a>
                                @else
                                    <span class="text-muted small">&mdash;</span>
                                @endif
                            </td>
                            <td class="text-center text-secondary small">
                                {{ $buku->tahun_terbit }}
                            </td>
                            <td class="text-center">
                                @if ($buku->stok > 5)
                                    <span class="badge-status badge-status-tersedia">
                                        <i class="bi bi-check-circle"></i> {{ $buku->stok }} eks
                                    </span>
                                @elseif ($buku->stok > 0)
                                    <span class="badge-status badge-status-menipis">
                                        <i class="bi bi-exclamation-triangle"></i> {{ $buku->stok }} eks
                                    </span>
                                @else
                                    <span class="badge-status badge-status-habis">
                                        <i class="bi bi-x-circle"></i> Habis
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('buku.show', $buku) }}" class="btn btn-light border py-1 px-2" title="Lihat Rincian">
                                        <i class="bi bi-eye text-primary"></i>
                                    </a>
                                    <a href="{{ route('buku.edit', $buku) }}" class="btn btn-light border py-1 px-2" title="Edit Data">
                                        <i class="bi bi-pencil" style="color: #0284C7;"></i>
                                    </a>
                                    <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ addslashes($buku->judul) }}\'?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light border text-danger py-1 px-2" title="Hapus Buku">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                @if (request()->hasAny(['search', 'kategori_id', 'stok_status']) && (request('search') || request('kategori_id') || request('stok_status')))
                                    <div class="py-4">
                                        <div class="p-3 d-inline-flex rounded-circle mb-3" style="background-color: var(--del-soft-blue); color: var(--del-primary);">
                                            <i class="bi bi-search fs-2"></i>
                                        </div>
                                        <h5 class="fw-bold text-dark">Pencarian Tidak Ditemukan</h5>
                                        <p class="text-muted small mb-3">Tidak ada buku yang cocok dengan kriteria pencarian dan filter yang Anda pilih.</p>
                                        <a href="{{ route('buku.index') }}" class="btn btn-secondary-del btn-sm">
                                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filter Pencarian
                                        </a>
                                    </div>
                                @else
                                    <div class="py-4">
                                        <div class="p-3 d-inline-flex rounded-circle mb-3" style="background-color: var(--del-soft-blue); color: var(--del-primary);">
                                            <i class="bi bi-inbox fs-2"></i>
                                        </div>
                                        <h5 class="fw-bold text-dark">Belum Ada Koleksi Buku</h5>
                                        <p class="text-muted small mb-3">Database perpustakaan saat ini belum memuat data buku.</p>
                                        <a href="{{ route('buku.create') }}" class="btn btn-del btn-sm">
                                            <i class="bi bi-plus-lg me-1"></i> Tambah Buku Pertama
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($bukus->hasPages())
            <div class="p-3 border-top d-flex justify-content-center">
                {{ $bukus->links() }}
            </div>
        @endif
    </div>
</x-layout>
