<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'SIPUS-Del' }} — Institut Teknologi Del</title>

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --del-purple: #4C1D95;
            --del-purple-hover: #3B0764;
            --del-purple-light: #F5F3FF;
            --del-purple-subtle: #DDD6FE;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #F8FAFC;
            color: #1E293B;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar-del {
            background-color: var(--del-purple);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .navbar-del .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.025em;
            color: #FFFFFF !important;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .navbar-del .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            padding: 0.5rem 0.9rem !important;
            border-radius: 0.375rem;
            transition: all 0.2s ease-in-out;
        }

        .navbar-del .nav-link:hover,
        .navbar-del .nav-link.active {
            color: #FFFFFF !important;
            background-color: rgba(255, 255, 255, 0.15);
        }

        .btn-del {
            background-color: var(--del-purple);
            color: #FFFFFF;
            border: 1px solid var(--del-purple);
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-del:hover, .btn-del:focus {
            background-color: var(--del-purple-hover);
            border-color: var(--del-purple-hover);
            color: #FFFFFF;
            box-shadow: 0 4px 12px rgba(76, 29, 149, 0.25);
        }

        .btn-outline-del {
            background-color: transparent;
            color: var(--del-purple);
            border: 1px solid var(--del-purple);
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-outline-del:hover {
            background-color: var(--del-purple);
            color: #FFFFFF;
        }

        .badge-del {
            background-color: var(--del-purple-light);
            color: var(--del-purple);
            border: 1px solid var(--del-purple-subtle);
            font-weight: 600;
        }

        .card-del {
            border: 1px solid #E2E8F0;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            background-color: #FFFFFF;
        }

        .card-del-header {
            background-color: #FFFFFF;
            border-bottom: 1px solid #E2E8F0;
            padding: 1.25rem 1.5rem;
            border-top-left-radius: 0.75rem !important;
            border-top-right-radius: 0.75rem !important;
        }

        .table-custom th {
            font-weight: 600;
            font-size: 0.8125rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748B;
            background-color: #F8FAFC;
            border-bottom: 2px solid #E2E8F0;
            padding: 0.875rem 1rem;
        }

        .table-custom td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #F1F5F9;
        }

        .footer-del {
            margin-top: auto;
            background-color: #FFFFFF;
            border-top: 1px solid #E2E8F0;
            padding: 1.5rem 0;
            font-size: 0.875rem;
            color: #64748B;
        }

        .page-header {
            margin-bottom: 1.75rem;
        }

        .page-title {
            font-size: 1.625rem;
            font-weight: 700;
            color: #0F172A;
            margin-bottom: 0.25rem;
        }

        .page-subtitle {
            font-size: 0.9375rem;
            color: #64748B;
        }
    </style>
</head>
<body>

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-del sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('buku.index') }}">
                <span class="d-inline-flex align-items-center justify-content-center bg-white text-dark rounded-3 px-2 py-1 shadow-sm" style="color: var(--del-purple) !important;">
                    <i class="bi bi-book-half fs-5"></i>
                </span>
                <span>SIPUS<span class="text-warning">-Del</span></span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('buku.*') ? 'active' : '' }}" href="{{ route('buku.index') }}">
                            <i class="bi bi-journal-text me-1"></i> Data Buku
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}" href="{{ route('kategori.index') }}">
                            <i class="bi bi-tags me-1"></i> Data Kategori
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('buku.create') }}" class="btn btn-sm btn-light fw-medium">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Buku
                    </a>
                    <a href="{{ route('kategori.create') }}" class="btn btn-sm btn-outline-light fw-medium">
                        <i class="bi bi-folder-plus me-1"></i> Tambah Kategori
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <main class="container py-4 flex-grow-1">
        <!-- Flash Session Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show card-del border-0 border-start border-success border-4 shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                    <div>
                        <strong class="d-block text-success">Sukses!</strong>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show card-del border-0 border-start border-danger border-4 shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill text-danger fs-4 me-3"></i>
                    <div>
                        <strong class="d-block text-danger">Terjadi Kesalahan!</strong>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show card-del border-0 border-start border-warning border-4 shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-start">
                    <i class="bi bi-exclamation-circle-fill text-warning fs-4 me-3 mt-1"></i>
                    <div>
                        <strong class="d-block text-dark">Periksa kembali data yang dimasukkan:</strong>
                        <ul class="mb-0 ps-3 mt-1 small text-secondary">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Slot Konten Utama -->
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="footer-del">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <div>
                <strong>SIPUS-Del</strong> &mdash; Sistem Informasi Perpustakaan Kampus Del
            </div>
            <div class="text-muted small">
                Praktikum Pemrograman &amp; Pengujian Web (PPW) Week 5 &bull; Institut Teknologi Del
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
