<x-layout title="Edit Buku: {{ $buku->judul }}">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="page-header d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="page-title">Edit Data Buku</h1>
                    <p class="page-subtitle mb-0">Perbarui rincian katalog dan informasi buku perpustakaan</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('buku.show', $buku) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-eye me-1"></i> Lihat Detail
                    </a>
                    <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Batal
                    </a>
                </div>
            </div>

            <div class="card card-del shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('buku.update', $buku) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Judul Buku -->
                            <div class="col-12">
                                <label for="judul" class="form-label fw-semibold">Judul Buku <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('judul') is-invalid @enderror"
                                       id="judul"
                                       name="judul"
                                       value="{{ old('judul', $buku->judul) }}"
                                       required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Judul minimal terdiri dari 5 karakter dan maksimal 200 karakter.</div>
                            </div>

                            <!-- ISBN -->
                            <div class="col-md-6">
                                <label for="isbn" class="form-label fw-semibold">Nomor ISBN <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('isbn') is-invalid @enderror"
                                       id="isbn"
                                       name="isbn"
                                       value="{{ old('isbn', $buku->isbn) }}"
                                       required>
                                @error('isbn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kategori Buku -->
                            <div class="col-md-6">
                                <label for="kategori_id" class="form-label fw-semibold">Kategori Buku <span class="text-danger">*</span></label>
                                <select class="form-select @error('kategori_id') is-invalid @enderror"
                                        id="kategori_id"
                                        name="kategori_id"
                                        required>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id', $buku->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                            [{{ $kategori->kode_kategori }}] {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Penulis -->
                            <div class="col-md-6">
                                <label for="penulis" class="form-label fw-semibold">Nama Penulis <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('penulis') is-invalid @enderror"
                                       id="penulis"
                                       name="penulis"
                                       value="{{ old('penulis', $buku->penulis) }}"
                                       required>
                                @error('penulis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Penerbit -->
                            <div class="col-md-6">
                                <label for="penerbit" class="form-label fw-semibold">Penerbit <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('penerbit') is-invalid @enderror"
                                       id="penerbit"
                                       name="penerbit"
                                       value="{{ old('penerbit', $buku->penerbit) }}"
                                       required>
                                @error('penerbit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tahun Terbit -->
                            <div class="col-md-6">
                                <label for="tahun_terbit" class="form-label fw-semibold">Tahun Terbit <span class="text-danger">*</span></label>
                                <input type="number"
                                       class="form-control @error('tahun_terbit') is-invalid @enderror"
                                       id="tahun_terbit"
                                       name="tahun_terbit"
                                       value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                                       min="1900"
                                       max="{{ date('Y') }}"
                                       required>
                                @error('tahun_terbit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jumlah Stok -->
                            <div class="col-md-6">
                                <label for="stok" class="form-label fw-semibold">Jumlah Stok (Eksemplar) <span class="text-danger">*</span></label>
                                <input type="number"
                                       class="form-control @error('stok') is-invalid @enderror"
                                       id="stok"
                                       name="stok"
                                       value="{{ old('stok', $buku->stok) }}"
                                       min="0"
                                       required>
                                @error('stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Stok tidak boleh bernilai negatif (minimal 0).</div>
                            </div>

                            <!-- Sinopsis -->
                            <div class="col-12">
                                <label for="sinopsis" class="form-label fw-semibold">Sinopsis / Ringkasan Buku</label>
                                <textarea class="form-control @error('sinopsis') is-invalid @enderror"
                                          id="sinopsis"
                                          name="sinopsis"
                                          rows="4">{{ old('sinopsis', $buku->sinopsis) }}</textarea>
                                @error('sinopsis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="col-12 d-flex justify-content-end gap-2 pt-3 border-top mt-4">
                                <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-del">
                                    <i class="bi bi-check-lg me-1"></i> Perbarui Data Buku
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
