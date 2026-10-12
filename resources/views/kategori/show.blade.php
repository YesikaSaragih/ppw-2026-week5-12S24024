<x-layout title="Detail Kategori: {{ $kategori->nama_kategori }}">
    <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}" class="text-decoration-none">Daftar Kategori</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Kategori</li>
                </ol>
            </nav>
            <h1 class="page-title">{{ $kategori->nama_kategori }}</h1>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-del">
                <i class="bi bi-pencil me-1"></i> Edit Kategori
            </a>
            <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori \'{{ addslashes($kategori->nama_kategori) }}\'? Seluruh buku di bawah kategori ini juga akan terhapus.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-trash me-1"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <!-- Informasi Singkat Kategori -->
    <div class="card card-del shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row g-4 align-items-center">
                <div class="col-md-4">
                    <div class="text-muted small fw-semibold text-uppercase">Kode Kategori</div>
                    <div class="fs-4 fw-bold font-monospace text-dark mt-1">
                        {{ $kategori->kode_kategori }}
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="text-muted small fw-semibold text-uppercase">Nama Bidang Ilmu</div>
                    <div class="fs-5 fw-bold text-dark mt-1">
                        {{ $kategori->nama_kategori }}
                    </div>
                </div>
                <div class="col-md-3 text-md-end">
                    <div class="text-muted small fw-semibold text-uppercase">Koleksi Terdaftar</div>
                    <div class="fs-4 fw-bold text-primary mt-1">
                        {{ $bukus->total() }} <span class="fs-6 text-muted fw-normal">judul buku</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Buku dalam Kategori Ini -->
    <div class="card card-del shadow-sm">
        <div class="card-del-header d-flex justify-content-between align-items-center">
            <div class="fw-bold text-dark">
                <i class="bi bi-journals me-2 text-primary"></i> Daftar Buku Terdaftar pada Kategori Ini
            </div>
            <a href="{{ route('buku.create') }}" class="btn btn-sm btn-del">
                <i class="bi bi-plus-lg me-1"></i> Tambah Buku ke Kategori
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 35%;">Judul &amp; Penulis</th>
                        <th style="width: 18%;">ISBN</th>
                        <th style="width: 12%;" class="text-center">Tahun</th>
                        <th style="width: 12%;" class="text-center">Stok</th>
                        <th style="width: 18%;" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bukus as $index => $buku)
                        <tr>
                            <td class="text-secondary fw-semibold">
                                {{ $bukus->firstItem() + $index }}
                            </td>
                            <td>
                                <a href="{{ route('buku.show', $buku) }}" class="fw-bold text-decoration-none text-dark">
                                    {{ $buku->judul }}
                                </a>
                                <div class="small text-muted mt-1">
                                    <i class="bi bi-person me-1"></i>{{ $buku->penulis }} &bull; {{ $buku->penerbit }}
                                </div>
                            </td>
                            <td>
                                <code class="text-secondary">{{ $buku->isbn }}</code>
                            </td>
                            <td class="text-center text-secondary">
                                {{ $buku->tahun_terbit }}
                            </td>
                            <td class="text-center">
                                @if ($buku->stok > 5)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                        {{ $buku->stok }} eks
                                    </span>
                                @elseif ($buku->stok > 0)
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1">
                                        {{ $buku->stok }} eks
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">
                                        Habis
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('buku.show', $buku) }}" class="btn btn-outline-secondary" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('buku.edit', $buku) }}" class="btn btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="py-3">
                                    <i class="bi bi-journal-x fs-1 text-muted d-block mb-2"></i>
                                    <h6 class="fw-bold text-dark">Belum Ada Buku Terdaftar</h6>
                                    <p class="text-muted small mb-3">Belum ada buku yang dimasukkan ke dalam kategori ini.</p>
                                    <a href="{{ route('buku.create') }}" class="btn btn-del btn-sm">
                                        <i class="bi bi-plus-lg me-1"></i> Tambah Buku Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($bukus->hasPages())
            <div class="card-footer bg-white border-top p-3 d-flex justify-content-center">
                {{ $bukus->links() }}
            </div>
        @endif
    </div>
</x-layout>
