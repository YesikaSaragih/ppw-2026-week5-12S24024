<x-layout title="Tambah Buku Baru">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">
            <!-- Header Navigasi -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-2 py-1 rounded-pill mb-1" style="background-color: var(--del-soft-blue); border: 1px solid var(--del-border-blue);">
                        <i class="bi bi-plus-circle-fill text-primary" style="font-size: 0.75rem;"></i>
                        <span class="small fw-bold text-primary" style="font-size: 0.725rem;">Formulir Pendaftaran Pustaka</span>
                    </div>
                    <h1 class="h4 fw-bold text-dark mb-1">Tambah Buku Baru</h1>
                    <p class="text-muted small mb-0">Isi formulir secara lengkap untuk mendaftarkan katalog buku ke perpustakaan Del.</p>
                </div>
                <a href="{{ route('buku.index') }}" class="btn btn-secondary-del btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>

            <form action="{{ route('buku.store') }}" method="POST">
                @csrf

                <!-- Seksi 1: Identitas Buku -->
                <div class="ui-card mb-4">
                    <div class="ui-card-header" style="background: linear-gradient(180deg, var(--del-lightest-blue) 0%, #FFFFFF 100%);">
                        <span class="ui-card-title">
                            <span class="p-1 rounded bg-white border d-inline-flex align-items-center justify-content-center me-1" style="width: 26px; height: 26px; color: var(--del-primary);">
                                <i class="bi bi-info-circle"></i>
                            </span>
                            1. Identitas Utama Buku
                        </span>
                    </div>
                    <div class="ui-card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="isbn" class="form-label">Nomor ISBN <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control font-monospace @error('isbn') is-invalid @enderror"
                                       id="isbn"
                                       name="isbn"
                                       value="{{ old('isbn') }}"
                                       placeholder="Contoh: 978-602-1234-56-7"
                                       required>
                                @error('isbn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label for="judul" class="form-label">Judul Buku <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('judul') is-invalid @enderror"
                                       id="judul"
                                       name="judul"
                                       value="{{ old('judul') }}"
                                       placeholder="Contoh: Pemrograman Web dengan Laravel Modern"
                                       required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text" style="font-size: 0.75rem;">Minimal 5 karakter, maksimal 200 karakter.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seksi 2: Kepengarangan & Penerbitan -->
                <div class="ui-card mb-4">
                    <div class="ui-card-header" style="background: linear-gradient(180deg, var(--del-lightest-blue) 0%, #FFFFFF 100%);">
                        <span class="ui-card-title">
                            <span class="p-1 rounded bg-white border d-inline-flex align-items-center justify-content-center me-1" style="width: 26px; height: 26px; color: var(--del-primary);">
                                <i class="bi bi-person-badge"></i>
                            </span>
                            2. Kepengarangan &amp; Penerbit
                        </span>
                    </div>
                    <div class="ui-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="penulis" class="form-label">Nama Penulis <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('penulis') is-invalid @enderror"
                                       id="penulis"
                                       name="penulis"
                                       value="{{ old('penulis') }}"
                                       placeholder="Contoh: Chandro Pardede, M.Sc."
                                       required>
                                @error('penulis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="penerbit" class="form-label">Penerbit <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('penerbit') is-invalid @enderror"
                                       id="penerbit"
                                       name="penerbit"
                                       value="{{ old('penerbit') }}"
                                       placeholder="Contoh: Del Press"
                                       required>
                                @error('penerbit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seksi 3: Klasifikasi, Tahun, & Inventaris -->
                <div class="ui-card mb-4">
                    <div class="ui-card-header" style="background: linear-gradient(180deg, var(--del-lightest-blue) 0%, #FFFFFF 100%);">
                        <span class="ui-card-title">
                            <span class="p-1 rounded bg-white border d-inline-flex align-items-center justify-content-center me-1" style="width: 26px; height: 26px; color: var(--del-primary);">
                                <i class="bi bi-tags"></i>
                            </span>
                            3. Klasifikasi &amp; Inventaris
                        </span>
                    </div>
                    <div class="ui-card-body">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label for="kategori_id" class="form-label">Kategori Bidang Ilmu <span class="text-danger">*</span></label>
                                <select class="form-select @error('kategori_id') is-invalid @enderror"
                                        id="kategori_id"
                                        name="kategori_id"
                                        required>
                                    <option value="" disabled {{ old('kategori_id') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                            [{{ $kategori->kode_kategori }}] {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="tahun_terbit" class="form-label">Tahun Terbit <span class="text-danger">*</span></label>
                                <input type="number"
                                       class="form-control @error('tahun_terbit') is-invalid @enderror"
                                       id="tahun_terbit"
                                       name="tahun_terbit"
                                       value="{{ old('tahun_terbit', date('Y')) }}"
                                       min="1900"
                                       max="{{ date('Y') }}"
                                       required>
                                @error('tahun_terbit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="stok" class="form-label">Jumlah Stok (Eksemplar) <span class="text-danger">*</span></label>
                                <input type="number"
                                       class="form-control @error('stok') is-invalid @enderror"
                                       id="stok"
                                       name="stok"
                                       value="{{ old('stok', 1) }}"
                                       min="0"
                                       required>
                                @error('stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seksi 4: Sinopsis -->
                <div class="ui-card mb-4">
                    <div class="ui-card-header" style="background: linear-gradient(180deg, var(--del-lightest-blue) 0%, #FFFFFF 100%);">
                        <span class="ui-card-title">
                            <span class="p-1 rounded bg-white border d-inline-flex align-items-center justify-content-center me-1" style="width: 26px; height: 26px; color: var(--del-primary);">
                                <i class="bi bi-text-left"></i>
                            </span>
                            4. Deskripsi Sinopsis
                        </span>
                    </div>
                    <div class="ui-card-body">
                        <label for="sinopsis" class="form-label">Sinopsis / Ringkasan Isi</label>
                        <textarea class="form-control @error('sinopsis') is-invalid @enderror"
                                  id="sinopsis"
                                  name="sinopsis"
                                  rows="4"
                                  placeholder="Tulis ringkasan singkat konten buku ini...">{{ old('sinopsis') }}</textarea>
                        @error('sinopsis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Action Bar -->
                <div class="d-flex justify-content-end align-items-center gap-2 mb-5">
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary-del">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-del">
                        <i class="bi bi-check2"></i> Simpan Buku Baru
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
