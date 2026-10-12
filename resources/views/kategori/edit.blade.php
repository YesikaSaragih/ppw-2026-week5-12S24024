<x-layout title="Edit Kategori: {{ $kategori->nama_kategori }}">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="page-header d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="page-title">Edit Data Kategori</h1>
                    <p class="page-subtitle mb-0">Perbarui rincian kode atau nama kategori perpustakaan</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('kategori.show', $kategori) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-eye me-1"></i> Lihat Detail
                    </a>
                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Batal
                    </a>
                </div>
            </div>

            <div class="card card-del shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('kategori.update', $kategori) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Kode Kategori -->
                            <div class="col-12">
                                <label for="kode_kategori" class="form-label fw-semibold">Kode Kategori <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control font-monospace @error('kode_kategori') is-invalid @enderror"
                                       id="kode_kategori"
                                       name="kode_kategori"
                                       value="{{ old('kode_kategori', $kategori->kode_kategori) }}"
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
                                       value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
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
                                    <i class="bi bi-check-lg me-1"></i> Perbarui Kategori
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
