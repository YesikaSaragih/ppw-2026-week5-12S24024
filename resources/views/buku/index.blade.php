<x-layout title="Daftar Koleksi Buku">
    <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h1 class="page-title">Daftar Koleksi Buku</h1>
            <p class="page-subtitle mb-0">Kelola katalog dan inventaris buku perpustakaan Institut Teknologi Del</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('buku.create') }}" class="btn btn-del shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Buku Baru
            </a>
        </div>
    </div>

    <div class="card card-del shadow-sm">
        <div class="card-del-header d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-secondary">
                <i class="bi bi-collection me-1"></i> Total Koleksi: <span class="text-dark fw-bold">{{ $bukus->total() }}</span> buku
            </div>
            <div class="small text-muted">
                Halaman {{ $bukus->currentPage() }} dari {{ $bukus->lastPage() }}
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 30%;">Judul &amp; Penulis</th>
                        <th style="width: 15%;">ISBN</th>
                        <th style="width: 15%;">Kategori</th>
                        <th style="width: 10%;" class="text-center">Tahun</th>
                        <th style="width: 10%;" class="text-center">Stok</th>
                        <th style="width: 15%;" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bukus as $index => $buku)
                        <tr>
                            <td class="text-secondary fw-semibold">
                                {{ $bukus->firstItem() + $index }}
                            </td>
                            <td>
                                <a href="{{ route('buku.show', $buku) }}" class="fw-bold text-decoration-none text-dark hover-purple">
                                    {{ $buku->judul }}
                                </a>
                                <div class="small text-muted mt-1">
                                    <i class="bi bi-person me-1"></i>{{ $buku->penulis }} &bull; <i class="bi bi-building me-1"></i>{{ $buku->penerbit }}
                                </div>
                            </td>
                            <td>
                                <code class="text-secondary">{{ $buku->isbn }}</code>
                            </td>
                            <td>
                                @if ($buku->kategori)
                                    <a href="{{ route('kategori.show', $buku->kategori) }}" class="badge badge-del text-decoration-none px-2 py-1">
                                        <i class="bi bi-tag-fill me-1"></i>{{ $buku->kategori->nama_kategori }}
                                    </a>
                                @else
                                    <span class="badge bg-secondary">Tanpa Kategori</span>
                                @endif
                            </td>
                            <td class="text-center text-secondary">
                                {{ $buku->tahun_terbit }}
                            </td>
                            <td class="text-center">
                                @if ($buku->stok > 5)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                        <i class="bi bi-check-circle me-1"></i>{{ $buku->stok }} eks
                                    </span>
                                @elseif ($buku->stok > 0)
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1">
                                        <i class="bi bi-exclamation-triangle me-1"></i>{{ $buku->stok }} eks
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">
                                        <i class="bi bi-x-circle me-1"></i>Habis
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('buku.show', $buku) }}" class="btn btn-outline-secondary" title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('buku.edit', $buku) }}" class="btn btn-outline-primary" title="Edit Buku">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ addslashes($buku->judul) }}\'? Data yang dihapus tidak dapat dikembalikan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Hapus Buku">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="py-4">
                                    <i class="bi bi-journal-x fs-1 text-muted d-block mb-3"></i>
                                    <h5 class="fw-bold text-dark">Belum Ada Koleksi Buku</h5>
                                    <p class="text-muted small mb-3">Database perpustakaan saat ini belum memiliki data koleksi buku.</p>
                                    <a href="{{ route('buku.create') }}" class="btn btn-del btn-sm">
                                        <i class="bi bi-plus-lg me-1"></i> Tambah Buku Pertama
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
