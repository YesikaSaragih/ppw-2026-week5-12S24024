<x-layout title="Detail: {{ $buku->judul }}">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">
            <!-- Navigasi Breadcrumb & Aksi -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1" style="font-size: 0.8rem;">
                            <li class="breadcrumb-item"><a href="{{ route('buku.index') }}" class="text-decoration-none text-muted">Koleksi Buku</a></li>
                            <li class="breadcrumb-item active text-dark" aria-current="page">Rincian Buku</li>
                        </ol>
                    </nav>
                    <h1 class="h4 fw-bold text-dark mb-0">{{ $buku->judul }}</h1>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary-del btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('buku.edit', $buku) }}" class="btn btn-del btn-sm">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ addslashes($buku->judul) }}\'?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-light border text-danger btn-sm" title="Hapus Buku">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>

            <!-- Kartu Metadata Ringkas -->
            <div class="ui-card p-4 mb-4">
                <div class="row g-4 align-items-center">
                    <div class="col-md-7">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-light text-secondary border font-monospace py-1 px-2" style="font-size: 0.8rem;">
                                ISBN: {{ $buku->isbn }}
                            </span>
                            @if ($buku->kategori)
                                <a href="{{ route('kategori.show', $buku->kategori) }}" class="badge-category">
                                    <i class="bi bi-tag-fill"></i> {{ $buku->kategori->nama_kategori }}
                                </a>
                            @endif
                        </div>
                        <h2 class="h5 fw-bold text-dark mb-1">{{ $buku->judul }}</h2>
                        <div class="text-muted small">
                            Ditulis oleh <strong>{{ $buku->penulis }}</strong> &bull; Diterbitkan oleh <strong>{{ $buku->penerbit }}</strong>
                        </div>
                    </div>
                    <div class="col-md-5 text-md-end">
                        <div class="text-muted small mb-1">Status Ketersediaan Fisik</div>
                        <div>
                            @if ($buku->stok > 5)
                                <span class="badge-status badge-status-tersedia fs-6 px-3 py-2">
                                    <i class="bi bi-check-circle"></i> Tersedia ({{ $buku->stok }} eksemplar)
                                </span>
                            @elseif ($buku->stok > 0)
                                <span class="badge-status badge-status-menipis fs-6 px-3 py-2">
                                    <i class="bi bi-exclamation-triangle"></i> Menipis ({{ $buku->stok }} eksemplar)
                                </span>
                            @else
                                <span class="badge-status badge-status-habis fs-6 px-3 py-2">
                                    <i class="bi bi-x-circle"></i> Stok Habis (0 eksemplar)
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Spesifikasi Grid -->
            <div class="row g-3 mb-4">
                <div class="col-sm-6 col-md-3">
                    <div class="ui-card p-3 h-100">
                        <div class="text-muted small fw-medium">Penulis</div>
                        <div class="fw-semibold text-dark mt-1">{{ $buku->penulis }}</div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="ui-card p-3 h-100">
                        <div class="text-muted small fw-medium">Penerbit</div>
                        <div class="fw-semibold text-dark mt-1">{{ $buku->penerbit }}</div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="ui-card p-3 h-100">
                        <div class="text-muted small fw-medium">Tahun Terbit</div>
                        <div class="fw-semibold text-dark mt-1">Tahun {{ $buku->tahun_terbit }}</div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="ui-card p-3 h-100">
                        <div class="text-muted small fw-medium">Kode Kategori</div>
                        <div class="fw-semibold text-dark mt-1 font-monospace">{{ $buku->kategori ? $buku->kategori->kode_kategori : '-' }}</div>
                    </div>
                </div>
            </div>

            <!-- Sinopsis Card -->
            <div class="ui-card mb-4">
                <div class="ui-card-header">
                    <span class="ui-card-title"><i class="bi bi-text-paragraph text-primary me-1"></i> Sinopsis / Ringkasan Buku</span>
                </div>
                <div class="ui-card-body">
                    @if ($buku->sinopsis)
                        <div class="text-secondary" style="line-height: 1.8; font-size: 0.9375rem;">
                            {{ $buku->sinopsis }}
                        </div>
                    @else
                        <div class="text-muted fst-italic small">
                            Belum ada ringkasan sinopsis yang dicatat untuk buku ini.
                        </div>
                    @endif
                </div>
                <div class="p-3 border-top bg-light rounded-bottom d-flex justify-content-between text-muted small" style="font-size: 0.775rem;">
                    <div>Ditambahkan: {{ $buku->created_at->translatedFormat('d F Y H:i') }}</div>
                    <div>Diperbarui: {{ $buku->updated_at->translatedFormat('d F Y H:i') }}</div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
