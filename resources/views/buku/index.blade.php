<x-layout title="Daftar Koleksi Buku">
    <!-- Header Halaman -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-2 py-1 rounded-pill mb-1" style="background-color: var(--del-soft-purple); border: 1px solid var(--del-border-purple);">
                <i class="bi bi-journals" style="font-size: 0.75rem; color: var(--del-primary);"></i>
                <span class="small fw-bold" style="font-size: 0.725rem; color: var(--del-primary);">Koleksi Perpustakaan</span>
            </div>
            <h1 class="h4 fw-bold text-dark mb-1">Manajemen Buku</h1>
            <p class="text-muted small mb-0">Kelola daftar buku, kategori bidang ilmu, dan jumlah stok di perpustakaan Institut Teknologi Del.</p>
        </div>
        <div>
            <a href="{{ route('buku.create') }}" class="btn btn-del">
                <i class="bi bi-plus-lg"></i> Tambah Buku Baru
            </a>
        </div>
    </div>

    <!-- Quick Status Filter Tabs (Interaktif Satu Klik) -->
    <div class="d-flex flex-wrap gap-2 mb-3">
        <a href="{{ route('buku.index', array_merge(request()->except('stok_status', 'page'), [])) }}"
           class="btn btn-sm {{ !request('stok_status') ? 'btn-del' : 'btn-outline-del' }}"
           style="border-radius: 20px; font-size: 0.8rem;">
            <i class="bi bi-collection me-1"></i> Semua Buku
        </a>
        <a href="{{ route('buku.index', array_merge(request()->except('page'), ['stok_status' => 'tersedia'])) }}"
           class="btn btn-sm {{ request('stok_status') === 'tersedia' ? 'btn-del' : 'btn-outline-del' }}"
           style="border-radius: 20px; font-size: 0.8rem;">
            <i class="bi bi-check-circle me-1"></i> Stok Tersedia (&gt; 5)
        </a>
        <a href="{{ route('buku.index', array_merge(request()->except('page'), ['stok_status' => 'menipis'])) }}"
           class="btn btn-sm {{ request('stok_status') === 'menipis' ? 'btn-del' : 'btn-outline-del' }}"
           style="border-radius: 20px; font-size: 0.8rem;">
            <i class="bi bi-exclamation-triangle me-1"></i> Stok Menipis (1-5)
        </a>
        <a href="{{ route('buku.index', array_merge(request()->except('page'), ['stok_status' => 'habis'])) }}"
           class="btn btn-sm {{ request('stok_status') === 'habis' ? 'btn-del' : 'btn-outline-del' }}"
           style="border-radius: 20px; font-size: 0.8rem;">
            <i class="bi bi-x-circle me-1"></i> Stok Habis (0)
        </a>
    </div>

    <!-- Panel Pencarian & Filter -->
    <div class="ui-card p-3 mb-4" style="background: linear-gradient(180deg, #FFFFFF 0%, var(--del-lightest-purple) 100%);">
        <form action="{{ route('buku.index') }}" method="GET" class="row g-2 align-items-end">
            <!-- Simpan Filter Stok saat ini jika ada -->
            @if (request('stok_status'))
                <input type="hidden" name="stok_status" value="{{ request('stok_status') }}">
            @endif

            <!-- Input Kata Kunci Pencarian -->
            <div class="col-md-5">
                <label for="search" class="form-label">
                    <i class="bi bi-search me-1" style="color: var(--del-primary);"></i> Cari Buku
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted">
                        <i class="bi bi-search" style="color: var(--del-primary);"></i>
                    </span>
                    <input type="text"
                           class="form-control border-start-0 ps-0"
                           id="search"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Ketik judul buku, nama penulis, atau ISBN...">
                </div>
            </div>

            <!-- Filter Kategori -->
            <div class="col-md-4">
                <label for="kategori_id" class="form-label">
                    <i class="bi bi-tags me-1" style="color: var(--del-primary);"></i> Pilih Kategori
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

            <!-- Tombol Cari & Reset -->
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-del w-100 justify-content-center">
                    <i class="bi bi-funnel"></i> Cari
                </button>
                @if (request()->hasAny(['search', 'kategori_id', 'stok_status']) && (request('search') || request('kategori_id') || request('stok_status')))
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary-del" title="Hapus Filter Pencarian">
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
                    <i class="bi bi-collection" style="color: var(--del-primary);"></i> Daftar Koleksi Buku
                </span>
                <span class="badge" style="background-color: var(--del-soft-purple); color: var(--del-primary); border: 1px solid var(--del-border-purple); font-weight: 700;">
                    Total: {{ $bukus->total() }}
                </span>
            </div>
            <div class="text-muted small">
                @if ($bukus->total() > 0)
                    Menampilkan data <strong>{{ $bukus->firstItem() }} &ndash; {{ $bukus->lastItem() }}</strong> dari <strong>{{ $bukus->total() }}</strong> buku
                @endif
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-del align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 16%;">ISBN</th>
                        <th style="width: 32%;">Buku &amp; Penulis</th>
                        <th style="width: 18%;">Kategori</th>
                        <th style="width: 8%;" class="text-center">Tahun</th>
                        <th style="width: 12%;" class="text-center">Stok</th>
                        <th style="width: 14%;" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bukus as $buku)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="badge bg-light text-secondary border font-monospace py-1 px-2" style="font-size: 0.775rem;">
                                        {{ $buku->isbn }}
                                    </span>
                                    <button type="button"
                                            class="btn-copy"
                                            title="Salin ISBN"
                                            onclick="copyToClipboard('{{ $buku->isbn }}', this)">
                                        <i class="bi bi-copy" style="font-size: 0.8rem;"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="book-avatar">
                                        {{ mb_substr($buku->judul, 0, 1) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('buku.show', $buku) }}" class="fw-bold text-dark text-decoration-none">
                                            {{ $buku->judul }}
                                        </a>
                                        <div class="small text-muted mt-1">
                                            <i class="bi bi-person me-1"></i>{{ $buku->penulis }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($buku->kategori)
                                    <a href="{{ route('kategori.show', $buku->kategori) }}" class="badge-category" title="Lihat semua buku dalam kategori ini">
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
                                    <span class="badge-status badge-status-tersedia" title="Stok buku masih banyak">
                                        <i class="bi bi-check-circle"></i> {{ $buku->stok }} buku
                                    </span>
                                @elseif ($buku->stok > 0)
                                    <span class="badge-status badge-status-menipis" title="Persediaan buku hampir habis">
                                        <i class="bi bi-exclamation-triangle"></i> Sisa {{ $buku->stok }}
                                    </span>
                                @else
                                    <span class="badge-status badge-status-habis" title="Buku sedang kosong di rak">
                                        <i class="bi bi-x-circle"></i> Habis
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('buku.show', $buku) }}" class="btn btn-light border py-1 px-2" title="Lihat Informasi Buku">
                                        <i class="bi bi-eye" style="color: var(--del-primary);"></i>
                                    </a>
                                    <a href="{{ route('buku.edit', $buku) }}" class="btn btn-light border py-1 px-2" title="Ubah Data Buku">
                                        <i class="bi bi-pencil" style="color: var(--del-primary);"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-light border text-danger py-1 px-2"
                                            title="Hapus Buku"
                                            onclick="confirmDelete('{{ route('buku.destroy', $buku) }}', '{{ addslashes($buku->judul) }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                @if (request()->hasAny(['search', 'kategori_id', 'stok_status']) && (request('search') || request('kategori_id') || request('stok_status')))
                                    <div class="py-4">
                                        <div class="p-3 d-inline-flex rounded-circle mb-3" style="background-color: var(--del-soft-purple); color: var(--del-primary);">
                                            <i class="bi bi-search fs-2"></i>
                                        </div>
                                        <h5 class="fw-bold text-dark">Buku Tidak Ditemukan</h5>
                                        <p class="text-muted small mb-3">Tidak ada buku yang sesuai dengan kata kunci atau filter yang Anda pilih.</p>
                                        <a href="{{ route('buku.index') }}" class="btn btn-secondary-del btn-sm">
                                            <i class="bi bi-arrow-counterclockwise me-1"></i> Tampilkan Semua Buku
                                        </a>
                                    </div>
                                @else
                                    <div class="py-4">
                                        <div class="p-3 d-inline-flex rounded-circle mb-3" style="background-color: var(--del-soft-purple); color: var(--del-primary);">
                                            <i class="bi bi-journal-plus fs-2"></i>
                                        </div>
                                        <h5 class="fw-bold text-dark">Belum Ada Buku Terdaftar</h5>
                                        <p class="text-muted small mb-3">Mulai tambahkan buku pertama untuk melengkapi koleksi perpustakaan.</p>
                                        <a href="{{ route('buku.create') }}" class="btn btn-del btn-sm">
                                            <i class="bi bi-plus-lg me-1"></i> Tambah Buku Baru
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
        @if ($bukus->hasPages())
            <div class="p-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="small text-muted">
                    Halaman {{ $bukus->currentPage() }} dari {{ $bukus->lastPage() }}
                </div>
                <div>
                    {{ $bukus->links() }}
                </div>
            </div>
        @endif
    </div>
</x-layout>
