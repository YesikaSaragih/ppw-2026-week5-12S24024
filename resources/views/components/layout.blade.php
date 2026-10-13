<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'SIPUS-Del' }} — Sistem Informasi Perpustakaan</title>

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Tema Biru Muda Modern & Minimalis (Light Sky Blue Theme) */
            --del-primary: #0284C7;             /* Biru Muda Utama (Sky Blue 600) */
            --del-primary-hover: #0369A1;       /* Biru Lebih Gelap saat Hover (Sky Blue 700) */
            --del-primary-light: #38BDF8;       /* Biru Terang (Sky Blue 400) */
            --del-deep: #0C4A6E;                /* Biru Navy Pekat untuk Judul */
            --del-soft-blue: #E0F2FE;           /* Latar Biru Muda Halus (Sky Blue 100) */
            --del-lightest-blue: #F0F9FF;       /* Latar Biru Sangat Lembut (Sky Blue 50) */
            --del-border-blue: #BAE6FD;         /* Garis Tepi Aksen Biru (Sky Blue 200) */
            
            --del-bg: #F8FAFC;                  /* Abu-abu Terang Bersih (Slate 50) */
            --del-surface: #FFFFFF;             /* Putih Murni */
            --del-text-main: #0F172A;           /* Teks Utama Gelap (Slate 900) */
            --del-text-muted: #64748B;          /* Teks Keterangan Abu-abu (Slate 500) */
            --del-border: #E2E8F0;              /* Garis Pembatas Lembut (Slate 200) */

            --del-success-bg: #ECFDF5;
            --del-success-text: #065F46;
            --del-success-border: #A7F3D0;

            --del-warning-bg: #FFFBEB;
            --del-warning-text: #92400E;
            --del-warning-border: #FDE68A;

            --del-danger-bg: #FEF2F2;
            --del-danger-text: #991B1B;
            --del-danger-border: #FECACA;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--del-bg);
            color: var(--del-text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Layout Struktur */
        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 270px;
            background-color: var(--del-surface);
            border-right: 1px solid var(--del-border);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            transition: transform 0.25s ease-in-out;
            z-index: 1040;
        }

        .sidebar-brand {
            padding: 1.35rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            border-bottom: 1px solid var(--del-border);
            text-decoration: none;
            color: var(--del-text-main);
            background: linear-gradient(180deg, #FFFFFF 0%, var(--del-lightest-blue) 100%);
        }

        .sidebar-brand-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--del-soft-blue) 0%, #BAE6FD 100%);
            color: var(--del-primary);
            border: 1px solid var(--del-border-blue);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.15);
            transition: transform 0.2s ease;
        }

        .sidebar-brand:hover .sidebar-brand-icon {
            transform: scale(1.05) rotate(-3deg);
        }

        .sidebar-brand-title {
            font-size: 1.15rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            line-height: 1.2;
            color: var(--del-deep);
        }

        .sidebar-brand-title span {
            color: var(--del-primary);
        }

        .sidebar-brand-subtitle {
            font-size: 0.725rem;
            font-weight: 600;
            color: var(--del-text-muted);
            margin-top: 2px;
        }

        .sidebar-menu {
            padding: 1.25rem 0.85rem;
            list-style: none;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            flex-grow: 1;
        }

        .sidebar-menu-header {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94A3B8;
            padding: 0.5rem 0.75rem 0.25rem;
        }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.7rem 0.95rem;
            color: var(--del-text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 10px;
            transition: all 0.18s ease-in-out;
            position: relative;
        }

        .sidebar-nav-item i {
            font-size: 1.15rem;
            transition: transform 0.18s ease-in-out, color 0.18s ease;
        }

        .sidebar-nav-item:hover {
            color: var(--del-primary);
            background-color: var(--del-lightest-blue);
            transform: translateX(3px);
        }

        .sidebar-nav-item:hover i {
            color: var(--del-primary);
            transform: scale(1.1);
        }

        .sidebar-nav-item.active {
            color: var(--del-primary);
            background-color: var(--del-soft-blue);
            font-weight: 600;
            box-shadow: inset 0 0 0 1px var(--del-border-blue);
        }

        .sidebar-nav-item.active i {
            color: var(--del-primary);
        }

        .sidebar-nav-item.active::before {
            content: "";
            position: absolute;
            left: -0.85rem;
            top: 15%;
            bottom: 15%;
            width: 4px;
            background-color: var(--del-primary);
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }

        .sidebar-quick-action {
            margin: 0.5rem 0.85rem 1rem;
            padding: 1rem;
            background: linear-gradient(135deg, var(--del-lightest-blue) 0%, var(--del-soft-blue) 100%);
            border: 1px dashed var(--del-border-blue);
            border-radius: 12px;
        }

        .sidebar-footer {
            padding: 1.1rem 1.25rem;
            border-top: 1px solid var(--del-border);
            font-size: 0.775rem;
            color: var(--del-text-muted);
            background-color: #F8FAFC;
        }

        /* Main Content Wrapper */
        .main-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            background-color: var(--del-bg);
        }

        /* Top Header */
        .top-header {
            height: 68px;
            background-color: var(--del-surface);
            border-bottom: 1px solid var(--del-border);
            padding: 0 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1020;
            box-shadow: 0 1px 4px rgba(15, 23, 42, 0.03);
        }

        .content-area {
            padding: 1.75rem;
            flex-grow: 1;
        }

        /* Modern UI Cards */
        .ui-card {
            background-color: var(--del-surface);
            border: 1px solid var(--del-border);
            border-radius: 14px;
            box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.04);
            margin-bottom: 1.5rem;
            transition: all 0.2s ease;
        }

        .ui-card:hover {
            border-color: #CBD5E1;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.06);
        }

        .ui-card-header {
            padding: 1.15rem 1.35rem;
            border-bottom: 1px solid var(--del-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: transparent;
        }

        .ui-card-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--del-deep);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .ui-card-body {
            padding: 1.35rem;
        }

        /* Interactive Metric Stat Card */
        .stat-card {
            background: #FFFFFF;
            border: 1px solid var(--del-border);
            border-radius: 14px;
            padding: 1.25rem;
            height: 100%;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: block;
            color: inherit;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            border-color: var(--del-border-blue);
            box-shadow: 0 10px 20px -3px rgba(2, 132, 199, 0.12);
            color: inherit;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1);
        }

        /* Modern Buttons (Biru Muda Aksen) */
        .btn-del {
            background-color: var(--del-primary);
            color: #FFFFFF !important;
            border: 1px solid var(--del-primary);
            font-weight: 600;
            font-size: 0.875rem;
            border-radius: 8px;
            padding: 0.55rem 1.1rem;
            transition: all 0.18s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 2px 4px rgba(2, 132, 199, 0.2);
        }

        .btn-del:hover {
            background-color: var(--del-primary-hover);
            border-color: var(--del-primary-hover);
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
            transform: translateY(-1px);
        }

        .btn-del:active {
            transform: translateY(0);
        }

        .btn-outline-del {
            background-color: var(--del-lightest-blue);
            color: var(--del-primary) !important;
            border: 1px solid var(--del-border-blue);
            font-weight: 600;
            font-size: 0.875rem;
            border-radius: 8px;
            padding: 0.55rem 1.1rem;
            transition: all 0.18s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-outline-del:hover {
            background-color: var(--del-soft-blue);
            border-color: var(--del-primary);
            color: var(--del-primary-hover) !important;
            box-shadow: 0 2px 8px rgba(2, 132, 199, 0.15);
            transform: translateY(-1px);
        }

        .btn-secondary-del {
            background-color: #F1F5F9;
            color: #334155 !important;
            border: 1px solid #CBD5E1;
            font-weight: 500;
            font-size: 0.875rem;
            border-radius: 8px;
            padding: 0.55rem 1rem;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-secondary-del:hover {
            background-color: #E2E8F0;
            color: #0F172A !important;
        }

        /* Form Controls */
        .form-label {
            font-size: 0.825rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.4rem;
        }

        .form-control, .form-select {
            font-size: 0.875rem;
            border: 1px solid var(--del-border);
            border-radius: 8px;
            padding: 0.6rem 0.95rem;
            color: var(--del-text-main);
            background-color: #FFFFFF;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--del-primary);
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.18);
            outline: none;
        }

        /* Tables */
        .table-del {
            margin: 0;
            width: 100%;
        }

        .table-del th {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #475569;
            background-color: #F8FAFC;
            border-bottom: 1px solid var(--del-border);
            padding: 0.95rem 1.15rem;
            white-space: nowrap;
        }

        .table-del td {
            font-size: 0.875rem;
            color: var(--del-text-main);
            padding: 1.05rem 1.15rem;
            vertical-align: middle;
            border-bottom: 1px solid #F1F5F9;
        }

        .table-del tbody tr {
            transition: background-color 0.15s ease;
        }

        .table-del tbody tr:hover {
            background-color: #F0F9FF;
        }

        /* Badges */
        .badge-category {
            background-color: var(--del-soft-blue);
            color: #0369A1;
            border: 1px solid var(--del-border-blue);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35rem 0.65rem;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            text-decoration: none;
            transition: all 0.15s ease;
        }

        .badge-category:hover {
            background-color: #BAE6FD;
            color: #0C4A6E;
        }

        .badge-status {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35rem 0.65rem;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .badge-status-tersedia {
            background-color: var(--del-success-bg);
            color: var(--del-success-text);
            border: 1px solid var(--del-success-border);
        }

        .badge-status-menipis {
            background-color: var(--del-warning-bg);
            color: var(--del-warning-text);
            border: 1px solid var(--del-warning-border);
        }

        .badge-status-habis {
            background-color: var(--del-danger-bg);
            color: var(--del-danger-text);
            border: 1px solid var(--del-danger-border);
        }

        /* Cover Mockup Mini untuk Buku */
        .book-avatar {
            width: 38px;
            height: 48px;
            border-radius: 6px;
            background: linear-gradient(135deg, var(--del-soft-blue) 0%, #BAE6FD 100%);
            border: 1px solid var(--del-border-blue);
            color: var(--del-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.85rem;
            flex-shrink: 0;
            box-shadow: 0 2px 4px rgba(2, 132, 199, 0.1);
        }

        /* Alert Notifikasi */
        .alert-del {
            border-radius: 12px;
            padding: 1rem 1.25rem;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            border: 1px solid transparent;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
            animation: fadeInDown 0.25s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-del-success {
            background-color: var(--del-success-bg);
            color: var(--del-success-text);
            border-color: var(--del-success-border);
        }

        .alert-del-danger {
            background-color: var(--del-danger-bg);
            color: var(--del-danger-text);
            border-color: var(--del-danger-border);
        }

        .alert-del-warning {
            background-color: var(--del-warning-bg);
            color: var(--del-warning-text);
            border-color: var(--del-warning-border);
        }

        /* Pagination */
        .pagination .page-item.active .page-link {
            background-color: var(--del-primary);
            border-color: var(--del-primary);
            color: #FFFFFF;
            font-weight: 600;
        }

        .pagination .page-link {
            color: var(--del-primary);
            border-color: var(--del-border);
            border-radius: 6px;
            margin: 0 2px;
        }

        .pagination .page-link:hover {
            background-color: var(--del-soft-blue);
            color: var(--del-primary-hover);
        }

        /* Footer */
        .dashboard-footer {
            background-color: var(--del-surface);
            border-top: 1px solid var(--del-border);
            padding: 1.15rem 1.75rem;
            font-size: 0.8125rem;
            color: var(--del-text-muted);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 0.75rem;
        }

        /* Pulsing Dot Status */
        .pulse-dot {
            width: 8px;
            height: 8px;
            background-color: #10B981;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: pulse 1.8s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }
            70% {
                box-shadow: 0 0 0 6px rgba(16, 185, 129, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        /* Copy Button Animasi */
        .btn-copy {
            background: transparent;
            border: none;
            color: var(--del-text-muted);
            cursor: pointer;
            padding: 0 4px;
            transition: color 0.15s ease;
        }

        .btn-copy:hover {
            color: var(--del-primary);
        }

        /* Responsive Mobile */
        @media (max-width: 991.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                transform: translateX(-100%);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-backdrop {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(15, 23, 42, 0.4);
                z-index: 1030;
                display: none;
            }

            .sidebar-backdrop.show {
                display: block;
            }

            .content-area {
                padding: 1.25rem 1rem;
            }

            .top-header {
                padding: 0 1rem;
            }
        }
    </style>
</head>
<body>

    <div class="dashboard-wrapper">
        <!-- Sidebar Backdrop untuk Mobile -->
        <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar()"></div>

        <!-- Sidebar Navigasi -->
        <aside class="sidebar" id="appSidebar">
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <div class="sidebar-brand-icon">
                    <i class="bi bi-book-half"></i>
                </div>
                <div>
                    <div class="sidebar-brand-title">SIPUS<span>-Del</span></div>
                    <div class="sidebar-brand-subtitle">Perpustakaan Kampus Del</div>
                </div>
            </a>

            <ul class="sidebar-menu">
                <li class="sidebar-menu-header">Menu Navigasi</li>
                <li>
                    <a href="{{ route('dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('buku.index') }}" class="sidebar-nav-item {{ request()->routeIs('buku.*') ? 'active' : '' }}">
                        <i class="bi bi-journal-bookmark-fill"></i>
                        <span>Manajemen Buku</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kategori.index') }}" class="sidebar-nav-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                        <i class="bi bi-tags-fill"></i>
                        <span>Manajemen Kategori</span>
                    </a>
                </li>
            </ul>

            <!-- Tombol Tambah Cepat di Sidebar -->
            <div class="sidebar-quick-action">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="small fw-bold text-dark" style="font-size: 0.775rem;">Aksi Cepat</span>
                    <i class="bi bi-lightning-charge-fill text-warning" style="font-size: 0.85rem;"></i>
                </div>
                <div class="d-grid gap-1">
                    <a href="{{ route('buku.create') }}" class="btn btn-del btn-sm w-100 justify-content-center" style="font-size: 0.8rem; padding: 0.4rem 0.75rem;">
                        <i class="bi bi-plus-lg"></i> Tambah Buku Baru
                    </a>
                </div>
            </div>

            <div class="sidebar-footer">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge" style="background-color: var(--del-soft-blue); color: var(--del-primary); border: 1px solid var(--del-border-blue); font-size: 0.65rem; font-weight: 700;">IT DEL</span>
                    <div>
                        <div class="fw-bold text-dark" style="font-size: 0.775rem;">Institut Teknologi Del</div>
                        <div style="font-size: 0.7rem; color: #64748B;">Laguboti, Toba, Sumatera Utara</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Wrapper Konten Utama -->
        <div class="main-wrapper">
            <!-- Top Header Navbar -->
            <header class="top-header">
                <div class="d-flex align-items-center gap-3">
                    <button type="button" class="btn btn-sm btn-light border d-lg-none" onclick="toggleSidebar()" aria-label="Buka Menu">
                        <i class="bi bi-list fs-5"></i>
                    </button>
                    <div>
                        <div class="text-muted d-none d-sm-block" style="font-size: 0.725rem; font-weight: 500;">
                            Sistem Informasi Perpustakaan &bull; Kampus Del
                        </div>
                        <div class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $title ?? 'Dashboard' }}</div>
                    </div>
                </div>

                <!-- Bagian Kanan Header: Status & Tombol Cepat -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Status Sistem & Tanggal Hari Ini -->
                    <div class="d-none d-md-flex align-items-center gap-2 px-3 py-1 bg-light rounded-pill border" style="font-size: 0.75rem;">
                        <span class="pulse-dot"></span>
                        <span class="text-secondary fw-medium">Sistem Aktif &bull; {{ now()->translatedFormat('d F Y') }}</span>
                    </div>

                    <!-- Tombol Cepat Sesuai Halaman -->
                    @if (request()->routeIs('buku.index'))
                        <a href="{{ route('buku.create') }}" class="btn btn-del btn-sm">
                            <i class="bi bi-plus-lg"></i> <span class="d-none d-sm-inline">Tambah Buku</span>
                        </a>
                    @elseif (request()->routeIs('kategori.index'))
                        <a href="{{ route('kategori.create') }}" class="btn btn-del btn-sm">
                            <i class="bi bi-plus-lg"></i> <span class="d-none d-sm-inline">Tambah Kategori</span>
                        </a>
                    @elseif (request()->routeIs('dashboard'))
                        <a href="{{ route('buku.create') }}" class="btn btn-del btn-sm">
                            <i class="bi bi-plus-lg"></i> <span class="d-none d-sm-inline">Tambah Buku</span>
                        </a>
                    @endif
                </div>
            </header>

            <!-- Area Konten Dinamis -->
            <main class="content-area">
                <!-- Pesan Notifikasi Berhasil -->
                @if (session('success'))
                    <div class="alert-del alert-del-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill fs-5 text-success"></i>
                        <div class="flex-grow-1 fw-medium">{{ session('success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                @endif

                <!-- Pesan Notifikasi Gagal -->
                @if (session('error'))
                    <div class="alert-del alert-del-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill fs-5 text-danger"></i>
                        <div class="flex-grow-1 fw-medium">{{ session('error') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                @endif

                <!-- Pesan Kesalahan Input Validasi -->
                @if ($errors->any())
                    <div class="alert-del alert-del-warning alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle-fill fs-5 text-warning"></i>
                        <div class="flex-grow-1">
                            <div class="fw-bold mb-1">Ada data yang belum sesuai:</div>
                            <ul class="mb-0 ps-3 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                @endif

                <!-- Slot Halaman Blade -->
                {{ $slot }}
            </main>

            <!-- Footer Aplikasi -->
            <footer class="dashboard-footer">
                <div>
                    <strong>SIPUS-Del</strong> &mdash; Sistem Informasi Perpustakaan Institut Teknologi Del
                </div>
                <div>
                    Praktikum Pemrograman &amp; Pengujian Web (PPW)
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Universal (Interaktif & Aman) -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow" style="border-radius: 14px;">
                <div class="modal-body text-center p-4">
                    <div class="p-3 d-inline-flex rounded-circle mb-3" style="background-color: #FEF2F2; color: #DC2626;">
                        <i class="bi bi-trash3-fill fs-2"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <p class="text-muted small mb-4" id="deleteModalMessage">
                        Apakah Anda yakin ingin menghapus data ini? Data yang sudah dihapus tidak dapat dikembalikan.
                    </p>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-secondary-del btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                        <form id="deleteFormTarget" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm px-3">Ya, Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Copy Feedback -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
        <div id="copyToast" class="toast align-items-center text-white bg-dark border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body small">
                    <i class="bi bi-check-circle-fill text-success me-1"></i> Teks berhasil disalin ke clipboard!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Tutup"></button>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Sidebar Mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('appSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            if (sidebar && backdrop) {
                sidebar.classList.toggle('show');
                backdrop.classList.toggle('show');
            }
        }

        // Modal Hapus Interaktif
        function confirmDelete(actionUrl, itemName) {
            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
            const form = document.getElementById('deleteFormTarget');
            const messageEl = document.getElementById('deleteModalMessage');
            
            form.action = actionUrl;
            if (itemName) {
                messageEl.innerHTML = `Apakah Anda yakin ingin menghapus <strong>"${itemName}"</strong>?<br>Tindakan ini tidak dapat dibatalkan.`;
            } else {
                messageEl.innerHTML = `Apakah Anda yakin ingin menghapus data ini?<br>Tindakan ini tidak dapat dibatalkan.`;
            }
            modal.show();
        }

        // Fitur Salin Teks (ISBN) dengan Notifikasi Toast
        function copyToClipboard(text, element) {
            navigator.clipboard.writeText(text).then(function() {
                const toastEl = document.getElementById('copyToast');
                if (toastEl) {
                    const toast = new bootstrap.Toast(toastEl, { delay: 2000 });
                    toast.show();
                }
                if (element) {
                    const originalHtml = element.innerHTML;
                    element.innerHTML = '<i class="bi bi-check2 text-success"></i>';
                    setTimeout(() => {
                        element.innerHTML = originalHtml;
                    }, 1800);
                }
            }).catch(function(err) {
                console.error('Gagal menyalin teks: ', err);
            });
        }
    </script>
</body>
</html>
