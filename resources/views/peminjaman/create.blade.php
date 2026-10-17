<x-layout title="Catat Peminjaman Buku">
    <!-- Header Halaman -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-2 py-1 rounded-pill mb-1" style="background-color: var(--del-soft-purple); border: 1px solid var(--del-border-purple);">
                <i class="bi bi-arrow-left-right" style="font-size: 0.75rem; color: var(--del-primary);"></i>
                <span class="small fw-bold" style="font-size: 0.725rem; color: var(--del-primary);">Sirkulasi Perpustakaan</span>
            </div>
            <h1 class="h4 fw-bold text-dark mb-1">Catat Peminjaman Buku</h1>
            <p class="text-muted small mb-0">Input transaksi sirkulasi peminjaman buku fisik mahasiswa Institut Teknologi Del.</p>
        </div>
        <div>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-del">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Sirkulasi
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Form Utama Peminjaman -->
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm" style="border-radius: 14px; border: 1px solid var(--del-border); background-color: var(--del-surface);">
                <div class="card-header bg-white border-bottom p-4">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-pencil-square" style="color: var(--del-primary);"></i>
                        <h2 class="h6 fw-bold text-dark mb-0">Formulir Transaksi Peminjaman (ACID Transaction)</h2>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('peminjaman.store') }}" novalidate>
                        @csrf

                        <!-- Pilihan Buku Fisik -->
                        <div class="mb-4">
                            <label for="buku_id" class="form-label fw-semibold text-dark small">
                                Pilih Buku yang Dipinjam <span class="text-danger">*</span>
                            </label>
                            <select name="buku_id" id="buku_id" class="form-select @error('buku_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Buku yang Tersedia --</option>
                                @foreach ($bukus as $buku)
                                    <option value="{{ $buku->id }}"
                                        {{ (string) old('buku_id', $selectedBukuId) === (string) $buku->id ? 'selected' : '' }}>
                                        {{ $buku->judul }} — Stok: {{ $buku->stok }} eks (ISBN: {{ $buku->isbn }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text text-muted small">
                                Hanya buku dengan stok fisik tersedia (&gt; 0) yang ditampilkan di daftar dropdown ini.
                            </div>
                            @error('buku_id')
                                <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Data Peminjam (Mahasiswa Del) -->
                        <div class="row g-3 mb-4">
                            <div class="col-12 col-md-5">
                                <label for="nim_peminjam" class="form-label fw-semibold text-dark small">
                                    NIM Mahasiswa <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-muted">
                                        <i class="bi bi-person-badge"></i>
                                    </span>
                                    <input type="text"
                                           name="nim_peminjam"
                                           id="nim_peminjam"
                                           class="form-control text-uppercase @error('nim_peminjam') is-invalid @enderror"
                                           placeholder="Contoh: 12S24001"
                                           value="{{ old('nim_peminjam', session('last_borrower_nim')) }}"
                                           required>
                                </div>
                                @if (session('last_borrower_nim'))
                                    <div class="form-text text-muted small" style="font-size: 0.725rem;">
                                        <i class="bi bi-clock-history"></i> Mengambil data peminjam terakhir dari sesi.
                                    </div>
                                @endif
                                @error('nim_peminjam')
                                    <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-7">
                                <label for="nama_peminjam" class="form-label fw-semibold text-dark small">
                                    Nama Lengkap Mahasiswa <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-muted">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text"
                                           name="nama_peminjam"
                                           id="nama_peminjam"
                                           class="form-control @error('nama_peminjam') is-invalid @enderror"
                                           placeholder="Nama lengkap peminjam..."
                                           value="{{ old('nama_peminjam', session('last_borrower_name')) }}"
                                           required>
                                </div>
                                @error('nama_peminjam')
                                    <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Jadwal Peminjaman & Jatuh Tempo -->
                        <div class="row g-3 mb-4">
                            <div class="col-12 col-md-6">
                                <label for="tanggal_pinjam" class="form-label fw-semibold text-dark small">
                                    Tanggal Peminjaman <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-muted">
                                        <i class="bi bi-calendar-event"></i>
                                    </span>
                                    <input type="date"
                                           name="tanggal_pinjam"
                                           id="tanggal_pinjam"
                                           class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                                           value="{{ old('tanggal_pinjam', now()->toDateString()) }}"
                                           required>
                                </div>
                                @error('tanggal_pinjam')
                                    <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="tanggal_jatuh_tempo" class="form-label fw-semibold text-dark small">
                                    Tanggal Jatuh Tempo (Kembali) <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-muted">
                                        <i class="bi bi-calendar-check"></i>
                                    </span>
                                    <input type="date"
                                           name="tanggal_jatuh_tempo"
                                           id="tanggal_jatuh_tempo"
                                           class="form-control @error('tanggal_jatuh_tempo') is-invalid @enderror"
                                           value="{{ old('tanggal_jatuh_tempo', now()->addDays(7)->toDateString()) }}"
                                           required>
                                </div>
                                <div class="form-text text-muted small">
                                    Standar durasi peminjaman perpustakaan adalah 7 hari kalender.
                                </div>
                                @error('tanggal_jatuh_tempo')
                                    <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex align-items-center gap-2 pt-3 border-top">
                            <button type="submit" class="btn btn-del">
                                <i class="bi bi-check-lg"></i> Simpan Peminjaman (Atomik)
                            </button>
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Kolom Informasi Aturan & Jaminan ACID -->
        <div class="col-12 col-lg-4">
            <!-- Jaminan ACID Card -->
            <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 14px; border: 1px solid var(--del-border); background-color: var(--del-surface);">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="p-2 rounded-circle" style="background-color: var(--del-soft-purple); color: var(--del-primary);">
                        <i class="bi bi-shield-check fs-5"></i>
                    </div>
                    <h3 class="h6 fw-bold text-dark mb-0">Jaminan Transaksi ACID</h3>
                </div>

                <ul class="list-unstyled mb-0 small" style="line-height: 1.7;">
                    <li class="mb-2 d-flex gap-2">
                        <i class="bi bi-lock-fill text-primary mt-1"></i>
                        <span><strong>Pessimistic Locking:</strong> Baris data buku dikunci dengan <code>lockForUpdate()</code> untuk mencegah *Race Condition* saat beberapa pustakawan memproses buku bersamaan.</span>
                    </li>
                    <li class="mb-2 d-flex gap-2">
                        <i class="bi bi-arrow-repeat text-success mt-1"></i>
                        <span><strong>Atomicity &amp; Rollback:</strong> Jika stok buku habis atau database mengalami kendala, seluruh proses dibatalkan otomatis dan stok tidak berkurang secara inkonsisten.</span>
                    </li>
                    <li class="d-flex gap-2">
                        <i class="bi bi-person-x-fill text-warning mt-1"></i>
                        <span><strong>Integritas Pinjaman:</strong> Sistem memverifikasi bahwa mahasiswa dengan NIM yang sama tidak dapat meminjam kembali buku yang sedang aktif dipinjam sebelum dikembalikan.</span>
                    </li>
                </ul>
            </div>

            <!-- Panduan Pustakawan -->
            <div class="card border-0 shadow-sm p-4" style="border-radius: 14px; background-color: var(--del-lightest-purple); border: 1px solid var(--del-border-purple);">
                <h4 class="h6 fw-bold mb-2" style="color: var(--del-primary);">Panduan Petugas Pustakawan</h4>
                <p class="small text-muted mb-0">
                    Periksa kartu tanda mahasiswa (KTM) peminjam dan pastikan kondisi fisik buku dalam keadaan prima sebelum menyerahkan buku kepada mahasiswa.
                </p>
            </div>
        </div>
    </div>
</x-layout>
