<x-layout title="Dashboard Perpustakaan">
    <!-- Header Halaman -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-2 py-1 rounded-pill mb-2" style="background-color: var(--del-soft-blue); border: 1px solid var(--del-border-blue);">
                <i class="bi bi-mortarboard-fill text-primary" style="font-size: 0.8rem;"></i>
                <span class="small fw-bold text-primary" style="font-size: 0.75rem;">Institut Teknologi Del &bull; Sistem Informasi Perpustakaan</span>
            </div>
            <h1 class="h3 fw-bold text-dark mb-1">Dashboard Perpustakaan</h1>
            <p class="text-muted small mb-0">Selamat datang di sistem manajemen buku dan koleksi pustaka kampus Del.</p>
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

    <!-- Banner Informasi SIPUS-Del (Bahasa Ramah, Lugas, & Tidak Ambigu) -->
    <div class="ui-card p-4 mb-4" style="background: linear-gradient(135deg, #F0F9FF 0%, #E0F2FE 55%, #BAE6FD 100%); border: 1px solid var(--del-border-blue); box-shadow: 0 4px 15px rgba(2, 132, 199, 0.08);">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge" style="background-color: #0284C7; color: #FFFFFF; font-size: 0.75rem; font-weight: 700; padding: 0.35rem 0.65rem;">Tentang Aplikasi</span>
                    <span class="text-muted small fw-semibold">Institut Teknologi Del &bull; Kampus Laguboti</span>
                </div>
                <h2 class="h4 fw-bold mb-2" style="color: var(--del-deep); letter-spacing: -0.02em;">
                    Mengenal SIPUS-Del
                </h2>
                <p class="text-secondary small mb-3" style="line-height: 1.75; font-size: 0.925rem;">
                    <strong>SIPUS-Del</strong> adalah aplikasi perpustakaan resmi yang digunakan untuk mengelola seluruh data buku di kampus Institut Teknologi Del. Aplikasi ini memudahkan pustakawan dan mahasiswa dalam mencari buku referensi kuliah, mengelompokkan buku berdasarkan bidang keilmuan, serta memantau sisa buku yang siap dipinjam secara langsung.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-white text-dark border px-3 py-2 fw-semibold" style="font-size: 0.775rem;">
                        <i class="bi bi-award-fill text-warning me-1"></i> Nilai Kampus: MarTuhan, Marroha, Marbisuk
                    </span>
                    <span class="badge bg-white text-dark border px-3 py-2 fw-semibold" style="font-size: 0.775rem;">
                        <i class="bi bi-book-fill text-primary me-1"></i> Buku Kuliah &amp; Referensi Lengkap
                    </span>
                    <span class="badge bg-white text-dark border px-3 py-2 fw-semibold" style="font-size: 0.775rem;">
                        <i class="bi bi-check2-circle text-success me-1"></i> Informasi Stok Selalu Akurat
                    </span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-white p-3 rounded-3 border" style="border-color: var(--del-border-blue) !important; box-shadow: 0 2px 8px rgba(12, 74, 110, 0.06);">
                    <div class="fw-bold text-dark small mb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-lightbulb-fill text-warning"></i> 3 Manfaat Utama:
                    </div>
                    <ul class="list-unstyled mb-0 small text-secondary" style="line-height: 1.8; font-size: 0.825rem;">
                        <li class="d-flex align-items-start gap-2 mb-1">
                            <i class="bi bi-check-circle-fill text-primary mt-1"></i>
                            <span><strong>Pencarian Mudah:</strong> Temukan buku berdasarkan judul, nama penulis, atau nomor ISBN.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2 mb-1">
                            <i class="bi bi-check-circle-fill text-primary mt-1"></i>
                            <span><strong>Kategori Rapi:</strong> Buku terbagi jelas dalam kelompok ilmu Informatika, SI, AI, dan Sains.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <i class="bi bi-check-circle-fill text-primary mt-1"></i>
                            <span><strong>Pantau Sisa Buku:</strong> Tahu persis apakah buku masih ada di rak atau sedang kosong.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- 4 Kartu Statistik Interaktif (Dapat Diklik Langsung) -->
    <div class="row g-3 mb-4">
        <!-- Kartu 1: Total Judul Buku -->
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('buku.index') }}" class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.725rem; letter-spacing: 0.05em;">Total Judul Buku</span>
                    <div class="stat-icon" style="background-color: var(--del-soft-blue); color: var(--del-primary);">
                        <i class="bi bi-journal-text"></i>
                    </div>
                </div>
                <div class="h2 fw-bold mb-1" style="color: var(--del-deep);">{{ number_format($totalJudul) }}</div>
                <div class="small text-muted d-flex align-items-center justify-content-between">
                    <span>Judul buku terdaftar</span>
                    <span class="text-primary fw-semibold" style="font-size: 0.75rem;">Lihat semua &rarr;</span>
                </div>
            </a>
        </div>

        <!-- Kartu 2: Kategori Buku -->
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('kategori.index') }}" class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.725rem; letter-spacing: 0.05em;">Kategori Buku</span>
                    <div class="stat-icon" style="background-color: #EEF2FF; color: #4F46E5;">
                        <i class="bi bi-tags"></i>
                    </div>
                </div>
                <div class="h2 fw-bold mb-1" style="color: #312E81;">{{ number_format($totalKategori) }}</div>
                <div class="small text-muted d-flex align-items-center justify-content-between">
                    <span>Bidang keilmuan</span>
                    <span class="text-indigo fw-semibold" style="font-size: 0.75rem; color: #4F46E5;">Lihat semua &rarr;</span>
                </div>
            </a>
        </div>

        <!-- Kartu 3: Total Eksemplar Fisik -->
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card" style="cursor: default;">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.725rem; letter-spacing: 0.05em;">Total Stok Buku</span>
                    <div class="stat-icon" style="background-color: #ECFDF5; color: #059669;">
                        <i class="bi bi-layers"></i>
                    </div>
                </div>
                <div class="h2 fw-bold text-success mb-1">{{ number_format($totalStok) }}</div>
                <div class="small text-muted">
                    Eksemplar fisik di perpustakaan
                </div>
            </div>
        </div>

        <!-- Kartu 4: Buku Stok Habis -->
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('buku.index', ['stok_status' => 'habis']) }}" class="stat-card" style="border-left: {{ $stokKosong > 0 ? '4px solid #EF4444' : '1px solid var(--del-border)' }};">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.725rem; letter-spacing: 0.05em;">Stok Habis</span>
                    <div class="stat-icon" style="background-color: {{ $stokKosong > 0 ? '#FEF2F2' : '#F1F5F9' }}; color: {{ $stokKosong > 0 ? '#DC2626' : '#64748B' }};">
                        <i class="bi bi-exclamation-octagon"></i>
                    </div>
                </div>
                <div class="h2 fw-bold {{ $stokKosong > 0 ? 'text-danger' : 'text-dark' }} mb-1">{{ number_format($stokKosong) }}</div>
                <div class="small text-muted d-flex align-items-center justify-content-between">
                    <span>{{ $stokKosong > 0 ? 'Buku perlu diisi ulang' : 'Semua buku memiliki stok' }}</span>
                    @if ($stokKosong > 0)
                        <span class="text-danger fw-semibold" style="font-size: 0.75rem;">Periksa &rarr;</span>
                    @endif
                </div>
            </a>
        </div>
    </div>

    <!-- Layout Dua Kolom: Buku Terbaru & Aksi Cepat -->
    <div class="row g-4">
        <!-- Kolom Kiri: Buku Terbaru Ditambahkan -->
        <div class="col-lg-8">
            <div class="ui-card">
                <div class="ui-card-header">
                    <div>
                        <h2 class="ui-card-title">
                            <i class="bi bi-clock-history text-primary"></i> Buku Terbaru Ditambahkan
                        </h2>
                        <div class="text-muted small">Daftar buku yang baru saja didaftarkan ke sistem perpustakaan</div>
                    </div>
                    <a href="{{ route('buku.index') }}" class="btn btn-sm btn-outline-del">
                        Lihat Semua Buku <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-del align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Buku &amp; Penulis</th>
                                <th>Kategori</th>
                                <th class="text-center">Tahun</th>
                                <th class="text-center">Ketersediaan</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentBukus as $buku)
                                <tr>
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
                                                <i class="bi bi-check-circle"></i> {{ $buku->stok }} buku
                                            </span>
                                        @elseif ($buku->stok > 0)
                                            <span class="badge-status badge-status-menipis">
                                                <i class="bi bi-exclamation-triangle"></i> Sisa {{ $buku->stok }}
                                            </span>
                                        @else
                                            <span class="badge-status badge-status-habis">
                                                <i class="bi bi-x-circle"></i> Habis
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('buku.show', $buku) }}" class="btn btn-sm btn-light border py-1 px-2" title="Lihat Informasi Buku">
                                            <i class="bi bi-arrow-up-right text-primary"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-journal-x fs-2 d-block mb-2 text-primary"></i>
                                        Belum ada koleksi buku yang terdaftar di perpustakaan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Aksi Cepat & Panduan Status -->
        <div class="col-lg-4">
            <!-- Card Aksi Cepat -->
            <div class="ui-card p-4 mb-4">
                <h3 class="h6 fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-lightning-charge-fill text-warning"></i> Menu Pintas
                </h3>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('buku.create') }}" class="btn btn-del justify-content-start py-2">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Buku Baru
                    </a>
                    <a href="{{ route('kategori.create') }}" class="btn btn-outline-del justify-content-start py-2">
                        <i class="bi bi-folder-plus me-1"></i> Tambah Kategori Baru
                    </a>
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary-del justify-content-start py-2">
                        <i class="bi bi-journal-bookmark me-1"></i> Buka Daftar Buku
                    </a>
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary-del justify-content-start py-2">
                        <i class="bi bi-tags me-1"></i> Buka Daftar Kategori
                    </a>
                </div>
            </div>

            <!-- Card Panduan Status Stok Buku -->
            <div class="ui-card p-4">
                <h3 class="h6 fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-info-circle-fill text-primary"></i> Keterangan Status Stok
                </h3>
                <div class="d-flex flex-column gap-3 small">
                    <div class="d-flex align-items-start gap-2">
                        <span class="badge-status badge-status-tersedia mt-1">Tersedia</span>
                        <div class="text-muted">
                            Jumlah buku <strong>lebih dari 5</strong>. Siap untuk dipinjam oleh mahasiswa atau dosen.
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <span class="badge-status badge-status-menipis mt-1">Menipis</span>
                        <div class="text-muted">
                            Jumlah buku tinggal <strong>1 sampai 5</strong>. Persediaan hampir habis.
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <span class="badge-status badge-status-habis mt-1">Habis</span>
                        <div class="text-muted">
                            Jumlah buku <strong>0</strong>. Buku sedang tidak tersedia di rak perpustakaan.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
