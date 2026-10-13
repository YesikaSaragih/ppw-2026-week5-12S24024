<x-layout title="Edit Kategori: {{ $kategori->nama_kategori }}">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <!-- Header Navigasi -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-2 py-1 rounded-pill mb-1" style="background-color: var(--del-soft-blue); border: 1px solid var(--del-border-blue);">
                        <i class="bi bi-pencil-fill text-primary" style="font-size: 0.75rem;"></i>
                        <span class="small fw-bold text-primary" style="font-size: 0.725rem;">Perubahan Klasifikasi</span>
                    </div>
                    <h1 class="h4 fw-bold text-dark mb-1">Edit Kategori</h1>
                    <p class="text-muted small mb-0">Perbarui rincian kode atau nama klasifikasi bidang ilmu.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('kategori.show', $kategori) }}" class="btn btn-secondary-del btn-sm">
                        <i class="bi bi-eye"></i> Detail
                    </a>
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary-del btn-sm">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                </div>
            </div>

            <div class="ui-card">
                <div class="ui-card-header" style="background: linear-gradient(180deg, var(--del-lightest-blue) 0%, #FFFFFF 100%);">
                    <span class="ui-card-title">
                        <span class="p-1 rounded bg-white border d-inline-flex align-items-center justify-content-center me-1" style="width: 26px; height: 26px; color: var(--del-primary);">
                            <i class="bi bi-pencil-square"></i>
                        </span>
                        Perbarui Data Kategori
                    </span>
                </div>
                <div class="ui-card-body">
                    <form action="{{ route('kategori.update', $kategori) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="kode_kategori" class="form-label">Kode Kategori <span class="text-danger">*</span></label>
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
                            <div class="form-text" style="font-size: 0.75rem;">Maksimal 10 karakter, harus unik.</div>
                        </div>

                        <div class="mb-4">
                            <label for="nama_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
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
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('kategori.index') }}" class="btn btn-secondary-del">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-del">
                                <i class="bi bi-check2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
