<x-layout title="Detail Buku: {{ $buku->judul }}">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1">
                            <li class="breadcrumb-item"><a href="{{ route('buku.index') }}" class="text-decoration-none">Koleksi Buku</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Buku</li>
                        </ol>
                    </nav>
                    <h1 class="page-title">{{ $buku->judul }}</h1>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <a href="{{ route('buku.edit', $buku) }}" class="btn btn-del">
                        <i class="bi bi-pencil me-1"></i> Edit Buku
                    </a>
                    <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ addslashes($buku->judul) }}\'?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>

            <div class="card card-del shadow-sm mb-4">
                <div class="card-del-header d-flex align-items-center justify-content-between">
                    <div class="fw-bold text-dark fs-5">
                        <i class="bi bi-journal-bookmark me-2 text-primary"></i> Informasi Rinci Buku
                    </div>
                    @if ($buku->kategori)
                        <a href="{{ route('kategori.show', $buku->kategori) }}" class="badge badge-del text-decoration-none px-3 py-2 fs-6">
                            <i class="bi bi-tag-fill me-1"></i> {{ $buku->kategori->nama_kategori }}
                        </a>
                    @else
                        <span class="badge bg-secondary px-3 py-2">Tanpa Kategori</span>
                    @endif
                </div>

                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <div class="text-muted small fw-semibold text-uppercase">Nomor ISBN</div>
                                <div class="fs-5 fw-bold text-dark mt-1 font-monospace">{{ $buku->isbn }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <div class="text-muted small fw-semibold text-uppercase">Ketersediaan Stok</div>
                                <div class="mt-1">
                                    @if ($buku->stok > 5)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle fs-6 px-3 py-1">
                                            <i class="bi bi-check-circle me-1"></i> Tersedia ({{ $buku->stok }} eksemplar)
                                        </span>
                                    @elseif ($buku->stok > 0)
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle fs-6 px-3 py-1">
                                            <i class="bi bi-exclamation-triangle me-1"></i> Terbatas ({{ $buku->stok }} eksemplar)
                                        </span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle fs-6 px-3 py-1">
                                            <i class="bi bi-x-circle me-1"></i> Stok Habis (0 eksemplar)
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="text-muted small fw-semibold text-uppercase">Penulis</div>
                            <div class="fw-semibold text-dark fs-6 mt-1">
                                <i class="bi bi-person-fill text-secondary me-1"></i> {{ $buku->penulis }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="text-muted small fw-semibold text-uppercase">Penerbit</div>
                            <div class="fw-semibold text-dark fs-6 mt-1">
                                <i class="bi bi-building text-secondary me-1"></i> {{ $buku->penerbit }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="text-muted small fw-semibold text-uppercase">Tahun Terbit</div>
                            <div class="fw-semibold text-dark fs-6 mt-1">
                                <i class="bi bi-calendar3 text-secondary me-1"></i> Tahun {{ $buku->tahun_terbit }}
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="my-2">
                        </div>

                        <div class="col-12">
                            <h5 class="fw-bold text-dark mb-3">
                                <i class="bi bi-text-paragraph text-primary me-2"></i> Sinopsis / Deskripsi
                            </h5>
                            @if ($buku->sinopsis)
                                <div class="p-3 bg-light rounded-3 border text-secondary" style="line-height: 1.8;">
                                    {{ $buku->sinopsis }}
                                </div>
                            @else
                                <div class="text-muted fst-italic">
                                    Belum ada sinopsis yang dicatat untuk buku ini.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white border-top p-3 d-flex justify-content-between text-muted small">
                    <div>
                        <i class="bi bi-clock me-1"></i> Ditambahkan: {{ $buku->created_at->translatedFormat('d F Y H:i') }}
                    </div>
                    <div>
                        <i class="bi bi-pencil-square me-1"></i> Terakhir Diperbarui: {{ $buku->updated_at->translatedFormat('d F Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
