<x-layout title="Manajemen Koleksi Buku">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h4 fw-bold text-dark mb-1">Manajemen Buku</h1>
            <p class="text-muted small mb-0">Kelola katalog, klasifikasi, dan ketersediaan stok fisik perpustakaan.</p>
        </div>
        <div>
            <a href="{{ route('buku.create') }}" class="btn btn-del">
                <i class="bi bi-plus-lg"></i> Tambah Buku Baru
            </a>
        </div>
    </div>

    <!-- Panel Pencarian & Filter Server-Side -->
    <div class="ui-card p-3 mb-4">
        <form action="{{ route('buku.index') }}" method="GET" class="row g-2 align-items-end">
            <!-- Input Kata Kunci -->
            <div class="col-md-5">
                <label for="search" class="form-label">Cari Buku</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text"
                           class="form-control border-start-0 ps-0"
                           id="search"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Ketik judul, ISBN, atau penulis...">
                </div>
            </div>

            <!-- Filter Kategori -->
            <div class="col-md-3">
                <label for="kategori_id" class="form-label">Kategori</label>
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
                <label for="stok_status" class="form-label">Status Stok</label>
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
                    Filter
                </button>
                @if (request()->hasAny(['search', 'kategori_id', 'stok_status']) && (request('search') || request('kategori_id') || request('stok_status')))
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary-del" title="Reset Filter">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Buku -->
    <div class="ui-card">
        <div class="ui-card-header">
            <div class="d-flex align-items-center gap-2">
                <span class="fw-semibold text-dark">Daftar Koleksi</span>
                <span class="badge bg-light text-secondary border">Total: {{ $bukus->total() }}</span>
            </div>
            <div class="text-muted small">
                @if ($bukus->total() > 0)
                    Menampilkan data {{ $bukus->firstItem() }} &ndash; {{ $bukus->lastItem() }}
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
                                <a href="{{ route('buku.show', $buku) }}" class="fw-bold text-dark text-decoration-none">
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
                                    <a href="{{ route('buku.show', $buku) }}" class="btn btn-light border" title="Lihat Rincian">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('buku.edit', $buku) }}" class="btn btn-light border text-primary" title="Edit Data">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ addslashes($buku->judul) }}\'?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light border text-danger" title="Hapus Buku">
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
                                        <i class="bi bi-search fs-1 text-muted d-block mb-2"></i>
                                        <h5 class="fw-bold text-dark">Pencarian Tidak Ditemukan</h5>
                                        <p class="text-muted small mb-3">Tidak ada buku yang cocok dengan kriteria pencarian dan filter yang Anda pilih.</p>
                                        <a href="{{ route('buku.index') }}" class="btn btn-secondary-del btn-sm">
                                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filter Pencarian
                                        </a>
                                    </div>
                                @else
                                    <div class="py-4">
                                        <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
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
