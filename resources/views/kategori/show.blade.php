<x-layout title="Detail Kategori: {{ $kategori->nama_kategori }}">
    <!-- Navigasi & Aksi -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1" style="font-size: 0.8rem;">
                    <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}" class="text-decoration-none" style="color: var(--del-primary);">Daftar Kategori</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Detail Kategori</li>
                </ol>
            </nav>
            <h1 class="h4 fw-bold text-dark mb-0">{{ $kategori->nama_kategori }}</h1>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary-del btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
            <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-del btn-sm">
                <i class="bi bi-pencil"></i> Ubah Kategori
            </a>
            <button type="button"
                    class="btn btn-light border text-danger btn-sm"
                    title="Hapus Kategori"
                    onclick="confirmDelete('{{ route('kategori.destroy', $kategori) }}', '{{ addslashes($kategori->nama_kategori) }}')">
                <i class="bi bi-trash"></i> Hapus
            </button>
        </div>
    </div>

    <!-- Ringkasan Info Kategori (Bertema Del Royal Purple) -->
    <div class="ui-card p-4 mb-4" style="background: linear-gradient(135deg, #FFFFFF 0%, var(--del-lightest-purple) 100%); border-left: 4px solid var(--del-primary);">
        <div class="row g-3 align-items-center">
            <div class="col-md-3">
                <div class="text-muted small fw-medium">Kode Kategori</div>
                <div class="h5 fw-bold font-monospace mt-1 mb-0" style="color: var(--del-primary);">{{ $kategori->kode_kategori }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small fw-medium">Nama Bidang Keilmuan</div>
                <div class="h5 fw-bold text-dark mt-1 mb-0">{{ $kategori->nama_kategori }}</div>
            </div>
            <div class="col-md-3 text-md-end">
                <div class="text-muted small fw-medium">Jumlah Koleksi Buku</div>
                <div class="h5 fw-bold mt-1 mb-0" style="color: var(--del-primary);">
                    {{ $bukus->total() }} <span class="small text-muted fw-normal">judul buku</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Koleksi Buku di Kategori Ini -->
    <div class="ui-card">
        <div class="ui-card-header">
            <div class="d-flex align-items-center gap-2">
                <span class="ui-card-title">
                    <i class="bi bi-journal-text" style="color: var(--del-primary);"></i> Daftar Buku dalam Kategori Ini
                </span>
                <span class="badge" style="background-color: var(--del-soft-purple); color: var(--del-primary); border: 1px solid var(--del-border-purple); font-weight: 700;">
                    Total: {{ $bukus->total() }}
                </span>
            </div>
            <a href="{{ route('buku.create') }}" class="btn btn-sm btn-del">
                <i class="bi bi-plus-lg"></i> Tambah Buku Baru
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-del align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 16%;">ISBN</th>
                        <th style="width: 44%;">Buku &amp; Penulis</th>
                        <th style="width: 12%;" class="text-center">Tahun</th>
                        <th style="width: 14%;" class="text-center">Stok</th>
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
                                    <button type="button" class="btn-copy" onclick="copyToClipboard('{{ $buku->isbn }}', this)" title="Salin ISBN">
                                        <i class="bi bi-copy"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('buku.show', $buku) }}" class="fw-bold text-dark text-decoration-none">
                                    {{ $buku->judul }}
                                </a>
                                <div class="small text-muted mt-1">
                                    <i class="bi bi-person me-1"></i>{{ $buku->penulis }} &bull; {{ $buku->penerbit }}
                                </div>
                            </td>
                            <td class="text-center text-secondary small">
                                {{ $buku->tahun_terbit }}
                            </td>
                            <td class="text-center">
                                @if ($buku->stok > 5)
                                    <span class="badge-status badge-status-tersedia">
                                        {{ $buku->stok }} buku
                                    </span>
                                @elseif ($buku->stok > 0)
                                    <span class="badge-status badge-status-menipis">
                                        Sisa {{ $buku->stok }}
                                    </span>
                                @else
                                    <span class="badge-status badge-status-habis">
                                        Habis
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('buku.show', $buku) }}" class="btn btn-light border py-1 px-2" title="Detail">
                                        <i class="bi bi-eye" style="color: var(--del-primary);"></i>
                                    </a>
                                    <a href="{{ route('buku.edit', $buku) }}" class="btn btn-light border py-1 px-2" title="Ubah">
                                        <i class="bi bi-pencil" style="color: var(--del-primary);"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="py-3 text-muted">
                                    <div class="p-3 d-inline-flex rounded-circle mb-3" style="background-color: var(--del-soft-purple); color: var(--del-primary);">
                                        <i class="bi bi-journal-x fs-2"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark">Belum Ada Buku</h6>
                                    <p class="small mb-3">Kategori ini belum memiliki buku yang terdaftar di sistem.</p>
                                    <a href="{{ route('buku.create') }}" class="btn btn-del btn-sm">
                                        <i class="bi bi-plus-lg me-1"></i> Tambah Buku Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

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
