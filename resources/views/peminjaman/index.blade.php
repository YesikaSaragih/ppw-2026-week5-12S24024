<x-layout title="Sirkulasi Peminjaman Buku">
    <!-- Header Halaman -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-2 py-1 rounded-pill mb-1" style="background-color: var(--del-soft-purple); border: 1px solid var(--del-border-purple);">
                <i class="bi bi-arrow-left-right" style="font-size: 0.75rem; color: var(--del-primary);"></i>
                <span class="small fw-bold" style="font-size: 0.725rem; color: var(--del-primary);">Sirkulasi Perpustakaan</span>
            </div>
            <h1 class="h4 fw-bold text-dark mb-1">Sirkulasi Peminjaman Buku</h1>
            <p class="text-muted small mb-0">Kelola peminjaman mahasiswa, pemantauan tenggat waktu pengembalian, dan riwayat sirkulasi.</p>
        </div>
        <div>
            <a href="{{ route('peminjaman.create') }}" class="btn btn-del">
                <i class="bi bi-plus-lg"></i> Catat Peminjaman Baru
            </a>
        </div>
    </div>

    <!-- Metrik Analitik Sirkulasi (Fluent Query Builder Stats) -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-4">
            <div class="card border-0 shadow-sm p-3" style="border-radius: 12px; border: 1px solid var(--del-border); background-color: var(--del-surface);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-medium" style="font-size: 0.75rem;">TOTAL TRANSAKSI</div>
                        <div class="h3 fw-bold text-dark mb-0 mt-1">{{ number_format($stats['total_transaksi'] ?? 0) }}</div>
                    </div>
                    <div class="p-3 rounded-circle" style="background-color: var(--del-soft-purple); color: var(--del-primary);">
                        <i class="bi bi-journal-check fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card border-0 shadow-sm p-3" style="border-radius: 12px; border: 1px solid var(--del-border); background-color: var(--del-surface);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-medium" style="font-size: 0.75rem;">SEDANG DIPINJAM</div>
                        <div class="h3 fw-bold text-warning mb-0 mt-1">{{ number_format($stats['total_dipinjam'] ?? 0) }}</div>
                    </div>
                    <div class="p-3 rounded-circle" style="background-color: var(--del-warning-bg); color: var(--del-warning-text);">
                        <i class="bi bi-hourglass-split fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card border-0 shadow-sm p-3" style="border-radius: 12px; border: 1px solid var(--del-border); background-color: var(--del-surface);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-medium" style="font-size: 0.75rem;">TELAH DIKEMBALIKAN</div>
                        <div class="h3 fw-bold text-success mb-0 mt-1">{{ number_format($stats['total_dikembalikan'] ?? 0) }}</div>
                    </div>
                    <div class="p-3 rounded-circle" style="background-color: var(--del-success-bg); color: var(--del-success-text);">
                        <i class="bi bi-check2-circle fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Status Filter Tabs & Pencarian Dinamis -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; border: 1px solid var(--del-border); background-color: var(--del-surface);">
        <div class="card-body p-3">
            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center">
                <!-- Status Pills -->
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('peminjaman.index', array_merge(request()->except('status', 'page'), [])) }}"
                       class="btn btn-sm {{ !request('status') ? 'btn-del' : 'btn-outline-del' }}"
                       style="border-radius: 20px; font-size: 0.8rem;">
                        <i class="bi bi-collection me-1"></i> Semua ({{ $stats['total_transaksi'] ?? 0 }})
                    </a>
                    <a href="{{ route('peminjaman.index', array_merge(request()->except('page'), ['status' => 'dipinjam'])) }}"
                       class="btn btn-sm {{ request('status') === 'dipinjam' ? 'btn-del' : 'btn-outline-del' }}"
                       style="border-radius: 20px; font-size: 0.8rem;">
                        <i class="bi bi-hourglass-split me-1"></i> Sedang Dipinjam ({{ $stats['total_dipinjam'] ?? 0 }})
                    </a>
                    <a href="{{ route('peminjaman.index', array_merge(request()->except('page'), ['status' => 'dikembalikan'])) }}"
                       class="btn btn-sm {{ request('status') === 'dikembalikan' ? 'btn-del' : 'btn-outline-del' }}"
                       style="border-radius: 20px; font-size: 0.8rem;">
                        <i class="bi bi-check-circle me-1"></i> Telah Dikembalikan ({{ $stats['total_dikembalikan'] ?? 0 }})
                    </a>
                </div>

                <!-- Form Filter & Pencarian Dinamis (when()) -->
                <form method="GET" action="{{ route('peminjaman.index') }}" class="d-flex gap-2">
                    @if (request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    <div class="input-group input-group-sm" style="min-width: 280px;">
                        <span class="input-group-text bg-white border-end-0 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text"
                               name="search"
                               class="form-control border-start-0"
                               placeholder="Cari NIM, peminjam, buku..."
                               value="{{ request('search', session('last_peminjaman_search')) }}">
                        @if (request('search'))
                            <a href="{{ route('peminjaman.index', request()->except('search', 'page')) }}" class="btn btn-outline-secondary border-start-0" title="Hapus filter pencarian">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                        <button type="submit" class="btn btn-del btn-sm px-3">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabel Data Sirkulasi -->
    <div class="card border-0 shadow-sm" style="border-radius: 14px; border: 1px solid var(--del-border); overflow: hidden; background-color: var(--del-surface);">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
                <thead style="background-color: var(--del-lightest-purple); border-bottom: 2px solid var(--del-border-purple);">
                    <tr>
                        <th class="ps-3 py-3 text-dark fw-bold" style="width: 140px;">KODE PINJAM</th>
                        <th class="py-3 text-dark fw-bold">BUKU</th>
                        <th class="py-3 text-dark fw-bold">PEMINJAM (MAHASISWA)</th>
                        <th class="py-3 text-dark fw-bold">TANGGAL PINJAM & TEMPO</th>
                        <th class="py-3 text-dark fw-bold text-center" style="width: 140px;">STATUS</th>
                        <th class="pe-3 py-3 text-dark fw-bold text-end" style="width: 140px;">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($peminjamans as $pinjam)
                        <tr>
                            <!-- Kode Pinjam -->
                            <td class="ps-3">
                                <div class="d-flex align-items-center gap-1">
                                    <span class="font-monospace fw-bold" style="color: var(--del-primary); font-size: 0.775rem;">
                                        {{ $pinjam->kode_pinjam }}
                                    </span>
                                    <button type="button" class="btn-copy" onclick="copyToClipboard('{{ $pinjam->kode_pinjam }}', this)" title="Salin kode">
                                        <i class="bi bi-clipboard" style="font-size: 0.75rem;"></i>
                                    </button>
                                </div>
                                <span class="badge" style="font-size: 0.65rem; background-color: var(--del-soft-purple); color: var(--del-primary); border: 1px solid var(--del-border-purple);">
                                    ID #{{ $pinjam->id }}
                                </span>
                            </td>

                            <!-- Info Buku -->
                            <td>
                                @if ($pinjam->buku)
                                    <a href="{{ route('buku.show', $pinjam->buku) }}" class="fw-semibold text-dark text-decoration-none d-block">
                                        {{ $pinjam->buku->judul }}
                                    </a>
                                    <div class="d-flex align-items-center gap-2 mt-1" style="font-size: 0.75rem; color: var(--del-text-muted);">
                                        <span>ISBN: {{ $pinjam->buku->isbn }}</span>
                                        @if ($pinjam->buku->kategori)
                                            &bull;
                                            <span class="badge text-bg-light border" style="font-size: 0.7rem;">
                                                {{ $pinjam->buku->kategori->nama_kategori }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted fst-italic">Buku telah dihapus dari katalog</span>
                                @endif
                            </td>

                            <!-- Peminjam -->
                            <td>
                                <div class="fw-bold text-dark">{{ $pinjam->nama_peminjam }}</div>
                                <div class="text-muted" style="font-size: 0.775rem;">
                                    NIM: <code class="text-dark fw-semibold">{{ $pinjam->nim_peminjam }}</code>
                                </div>
                            </td>

                            <!-- Tanggal Pinjam & Jatuh Tempo -->
                            <td>
                                <div class="small">
                                    <span class="text-muted">Pinjam:</span> {{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->translatedFormat('d M Y') }}
                                </div>
                                <div class="small">
                                    @php
                                        $tempo = \Carbon\Carbon::parse($pinjam->tanggal_jatuh_tempo);
                                        $isOverdue = $pinjam->status === 'dipinjam' && $tempo->isPast() && !$tempo->isToday();
                                    @endphp
                                    <span class="text-muted">Tempo:</span>
                                    <span class="{{ $isOverdue ? 'text-danger fw-bold' : 'text-dark' }}">
                                        {{ $tempo->translatedFormat('d M Y') }}
                                    </span>
                                    @if ($isOverdue)
                                        <span class="badge text-bg-danger ms-1" style="font-size: 0.65rem;">Terlambat</span>
                                    @endif
                                </div>
                                @if ($pinjam->tanggal_kembali)
                                    <div class="text-success small" style="font-size: 0.75rem;">
                                        <i class="bi bi-check-all"></i> Kembali: {{ \Carbon\Carbon::parse($pinjam->tanggal_kembali)->translatedFormat('d M Y') }}
                                    </div>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="text-center">
                                @if ($pinjam->status === 'dipinjam')
                                    <span class="badge" style="background-color: var(--del-warning-bg); color: var(--del-warning-text); border: 1px solid var(--del-warning-border); font-size: 0.75rem; padding: 0.35rem 0.65rem;">
                                        <i class="bi bi-hourglass-split me-1"></i> Sedang Dipinjam
                                    </span>
                                @else
                                    <span class="badge" style="background-color: var(--del-success-bg); color: var(--del-success-text); border: 1px solid var(--del-success-border); font-size: 0.75rem; padding: 0.35rem 0.65rem;">
                                        <i class="bi bi-check-circle me-1"></i> Dikembalikan
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="pe-3 text-end">
                                @if ($pinjam->status === 'dipinjam')
                                    <form method="POST" action="{{ route('peminjaman.kembalikan', $pinjam) }}" class="d-inline" onsubmit="return confirm('Proses pengembalian buku \'{{ addslashes($pinjam->buku->judul ?? $pinjam->kode_pinjam) }}\'? Stok buku akan otomatis bertambah 1.');">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success btn-sm py-1 px-2" style="font-size: 0.775rem;" title="Kembalikan Buku">
                                            <i class="bi bi-box-arrow-in-down-left"></i> Kembalikan
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted small">
                                        <i class="bi bi-check2-all text-success fs-6"></i> Selesai
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <div class="p-3 d-inline-flex rounded-circle mb-3" style="background-color: var(--del-lightest-purple); color: var(--del-primary);">
                                    <i class="bi bi-journal-x fs-2"></i>
                                </div>
                                <h6 class="fw-bold text-dark">Belum Ada Transaksi Sirkulasi</h6>
                                <p class="small text-muted mb-3">Tidak ditemukan catatan peminjaman yang sesuai dengan filter saat ini.</p>
                                <a href="{{ route('peminjaman.create') }}" class="btn btn-del btn-sm">
                                    <i class="bi bi-plus-lg"></i> Catat Peminjaman Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($peminjamans->hasPages())
            <div class="card-footer bg-white border-top p-3 d-flex justify-content-between align-items-center">
                <div class="small text-muted">
                    Menampilkan {{ $peminjamans->firstItem() }} - {{ $peminjamans->lastItem() }} dari {{ $peminjamans->total() }} data peminjaman
                </div>
                <div>
                    {{ $peminjamans->links() }}
                </div>
            </div>
        @endif
    </div>
</x-layout>
