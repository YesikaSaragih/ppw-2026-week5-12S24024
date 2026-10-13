<x-layout title="Dashboard Perpustakaan">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-2 py-1 rounded-pill mb-2" style="background-color: var(--del-soft-blue); border: 1px solid var(--del-border-blue);">
                <i class="bi bi-mortarboard-fill text-primary" style="font-size: 0.8rem;"></i>
                <span class="small fw-bold text-primary" style="font-size: 0.75rem;">Sistem Informasi Perpustakaan &bull; Institut Teknologi Del</span>
            </div>
            <h1 class="h3 fw-bold text-dark mb-1">Dashboard Perpustakaan</h1>
            <p class="text-muted small mb-0">Pusat kendali, ringkasan koleksi buku, dan klasifikasi pustaka digital kampus.</p>
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

    <!-- Hero Card: Penjelasan Lengkap Tentang SIPUS-Del (Modern & Informatif) -->
    <div class="ui-card p-4 mb-4" style="background: linear-gradient(135deg, #F0F9FF 0%, #E0F2FE 55%, #BAE6FD 100%); border: 1px solid var(--del-border-blue); box-shadow: 0 4px 15px rgba(2, 132, 199, 0.08);">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge" style="background-color: #0284C7; color: #FFFFFF; font-size: 0.75rem; font-weight: 700; padding: 0.35rem 0.65rem;">SIPUS-Del v2.0</span>
                    <span class="text-muted small fw-semibold">Institut Teknologi Del &bull; Laguboti, Toba</span>
                </div>
                <h2 class="h4 fw-bold mb-2" style="color: var(--del-deep); letter-spacing: -0.02em;">
                    Mengenal SIPUS-Del (Sistem Informasi Perpustakaan Kampus Del)
                </h2>
                <p class="text-secondary small mb-3" style="line-height: 1.75; font-size: 0.9125rem;">
                    <strong>SIPUS-Del</strong> adalah platform manajemen perpustakaan terpadu berbasis web yang dirancang khusus untuk mendukung kebutuhan akademik, riset, dan pengajaran civitas akademika <strong>Institut Teknologi Del</strong>. Sistem ini mengintegrasikan katalogisasi koleksi pustaka, pengelompokan bidang keilmuan, serta monitoring stok fisik buku secara real-time, akurat, dan transparan.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-white text-dark border px-3 py-2 fw-semibold" style="font-size: 0.775rem;">
                        <i class="bi bi-award-fill text-warning me-1"></i> Nilai Luhur: MarTuhan, Marroha, Marbisuk
                    </span>
                    <span class="badge bg-white text-dark border px-3 py-2 fw-semibold" style="font-size: 0.775rem;">
                        <i class="bi bi-cpu-fill text-primary me-1"></i> Laravel 11/13 MVC &amp; Eloquent ORM
                    </span>
                    <span class="badge bg-white text-dark border px-3 py-2 fw-semibold" style="font-size: 0.775rem;">
                        <i class="bi bi-shield-check text-success me-1"></i> Mitigasi N+1 via Eager Loading
                    </span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-white p-3 rounded-3 border" style="border-color: var(--del-border-blue) !important; box-shadow: 0 2px 8px rgba(12, 74, 110, 0.06);">
                    <div class="fw-bold text-dark small mb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill text-primary"></i> Layanan Utama Perpustakaan:
                    </div>
                    <ul class="list-unstyled mb-0 small text-secondary" style="line-height: 1.8; font-size: 0.825rem;">
                        <li class="d-flex align-items-start gap-2 mb-1">
                            <i class="bi bi-check2-circle text-primary mt-1"></i>
                            <span><strong>Katalog Koleksi Buku:</strong> Inventarisasi buku lengkap dengan ISBN unik &amp; sinopsis.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2 mb-1">
                            <i class="bi bi-check2-circle text-primary mt-1"></i>
                            <span><strong>Klasifikasi Ilmu:</strong> Pengelompokan bidang RPL, SI, AI, Keamanan Siber, &amp; Sains.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <i class="bi bi-check2-circle text-primary mt-1"></i>
                            <span><strong>Monitoring Stok:</strong> Kontrol jumlah eksemplar fisik buku secara akurat.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- 4 Pilar Kapabilitas Unggulan SIPUS-Del (Tidak Monoton & Berwarna Harmonis) -->
    <div class="row g-3 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="ui-card p-3 h-100" style="border-top: 3px solid #0284C7;">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="p-2 rounded-2" style="background-color: var(--del-soft-blue); color: var(--del-primary);">
                        <i class="bi bi-journal-bookmark-fill fs-5"></i>
                    </div>
                    <div class="fw-bold text-dark small">Katalog Buku Terpadu</div>
                </div>
                <p class="text-muted small mb-0" style="font-size: 0.8rem; line-height: 1.5;">
                    Pencatatan rincian judul, ISBN unik, penulis, penerbit, tahun publikasi, dan sinopsis mendalam.
                </p>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="ui-card p-3 h-100" style="border-top: 3px solid #6366F1;">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="p-2 rounded-2" style="background-color: #EEF2FF; color: #4F46E5;">
                        <i class="bi bi-tags-fill fs-5"></i>
                    </div>
                    <div class="fw-bold text-dark small">Klasifikasi Bidang Ilmu</div>
                </div>
                <p class="text-muted small mb-0" style="font-size: 0.8rem; line-height: 1.5;">
                    Pengelompokan koleksi berdasar kode bidang keilmuan yang mempermudah pencarian materi ajar.
                </p>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="ui-card p-3 h-100" style="border-top: 3px solid #10B981;">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="p-2 rounded-2" style="background-color: #ECFDF5; color: #059669;">
                        <i class="bi bi-search-heart-fill fs-5"></i>
                    </div>
                    <div class="fw-bold text-dark small">Pencarian &amp; Filter Cepat</div>
                </div>
                <p class="text-muted small mb-0" style="font-size: 0.8rem; line-height: 1.5;">
                    Penelusuran multi-kolom di server berdasarkan judul, ISBN, penulis, kategori, dan ketersediaan stok.
                </p>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="ui-card p-3 h-100" style="border-top: 3px solid #0EA5E9;">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="p-2 rounded-2" style="background-color: #F0F9FF; color: #0284C7;">
                        <i class="bi bi-shield-lock-fill fs-5"></i>
                    </div>
                    <div class="fw-bold text-dark small">Keamanan &amp; Audit Kueri</div>
                </div>
                <p class="text-muted small mb-0" style="font-size: 0.8rem; line-height: 1.5;">
                    Proteksi CSRF, validasi server-side ketat, dan pencatatan log query SQL via listener DB::listen.
                </p>
            </div>
        </div>
    </div>

    <!-- 4 Metrik Statistik Database Riil -->
    <div class="row g-3 mb-4">
        <!-- Total Judul Buku -->
        <div class="col-sm-6 col-xl-3">
            <div class="ui-card p-3 h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.725rem; letter-spacing: 0.05em;">Total Judul</span>
                    <div class="rounded-2 p-2" style="background-color: var(--del-soft-blue); color: var(--del-primary);">
                        <i class="bi bi-journal-text fs-5"></i>
                    </div>
                </div>
                <div class="h3 fw-bold mb-1" style="color: var(--del-deep);">{{ number_format($totalJudul) }}</div>
                <div class="small text-muted">Koleksi judul buku terdaftar</div>
            </div>
        </div>

        <!-- Total Kategori -->
        <div class="col-sm-6 col-xl-3">
            <div class="ui-card p-3 h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.725rem; letter-spacing: 0.05em;">Klasifikasi</span>
                    <div class="rounded-2 p-2" style="background-color: #EEF2FF; color: #4F46E5;">
                        <i class="bi bi-tags fs-5"></i>
                    </div>
                </div>
                <div class="h3 fw-bold mb-1" style="color: #312E81;">{{ number_format($totalKategori) }}</div>
                <div class="small text-muted">Kategori bidang ilmu</div>
            </div>
        </div>

        <!-- Total Stok Eksemplar -->
        <div class="col-sm-6 col-xl-3">
            <div class="ui-card p-3 h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.725rem; letter-spacing: 0.05em;">Total Stok Fisik</span>
                    <div class="rounded-2 p-2" style="background-color: #ECFDF5; color: #059669;">
                        <i class="bi bi-layers fs-5"></i>
                    </div>
                </div>
                <div class="h3 fw-bold text-success mb-1">{{ number_format($totalStok) }}</div>
                <div class="small text-muted">Eksemplar buku di perpustakaan</div>
            </div>
        </div>

        <!-- Buku Stok Kosong -->
        <div class="col-sm-6 col-xl-3">
            <div class="ui-card p-3 h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.725rem; letter-spacing: 0.05em;">Stok Habis</span>
                    <div class="rounded-2 p-2" style="background-color: {{ $stokKosong > 0 ? '#FEF2F2' : '#F1F5F9' }}; color: {{ $stokKosong > 0 ? '#DC2626' : '#64748B' }};">
                        <i class="bi bi-exclamation-octagon fs-5"></i>
                    </div>
                </div>
                <div class="h3 fw-bold {{ $stokKosong > 0 ? 'text-danger' : 'text-dark' }} mb-1">{{ number_format($stokKosong) }}</div>
                <div class="small text-muted">Buku memerlukan restock</div>
            </div>
        </div>
    </div>

    <!-- Layout Dua Kolom: Buku Terbaru & Aksi Cepat -->
    <div class="row g-4">
        <!-- Kolom Buku Terbaru -->
        <div class="col-lg-8">
            <div class="ui-card">
                <div class="ui-card-header">
                    <div>
                        <h2 class="ui-card-title">
                            <i class="bi bi-clock-history text-primary"></i> Koleksi Terbaru Ditambahkan
                        </h2>
                        <div class="text-muted small">5 buku terakhir yang didaftarkan ke sistem perpustakaan</div>
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
                                        <a href="{{ route('buku.show', $buku) }}" class="fw-bold text-dark text-decoration-none" style="transition: color 0.15s ease;">
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
                                            <i class="bi bi-arrow-up-right text-primary"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2 text-primary"></i>
                                        Belum ada data koleksi buku dalam database.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Aksi Cepat & Info Kampus -->
        <div class="col-lg-4">
            <!-- Card Aksi Cepat -->
            <div class="ui-card p-4 mb-4">
                <h3 class="h6 fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-lightning-charge-fill text-warning"></i> Aksi Cepat Pustakawan
                </h3>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('buku.create') }}" class="btn btn-del justify-content-start py-2">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Koleksi Buku Baru
                    </a>
                    <a href="{{ route('kategori.create') }}" class="btn btn-outline-del justify-content-start py-2">
                        <i class="bi bi-folder-plus me-1"></i> Buat Kategori Bidang Ilmu
                    </a>
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary-del justify-content-start py-2">
                        <i class="bi bi-journal-bookmark me-1"></i> Telusuri Seluruh Buku
                    </a>
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary-del justify-content-start py-2">
                        <i class="bi bi-tags me-1"></i> Kelola Daftar Kategori
                    </a>
                </div>
            </div>

            <!-- Card Identitas Kampus Del -->
            <div class="ui-card p-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="p-2 rounded-2" style="background-color: var(--del-soft-blue); color: var(--del-primary);">
                        <i class="bi bi-building fs-4"></i>
                    </div>
                    <div>
                        <h4 class="h6 fw-bold text-dark mb-0">Institut Teknologi Del</h4>
                        <div class="text-muted small">Perpustakaan Kampus Laguboti</div>
                    </div>
                </div>
                <p class="text-secondary small mb-3" style="line-height: 1.6;">
                    Komitmen menyediakan akses literasi ilmiah berkualitas tinggi guna melahirkan lulusan yang berintegritas, cerdas, dan berdampak bagi kemajuan bangsa.
                </p>
                <div class="p-2 rounded bg-light border text-muted small d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-database-check text-success me-1"></i> Driver DB:</span>
                    <strong class="text-dark">SQLite Terintegrasi</strong>
                </div>
            </div>
        </div>
    </div>
</x-layout>
