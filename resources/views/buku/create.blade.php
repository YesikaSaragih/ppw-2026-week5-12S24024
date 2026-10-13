<x-layout title="Tambah Buku Baru">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">
            <!-- Header Navigasi -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-2 py-1 rounded-pill mb-1" style="background-color: var(--del-soft-purple); border: 1px solid var(--del-border-purple);">
                        <i class="bi bi-plus-circle-fill" style="font-size: 0.75rem; color: var(--del-primary);"></i>
                        <span class="small fw-bold" style="font-size: 0.725rem; color: var(--del-primary);">Formulir Buku Baru</span>
                    </div>
                    <h1 class="h4 fw-bold text-dark mb-1">Tambah Buku Baru</h1>
                    <p class="text-muted small mb-0">Isi formulir di bawah ini dengan lengkap untuk mendaftarkan buku ke perpustakaan Del.</p>
                </div>
                <a href="{{ route('buku.index') }}" class="btn btn-secondary-del btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>

            <form action="{{ route('buku.store') }}" method="POST">
                @csrf

                <!-- Bagian 1: Identitas Buku -->
                <div class="ui-card mb-4">
                    <div class="ui-card-header" style="background: linear-gradient(180deg, var(--del-lightest-purple) 0%, #FFFFFF 100%);">
                        <span class="ui-card-title">
                            <span class="p-1 rounded bg-white border d-inline-flex align-items-center justify-content-center me-1" style="width: 26px; height: 26px; color: var(--del-primary);">
                                <i class="bi bi-info-circle"></i>
                            </span>
                            1. Informasi Utama Buku
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
                                <div class="form-text" style="font-size: 0.75rem;">Nomor ISBN unik (10 sampai 20 karakter).</div>
                            </div>
                            <div class="col-md-8">
                                <label for="judul" class="form-label">Judul Buku <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('judul') is-invalid @enderror"
                                       id="judul"
                                       name="judul"
                                       value="{{ old('judul') }}"
                                       placeholder="Contoh: Algoritma dan Struktur Data"
                                       required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text" style="font-size: 0.75rem;">Minimal 5 karakter sesuai sampul buku.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bagian 2: Penulis & Penerbit -->
                <div class="ui-card mb-4">
                    <div class="ui-card-header" style="background: linear-gradient(180deg, var(--del-lightest-purple) 0%, #FFFFFF 100%);">
                        <span class="ui-card-title">
                            <span class="p-1 rounded bg-white border d-inline-flex align-items-center justify-content-center me-1" style="width: 26px; height: 26px; color: var(--del-primary);">
                                <i class="bi bi-person-badge"></i>
                            </span>
                            2. Penulis dan Penerbit
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
                                       placeholder="Contoh: Dr. Arnaldo Marulitua Sinaga"
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
                                       placeholder="Contoh: Penerbit Informatika"
                                       required>
                                @error('penerbit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bagian 3: Kategori, Tahun, & Stok -->
                <div class="ui-card mb-4">
                    <div class="ui-card-header" style="background: linear-gradient(180deg, var(--del-lightest-purple) 0%, #FFFFFF 100%);">
                        <span class="ui-card-title">
                            <span class="p-1 rounded bg-white border d-inline-flex align-items-center justify-content-center me-1" style="width: 26px; height: 26px; color: var(--del-primary);">
                                <i class="bi bi-tags"></i>
                            </span>
                            3. Kategori dan Persediaan Stok
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
                                       max="{{ date('Y') + 1 }}"
                                       placeholder="{{ date('Y') }}"
                                       required>
                                @error('tahun_terbit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="stok" class="form-label">Jumlah Stok Buku <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number"
                                           class="form-control @error('stok') is-invalid @enderror"
                                           id="stok"
                                           name="stok"
                                           value="{{ old('stok', 1) }}"
                                           min="0"
                                           required>
                                    <span class="input-group-text bg-light text-muted">eksemplar</span>
                                </div>
                                @error('stok')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="form-text" style="font-size: 0.75rem;">Isi 0 jika buku fisik sedang belum tersedia.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bagian 4: Sinopsis / Ringkasan -->
                <div class="ui-card mb-4">
                    <div class="ui-card-header" style="background: linear-gradient(180deg, var(--del-lightest-purple) 0%, #FFFFFF 100%);">
                        <span class="ui-card-title">
                            <span class="p-1 rounded bg-white border d-inline-flex align-items-center justify-content-center me-1" style="width: 26px; height: 26px; color: var(--del-primary);">
                                <i class="bi bi-text-paragraph"></i>
                            </span>
                            4. Sinopsis / Ringkasan Buku (Opsional)
                        </span>
                    </div>
                    <div class="ui-card-body">
                        <textarea class="form-control @error('sinopsis') is-invalid @enderror"
                                  id="sinopsis"
                                  name="sinopsis"
                                  rows="4"
                                  placeholder="Tuliskan ringkasan singkat mengenai topik atau isi buku ini...">{{ old('sinopsis') }}</textarea>
                        @error('sinopsis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text" style="font-size: 0.75rem;">Membantu pembaca memahami topik buku sebelum meminjam.</div>
                    </div>
                </div>

                <!-- Tombol Simpan & Batal -->
                <div class="d-flex justify-content-end gap-2 mb-5">
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary-del">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-del">
                        <i class="bi bi-check-lg"></i> Simpan Buku Baru
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
