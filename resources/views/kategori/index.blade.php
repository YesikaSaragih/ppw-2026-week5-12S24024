<x-layout title="Daftar Kategori Buku">
    <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h1 class="page-title">Daftar Kategori Buku</h1>
            <p class="page-subtitle mb-0">Kelola klasifikasi bidang ilmu dan pengelompokan koleksi perpustakaan</p>
        </div>
        <div>
            <a href="{{ route('kategori.create') }}" class="btn btn-del shadow-sm">
                <i class="bi bi-folder-plus me-1"></i> Tambah Kategori Baru
            </a>
        </div>
    </div>

    <div class="card card-del shadow-sm">
        <div class="card-del-header d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-secondary">
                <i class="bi bi-tags me-1"></i> Total Kategori: <span class="text-dark fw-bold">{{ $kategoris->total() }}</span> kategori
            </div>
            <div class="small text-muted">
                Halaman {{ $kategoris->currentPage() }} dari {{ $kategoris->lastPage() }}
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 8%;">No</th>
                        <th style="width: 20%;">Kode Kategori</th>
                        <th style="width: 42%;">Nama Kategori</th>
                        <th style="width: 15%;" class="text-center">Jumlah Buku</th>
                        <th style="width: 15%;" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategoris as $index => $kategori)
                        <tr>
                            <td class="text-secondary fw-semibold">
                                {{ $kategoris->firstItem() + $index }}
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border font-monospace px-2 py-1 fs-6">
                                    {{ $kategori->kode_kategori }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('kategori.show', $kategori) }}" class="fw-bold text-dark text-decoration-none">
                                    {{ $kategori->nama_kategori }}
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('kategori.show', $kategori) }}" class="badge badge-del text-decoration-none px-2 py-1">
                                    <i class="bi bi-book me-1"></i>{{ $kategori->bukus_count }} Judul
                                </a>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('kategori.show', $kategori) }}" class="btn btn-outline-secondary" title="Lihat Detail & Buku">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-outline-primary" title="Edit Kategori">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori \'{{ addslashes($kategori->nama_kategori) }}\'? Seluruh buku di bawah kategori ini juga akan terhapus.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Hapus Kategori">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="py-4">
                                    <i class="bi bi-tags fs-1 text-muted d-block mb-3"></i>
                                    <h5 class="fw-bold text-dark">Belum Ada Kategori</h5>
                                    <p class="text-muted small mb-3">Database perpustakaan belum memiliki data kategori buku.</p>
                                    <a href="{{ route('kategori.create') }}" class="btn btn-del btn-sm">
                                        <i class="bi bi-plus-lg me-1"></i> Tambah Kategori Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($kategoris->hasPages())
            <div class="card-footer bg-white border-top p-3 d-flex justify-content-center">
                {{ $kategoris->links() }}
            </div>
        @endif
    </div>
</x-layout>
