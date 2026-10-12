<x-layout title="Dashboard Perpustakaan">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h4 fw-bold text-dark mb-1">Dashboard Perpustakaan</h1>
            <p class="text-muted small mb-0">Ringkasan koleksi dan pengelolaan data perpustakaan Institut Teknologi Del.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('buku.create') }}" class="btn btn-del btn-sm">
                <i class="bi bi-plus-lg"></i> Tambah Buku Baru
            </a>
            <a href="{{ route('kategori.create') }}" class="btn btn-outline-del btn-sm">
                <i class="bi bi-folder-plus"></i> Tambah Kategori
            </a>
        </div>
    </div>

    <!-- 4 Metrik Statistik Utama -->
    <div class="row g-3 mb-4">
        <!-- Total Judul Buku -->
        <div class="col-sm-6 col-xl-3">
            <div class="ui-card p-3 h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-medium text-uppercase">Total Judul</span>
                    <div class="rounded-2 p-2" style="background-color: var(--del-soft-lavender); color: var(--del-primary);">
                        <i class="bi bi-journal-text fs-5"></i>
                    </div>
                </div>
                <div class="h3 fw-bold text-dark mb-1">{{ number_format($totalJudul) }}</div>
                <div class="small text-muted">Judul buku terdaftar</div>
            </div>
        </div>

        <!-- Total Kategori -->
        <div class="col-sm-6 col-xl-3">
            <div class="ui-card p-3 h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-medium text-uppercase">Klasifikasi</span>
                    <div class="rounded-2 p-2" style="background-color: #EEF2FF; color: #4F46E5;">
                        <i class="bi bi-tags fs-5"></i>
                    </div>
                </div>
                <div class="h3 fw-bold text-dark mb-1">{{ number_format($totalKategori) }}</div>
                <div class="small text-muted">Kategori bidang ilmu</div>
            </div>
        </div>

        <!-- Total Stok Eksemplar -->
        <div class="col-sm-6 col-xl-3">
            <div class="ui-card p-3 h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-medium text-uppercase">Total Stok</span>
                    <div class="rounded-2 p-2" style="background-color: #ECFDF5; color: #059669;">
                        <i class="bi bi-layers fs-5"></i>
                    </div>
                </div>
                <div class="h3 fw-bold text-dark mb-1">{{ number_format($totalStok) }}</div>
                <div class="small text-muted">Eksemplar buku fisik</div>
            </div>
        </div>

        <!-- Buku Stok Kosong -->
        <div class="col-sm-6 col-xl-3">
            <div class="ui-card p-3 h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-medium text-uppercase">Stok Habis</span>
                    <div class="rounded-2 p-2" style="background-color: {{ $stokKosong > 0 ? '#FEF2F2' : '#F3F4F6' }}; color: {{ $stokKosong > 0 ? '#DC2626' : '#6B7280' }};">
                        <i class="bi bi-exclamation-octagon fs-5"></i>
                    </div>
                </div>
                <div class="h3 fw-bold {{ $stokKosong > 0 ? 'text-danger' : 'text-dark' }} mb-1">{{ number_format($stokKosong) }}</div>
                <div class="small text-muted">Perlu restock segera</div>
            </div>
        </div>
    </div>

    <!-- Layout Dua Kolom: Aksi Cepat & Buku Terbaru -->
    <div class="row g-4">
        <!-- Kolom Buku Terbaru -->
        <div class="col-lg-8">
            <div class="ui-card">
                <div class="ui-card-header">
                    <div>
                        <h2 class="ui-card-title">Koleksi Terbaru Ditambahkan</h2>
                        <div class="text-muted small">5 buku terakhir yang masuk ke sistem</div>
                    </div>
                    <a href="{{ route('buku.index') }}" class="btn btn-sm btn-outline-del">
                        Lihat Semua Buku <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-del align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Judul &amp; Penulis</th>
                                <th>Kategori</th>
                                <th class="text-center">Tahun</th>
                                <th class="text-center">Stok</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentBukus as $buku)
                                <tr>
                                    <td>
                                        <a href="{{ route('buku.show', $buku) }}" class="fw-semibold text-dark text-decoration-none">
                                            {{ $buku->judul }}
                                        </a>
                                        <div class="small text-muted mt-1">
                                            <i class="bi bi-person me-1"></i>{{ $buku->penulis }}
                                        </div>
                                    </td>
                                    <td>
                                        @if ($buku->kategori)
                                            <span class="badge-category">
                                                <i class="bi bi-tag-fill"></i> {{ $buku->kategori->nama_kategori }}
                                            </span>
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
                                        <a href="{{ route('buku.show', $buku) }}" class="btn btn-sm btn-light border py-1 px-2" title="Lihat Detail">
                                            <i class="bi bi-arrow-up-right"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                        Belum ada data koleksi buku.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Aksi Cepat & Ringkasan -->
        <div class="col-lg-4">
            <!-- Card Aksi Cepat -->
            <div class="ui-card p-4 mb-4">
                <h3 class="h6 fw-bold text-dark mb-3">Aksi Cepat</h3>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('buku.create') }}" class="btn btn-del justify-content-start py-2">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Koleksi Buku Baru
                    </a>
                    <a href="{{ route('kategori.create') }}" class="btn btn-outline-del justify-content-start py-2">
                        <i class="bi bi-folder-plus me-1"></i> Buat Kategori Baru
                    </a>
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary-del justify-content-start py-2">
                        <i class="bi bi-journal-bookmark me-1"></i> Buka Katalog Seluruh Buku
                    </a>
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary-del justify-content-start py-2">
                        <i class="bi bi-tags me-1"></i> Kelola Daftar Kategori
                    </a>
                </div>
            </div>

            <!-- Card Info Sistem -->
            <div class="ui-card p-4">
                <h3 class="h6 fw-bold text-dark mb-2">Tentang SIPUS-Del</h3>
                <p class="text-muted small mb-3">
                    Sistem Informasi Perpustakaan Institut Teknologi Del dibangun menggunakan arsitektur MVC Laravel 11/13, Eloquent ORM, dan optimasi Eager Loading untuk mencegah N+1 Query Problem.
                </p>
                <div class="p-2 rounded bg-light border text-muted small">
                    <i class="bi bi-shield-check text-success me-1"></i> Database: <strong>SQLite Terintegrasi</strong>
                </div>
            </div>
        </div>
    </div>
</x-layout>
