<x-layout title="Detail: {{ $buku->judul }}">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">
            <!-- Navigasi Atas & Tombol Aksi -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1" style="font-size: 0.8rem;">
                            <li class="breadcrumb-item"><a href="{{ route('buku.index') }}" class="text-decoration-none text-primary">Daftar Buku</a></li>
                            <li class="breadcrumb-item active text-dark" aria-current="page">Detail Informasi</li>
                        </ol>
                    </nav>
                    <h1 class="h4 fw-bold text-dark mb-0">{{ $buku->judul }}</h1>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary-del btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                    </a>
                    <a href="{{ route('buku.edit', $buku) }}" class="btn btn-del btn-sm">
                        <i class="bi bi-pencil"></i> Ubah Data
                    </a>
                    <button type="button"
                            class="btn btn-light border text-danger btn-sm"
                            title="Hapus Buku"
                            onclick="confirmDelete('{{ route('buku.destroy', $buku) }}', '{{ addslashes($buku->judul) }}')">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </div>
            </div>

            <!-- Kartu Utama Buku (Mockup Cover Modern + Status Stok) -->
            <div class="ui-card p-4 mb-4" style="background: linear-gradient(135deg, #FFFFFF 0%, var(--del-lightest-blue) 100%); border-left: 4px solid var(--del-primary);">
                <div class="row g-4 align-items-center">
                    <div class="col-md-2 col-sm-3 text-center">
                        <div class="mx-auto" style="width: 80px; height: 110px; border-radius: 8px; background: linear-gradient(135deg, var(--del-soft-blue) 0%, #BAE6FD 100%); border: 2px solid var(--del-border-blue); display: flex; flex-direction: column; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(2, 132, 199, 0.15);">
                            <i class="bi bi-book-half text-primary fs-2 mb-1"></i>
                            <span class="fw-bold font-monospace text-primary" style="font-size: 0.65rem;">{{ $buku->tahun_terbit }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-9">
                        <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                            <span class="badge bg-white text-secondary border font-monospace py-1 px-2" style="font-size: 0.8rem;">
                                ISBN: {{ $buku->isbn }}
                            </span>
                            <button type="button" class="btn-copy" onclick="copyToClipboard('{{ $buku->isbn }}', this)" title="Salin ISBN">
                                <i class="bi bi-copy"></i>
                            </button>
                            @if ($buku->kategori)
                                <a href="{{ route('kategori.show', $buku->kategori) }}" class="badge-category">
                                    <i class="bi bi-tag-fill"></i> {{ $buku->kategori->nama_kategori }}
                                </a>
                            @endif
                        </div>
                        <h2 class="h5 fw-bold text-dark mb-1">{{ $buku->judul }}</h2>
                        <div class="text-muted small">
                            Ditulis oleh <strong class="text-dark">{{ $buku->penulis }}</strong> &bull; Penerbit <strong class="text-dark">{{ $buku->penerbit }}</strong>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="text-muted small mb-1">Ketersediaan di Perpustakaan</div>
                        <div>
                            @if ($buku->stok > 5)
                                <span class="badge-status badge-status-tersedia fs-6 px-3 py-2">
                                    <i class="bi bi-check-circle"></i> Stok Tersedia ({{ $buku->stok }} buku)
                                </span>
                            @elseif ($buku->stok > 0)
                                <span class="badge-status badge-status-menipis fs-6 px-3 py-2">
                                    <i class="bi bi-exclamation-triangle"></i> Stok Menipis (Sisa {{ $buku->stok }})
                                </span>
                            @else
                                <span class="badge-status badge-status-habis fs-6 px-3 py-2">
                                    <i class="bi bi-x-circle"></i> Stok Habis (0 buku)
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rincian Informasi Grid 4 Kolom -->
            <div class="row g-3 mb-4">
                <div class="col-sm-6 col-md-3">
                    <div class="ui-card p-3 h-100">
                        <div class="text-muted small fw-medium">Penulis</div>
                        <div class="fw-bold text-dark mt-1">{{ $buku->penulis }}</div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="ui-card p-3 h-100">
                        <div class="text-muted small fw-medium">Penerbit</div>
                        <div class="fw-bold text-dark mt-1">{{ $buku->penerbit }}</div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="ui-card p-3 h-100">
                        <div class="text-muted small fw-medium">Tahun Terbit</div>
                        <div class="fw-bold text-dark mt-1">{{ $buku->tahun_terbit }}</div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="ui-card p-3 h-100">
                        <div class="text-muted small fw-medium">Kategori Bidang</div>
                        <div class="fw-bold text-primary mt-1">
                            {{ $buku->kategori ? $buku->kategori->nama_kategori : '-' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu Sinopsis / Ringkasan Buku -->
            <div class="ui-card mb-4">
                <div class="ui-card-header" style="background: linear-gradient(180deg, var(--del-lightest-blue) 0%, #FFFFFF 100%);">
                    <span class="ui-card-title">
                        <i class="bi bi-text-paragraph text-primary me-1"></i> Ringkasan / Sinopsis Buku
                    </span>
                </div>
                <div class="ui-card-body">
                    @if ($buku->sinopsis)
                        <div class="text-secondary" style="line-height: 1.8; font-size: 0.9375rem;">
                            {{ $buku->sinopsis }}
                        </div>
                    @else
                        <div class="text-muted fst-italic small">
                            Belum ada ringkasan sinopsis untuk buku ini.
                        </div>
                    @endif
                </div>
                <div class="p-3 border-top bg-light rounded-bottom d-flex justify-content-between text-muted small" style="font-size: 0.775rem;">
                    <div>Ditambahkan: {{ $buku->created_at->translatedFormat('d F Y') }}</div>
                    <div>Terakhir diperbarui: {{ $buku->updated_at->translatedFormat('d F Y') }}</div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
