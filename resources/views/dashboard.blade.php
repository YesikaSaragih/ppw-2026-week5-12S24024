<x-layout title="Dashboard Perpustakaan">
    <!-- Header Halaman -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-2 py-1 rounded-pill mb-2" style="background-color: var(--del-soft-purple); border: 1px solid var(--del-border-purple);">
                <i class="bi bi-mortarboard-fill text-primary" style="font-size: 0.8rem; color: var(--del-primary) !important;"></i>
                <span class="small fw-bold" style="font-size: 0.75rem; color: var(--del-primary);">Institut Teknologi Del &bull; Sistem Informasi Perpustakaan</span>
            </div>
            <h1 class="h3 fw-bold text-dark mb-1">Dashboard Perpustakaan</h1>
            <p class="text-muted small mb-0">Selamat datang di sistem manajemen buku, sirkulasi peminjaman, dan analitik perpustakaan Kampus Del.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            @auth
                <a href="{{ route('peminjaman.create') }}" class="btn btn-del btn-sm">
                    <i class="bi bi-arrow-left-right"></i> Catat Peminjaman
                </a>
                <a href="{{ route('buku.create') }}" class="btn btn-outline-del btn-sm">
                    <i class="bi bi-plus-lg"></i> Tambah Buku
                </a>
            @else
                <a href="{{ route('buku.index') }}" class="btn btn-del btn-sm">
                    <i class="bi bi-journals"></i> Jelajahi Buku
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-del btn-sm">
                    <i class="bi bi-box-arrow-in-right"></i> Login Pustakawan
                </a>
            @endauth
        </div>
    </div>

    <!-- Banner Informasi SIPUS-Del (Bertema Del Royal Purple) -->
    <div class="ui-card p-4 mb-4" style="background: linear-gradient(135deg, #FAF5FF 0%, #F3E8FF 55%, #E9D5FF 100%); border: 1px solid var(--del-border-purple); box-shadow: 0 4px 15px rgba(76, 29, 149, 0.08);">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge" style="background-color: #4C1D95; color: #FFFFFF; font-size: 0.75rem; font-weight: 700; padding: 0.35rem 0.65rem;">Tentang Aplikasi</span>
                    <span class="text-muted small fw-semibold">Institut Teknologi Del &bull; Kampus Laguboti</span>
                </div>
                <h2 class="h4 fw-bold mb-2" style="color: var(--del-deep); letter-spacing: -0.02em;">
                    Mengenal SIPUS-Del
                </h2>
                <p class="text-secondary small mb-3" style="line-height: 1.75; font-size: 0.925rem;">
                    <strong>SIPUS-Del</strong> adalah aplikasi perpustakaan resmi yang digunakan untuk mengelola seluruh data buku dan sirkulasi peminjaman di kampus <strong>Institut Teknologi Del</strong>. Terintegrasi dengan transaksi ACID, penguncian baris <em>lockForUpdate</em>, dan manajemen sesi pustakawan.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-white text-dark border px-3 py-2 fw-semibold" style="font-size: 0.775rem;">
                        <i class="bi bi-award-fill text-warning me-1"></i> Nilai Luhur Del: MarTuhan, Marroha, Marbisuk
                    </span>
                    <span class="badge bg-white text-dark border px-3 py-2 fw-semibold" style="font-size: 0.775rem;">
                        <i class="bi bi-shield-check text-primary me-1"></i> Transaksi ACID Terproteksi
                    </span>
                    <span class="badge bg-white text-dark border px-3 py-2 fw-semibold" style="font-size: 0.775rem;">
                        <i class="bi bi-check2-circle text-success me-1"></i> Informasi Stok Selalu Real-Time
                    </span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-white p-3 rounded-3 border" style="border-color: var(--del-border-purple) !important; box-shadow: 0 2px 8px rgba(76, 29, 149, 0.06);">
                    <div class="fw-bold text-dark small mb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-lightning-charge-fill text-warning"></i> Keunggulan Sirkulasi Week 6:
                    </div>
                    <ul class="list-unstyled mb-0 small text-secondary" style="line-height: 1.8; font-size: 0.825rem;">
                        <li class="d-flex align-items-start gap-2 mb-1">
                            <i class="bi bi-lock-fill mt-1" style="color: var(--del-primary);"></i>
                            <span><strong>Pessimistic Locking:</strong> Mencegah race condition perebutan eksemplar buku terakhir.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2 mb-1">
                            <i class="bi bi-arrow-repeat mt-1" style="color: var(--del-primary);"></i>
                            <span><strong>Rollback Atomik:</strong> Tolak otomatis jika stok fisik buku = 0.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <i class="bi bi-shield-lock mt-1" style="color: var(--del-primary);"></i>
                            <span><strong>Session Security:</strong> Regenerasi ID sesi untuk mencegah Session Fixation.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- 4 Kartu Metrik Analitik (Dihitung Menggunakan Fluent Query Builder DB::table) -->
    <div class="row g-3 mb-4">
        <!-- Kartu 1: Total Judul Buku -->
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('buku.index') }}" class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.725rem; letter-spacing: 0.05em;">Total Judul Buku</span>
                    <div class="stat-icon" style="background-color: var(--del-soft-purple); color: var(--del-primary);">
                        <i class="bi bi-journal-text"></i>
                    </div>
                </div>
                <div class="h2 fw-bold mb-1" style="color: var(--del-deep);">{{ number_format($totalJudul) }}</div>
                <div class="small text-muted d-flex align-items-center justify-content-between">
                    <span>{{ number_format($totalKategori) }} bidang keilmuan</span>
                    <span class="fw-semibold" style="font-size: 0.75rem; color: var(--del-primary);">Katalog &rarr;</span>
                </div>
            </a>
        </div>

        <!-- Kartu 2: Total Stok Fisik -->
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
                    Eksemplar fisik di rak kampus
                </div>
            </div>
        </div>

        <!-- Kartu 3: Sedang Dipinjam -->
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('peminjaman.index', ['status' => 'dipinjam']) }}" class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.725rem; letter-spacing: 0.05em;">Sedang Dipinjam</span>
                    <div class="stat-icon" style="background-color: #FFFBEB; color: #D97706;">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
                <div class="h2 fw-bold text-warning mb-1">{{ number_format($totalDipinjam) }}</div>
                <div class="small text-muted d-flex align-items-center justify-content-between">
                    <span>Buku aktif di mahasiswa</span>
                    <span class="fw-semibold text-warning" style="font-size: 0.75rem;">Sirkulasi &rarr;</span>
                </div>
            </a>
        </div>

        <!-- Kartu 4: Telah Dikembalikan -->
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('peminjaman.index', ['status' => 'dikembalikan']) }}" class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.725rem; letter-spacing: 0.05em;">Telah Dikembalikan</span>
                    <div class="stat-icon" style="background-color: #EFF6FF; color: #2563EB;">
                        <i class="bi bi-check2-circle"></i>
                    </div>
                </div>
                <div class="h2 fw-bold text-primary mb-1">{{ number_format($totalDikembalikan) }}</div>
                <div class="small text-muted d-flex align-items-center justify-content-between">
                    <span>Transaksi selesai</span>
                    <span class="fw-semibold text-primary" style="font-size: 0.75rem;">Riwayat &rarr;</span>
                </div>
            </a>
        </div>
    </div>

    <!-- 1. Koleksi Buku Terbaru (Full-Width Layout - Bebas Geser Horizontal) -->
    <div class="ui-card mb-4">
        <div class="ui-card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                <h2 class="ui-card-title mb-1">
                    <i class="bi bi-journal-plus" style="color: var(--del-primary);"></i> Koleksi Buku Terbaru
                </h2>
                <div class="text-muted small">Daftar koleksi buku terbaru di perpustakaan dengan metrik ketersediaan dan sirkulasi</div>
            </div>
            <div class="d-flex align-items-center gap-2">
                @auth
                    <a href="{{ route('buku.create') }}" class="btn btn-sm btn-del">
                        <i class="bi bi-plus-lg"></i> Tambah Buku
                    </a>
                @endauth
                <a href="{{ route('buku.index') }}" class="btn btn-sm btn-outline-del">
                    Lihat Semua Koleksi <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-del align-middle mb-0 w-100">
                <thead>
                    <tr>
                        <th style="min-width: 240px;">Buku &amp; Penulis</th>
                        <th style="min-width: 140px;">ISBN</th>
                        <th style="min-width: 140px;">Kategori</th>
                        <th class="text-center" style="min-width: 80px;">Tahun</th>
                        <th class="text-center" style="min-width: 120px;">Sirkulasi</th>
                        <th class="text-center" style="min-width: 130px;">Ketersediaan</th>
                        <th class="text-end" style="min-width: 80px;">Aksi</th>
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
                                <span class="font-monospace small text-secondary bg-light px-2 py-1 rounded border">
                                    {{ $buku->isbn }}
                                </span>
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
                            <td class="text-center text-secondary small fw-medium">
                                {{ $buku->tahun_terbit }}
                            </td>
                            <td class="text-center">
                                <span class="badge" style="background-color: var(--del-soft-purple); color: var(--del-primary); border: 1px solid var(--del-border-purple); font-size: 0.75rem; padding: 0.35rem 0.6rem;">
                                    <i class="bi bi-arrow-repeat me-1"></i>{{ $buku->peminjamans_count }}x dipinjam
                                </span>
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
                                    <i class="bi bi-arrow-up-right" style="color: var(--del-primary);"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-journal-x fs-2 d-block mb-2" style="color: var(--del-primary);"></i>
                                Belum ada koleksi buku yang terdaftar di perpustakaan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 2. Sirkulasi Peminjaman Aktif Terbaru (Full-Width Layout) -->
    <div class="ui-card mb-4">
        <div class="ui-card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                <h2 class="ui-card-title mb-1">
                    <i class="bi bi-hourglass-split" style="color: var(--del-primary);"></i> Sirkulasi Peminjaman Aktif Terbaru
                </h2>
                <div class="text-muted small">Daftar mahasiswa yang sedang meminjam buku fisik di perpustakaan</div>
            </div>
            <div class="d-flex align-items-center gap-2">
                @auth
                    <a href="{{ route('peminjaman.create') }}" class="btn btn-sm btn-del">
                        <i class="bi bi-arrow-left-right"></i> Pinjam Buku
                    </a>
                @endauth
                <a href="{{ route('peminjaman.index', ['status' => 'dipinjam']) }}" class="btn btn-sm btn-outline-del">
                    Lihat Semua Peminjaman <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-del align-middle mb-0 w-100">
                <thead>
                    <tr>
                        <th style="min-width: 140px;">Kode Pinjam</th>
                        <th style="min-width: 240px;">Buku yang Dipinjam</th>
                        <th style="min-width: 200px;">Mahasiswa Peminjam</th>
                        <th class="text-center" style="min-width: 140px;">Jatuh Tempo</th>
                        <th class="text-center" style="min-width: 110px;">Status</th>
                        <th class="text-end" style="min-width: 110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentPeminjamans as $pinjam)
                        <tr>
                            <td>
                                <span class="font-monospace fw-bold small px-2 py-1 rounded border" style="background-color: var(--del-soft-purple); color: var(--del-primary); border-color: var(--del-border-purple) !important;">
                                    {{ $pinjam->kode_pinjam }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">
                                    {{ $pinjam->buku->judul ?? 'Buku Perpustakaan' }}
                                </div>
                                <div class="small text-muted">
                                    <i class="bi bi-person me-1"></i>{{ $pinjam->buku->penulis ?? '-' }}
                                </div>
                            </td>
                            <td>
                                <div class="fw-medium text-dark">
                                    {{ $pinjam->nama_peminjam }}
                                </div>
                                <div class="small text-muted font-monospace">
                                    NIM: {{ $pinjam->nim_peminjam }}
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge" style="background-color: var(--del-warning-bg); color: var(--del-warning-text); border: 1px solid var(--del-warning-border); font-size: 0.75rem; padding: 0.35rem 0.6rem;">
                                    <i class="bi bi-calendar-event me-1"></i>{{ \Carbon\Carbon::parse($pinjam->tanggal_jatuh_tempo)->translatedFormat('d M Y') }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge-status badge-status-menipis">
                                    <i class="bi bi-clock"></i> Dipinjam
                                </span>
                            </td>
                            <td class="text-end">
                                @auth
                                    <form method="POST" action="{{ route('peminjaman.kembalikan', $pinjam) }}" class="m-0 d-inline" onsubmit="return confirm('Kembalikan buku ini? Stok akan otomatis bertambah 1.');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success py-1 px-2" style="font-size: 0.775rem;" title="Kembalikan Buku">
                                            <i class="bi bi-check2-circle me-1"></i> Kembalikan
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted small">&mdash;</span>
                                @endauth
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-check2-circle fs-3 d-block mb-1 text-success"></i>
                                <div class="small fw-semibold">Tidak ada pinjaman aktif</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Seluruh koleksi buku fisik saat ini berada di rak perpustakaan.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
