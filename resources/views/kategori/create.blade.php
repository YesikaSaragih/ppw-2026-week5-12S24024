<x-layout title="Tambah Kategori Baru">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="page-header d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="page-title">Tambah Kategori Baru</h1>
                    <p class="page-subtitle mb-0">Daftarkan klasifikasi bidang keilmuan buku baru</p>
                </div>
                <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="card card-del shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <!-- Kode Kategori -->
                            <div class="col-12">
                                <label for="kode_kategori" class="form-label fw-semibold">Kode Kategori <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control font-monospace @error('kode_kategori') is-invalid @enderror"
                                       id="kode_kategori"
                                       name="kode_kategori"
                                       value="{{ old('kode_kategori') }}"
                                       placeholder="Contoh: KAT-RPL"
                                       maxlength="10"
                                       required>
                                @error('kode_kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Maksimal 10 karakter dan harus unik.</div>
                            </div>

                            <!-- Nama Kategori -->
                            <div class="col-12">
                                <label for="nama_kategori" class="form-label fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('nama_kategori') is-invalid @enderror"
                                       id="nama_kategori"
                                       name="nama_kategori"
                                       value="{{ old('nama_kategori') }}"
                                       placeholder="Contoh: Rekayasa Perangkat Lunak & Web"
                                       maxlength="100"
                                       required>
                                @error('nama_kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Maksimal 100 karakter deskripsi bidang keilmuan.</div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="col-12 d-flex justify-content-end gap-2 pt-3 border-top mt-4">
                                <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-del">
                                    <i class="bi bi-save me-1"></i> Simpan Kategori
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
