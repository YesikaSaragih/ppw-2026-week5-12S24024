<x-layout title="Detail Kategori: {{ $kategori->nama_kategori }}">
    <!-- Navigasi & Aksi -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1" style="font-size: 0.8rem;">
                    <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}" class="text-decoration-none text-muted">Daftar Kategori</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Rincian Kategori</li>
                </ol>
            </nav>
            <h1 class="h4 fw-bold text-dark mb-0">{{ $kategori->nama_kategori }}</h1>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary-del btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-del btn-sm">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori \'{{ addslashes($kategori->nama_kategori) }}\'?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-light border text-danger btn-sm" title="Hapus Kategori">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <!-- Ringkasan Info Kategori -->
    <div class="ui-card p-4 mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-3">
                <div class="text-muted small fw-medium">Kode Klasifikasi</div>
                <div class="h5 fw-bold font-monospace text-dark mt-1 mb-0">{{ $kategori->kode_kategori }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small fw-medium">Nama Bidang Keilmuan</div>
                <div class="h5 fw-bold text-dark mt-1 mb-0">{{ $kategori->nama_kategori }}</div>
            </div>
            <div class="col-md-3 text-md-end">
                <div class="text-muted small fw-medium">Koleksi Terdaftar</div>
                <div class="h5 fw-bold text-primary mt-1 mb-0">
                    {{ $bukus->total() }} <span class="small text-muted fw-normal">judul buku</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Buku dalam Kategori Ini -->
    <div class="ui-card">
        <div class="ui-card-header">
            <div class="d-flex align-items-center gap-2">
                <span class="ui-card-title"><i class="bi bi-journal-text text-primary me-1"></i> Koleksi Buku Terdaftar</span>
                <span class="badge bg-light text-secondary border">Total: {{ $bukus->total() }}</span>
            </div>
            <a href="{{ route('buku.create') }}" class="btn btn-sm btn-del">
                <i class="bi bi-plus-lg"></i> Tambah Buku
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-del align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 15%;">ISBN</th>
                        <th style="width: 40%;">Judul &amp; Penulis</th>
                        <th style="width: 12%;" class="text-center">Tahun</th>
                        <th style="width: 15%;" class="text-center">Stok</th>
                        <th style="width: 18%;" class="text-end">Aksi</th>
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
                                    <i class="bi bi-person me-1"></i>{{ $buku->penulis }} &bull; {{ $buku->penerbit }}
                                </div>
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
                                    <a href="{{ route('buku.show', $buku) }}" class="btn btn-light border" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('buku.edit', $buku) }}" class="btn btn-light border text-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="py-3 text-muted">
                                    <i class="bi bi-journal-x fs-1 d-block mb-2"></i>
                                    <h6 class="fw-bold text-dark">Belum Ada Buku Terdaftar</h6>
                                    <p class="small mb-3">Kategori ini belum memiliki koleksi buku yang terhubung.</p>
                                    <a href="{{ route('buku.create') }}" class="btn btn-del btn-sm">
                                        <i class="bi bi-plus-lg"></i> Tambah Buku Baru
                                    </a>
                                </div>
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
