<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'SIPUS-Del' }} — Library Management System</title>

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
            /* Tema Biru Muda Modern & Minimalis (Light Sky Blue & Cyan Theme) */
            --del-primary: #0284C7;             /* Sky Blue 600 - Warna Utama */
            --del-primary-hover: #0369A1;       /* Sky Blue 700 - Hover State */
            --del-deep: #0C4A6E;                /* Dark Sky Navy - Header/Aksen */
            --del-soft-blue: #E0F2FE;           /* Sky Blue 100 - Latar Biru Muda */
            --del-lightest-blue: #F0F9FF;       /* Sky Blue 50 - Latar Paling Lembut */
            --del-border-blue: #BAE6FD;         /* Sky Blue 200 - Garis Tepi Aksen Biru */
            
            --del-bg: #F8FAFC;                  /* Slate 50 - Latar Dashboard Bersih */
            --del-surface: #FFFFFF;             /* Putih Murni - Latar Card */
            --del-text-main: #0F172A;           /* Slate 900 - Teks Utama */
            --del-text-muted: #64748B;          /* Slate 500 - Teks Sekunder */
            --del-border: #E2E8F0;              /* Slate 200 - Garis Pembatas Lembut */

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

        /* Layout Structure */
        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
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
        }

        .sidebar-brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--del-soft-blue) 0%, #BAE6FD 100%);
            color: var(--del-primary);
            border: 1px solid var(--del-border-blue);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
            box-shadow: 0 2px 5px rgba(2, 132, 199, 0.12);
        }

        .sidebar-brand-title {
            font-size: 1.125rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            line-height: 1.2;
            color: var(--del-deep);
        }

        .sidebar-brand-title span {
            color: var(--del-primary);
        }

        .sidebar-brand-subtitle {
            font-size: 0.6875rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
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
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94A3B8;
            padding: 0.5rem 0.65rem 0.25rem;
        }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 0.85rem;
            color: var(--del-text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.18s ease-in-out;
            position: relative;
        }

        .sidebar-nav-item i {
            font-size: 1.1rem;
            transition: color 0.18s ease-in-out;
        }

        .sidebar-nav-item:hover {
            color: var(--del-primary);
            background-color: var(--del-lightest-blue);
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
            height: 64px;
            background-color: var(--del-surface);
            border-bottom: 1px solid var(--del-border);
            padding: 0 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .content-area {
            padding: 1.75rem;
            flex-grow: 1;
        }

        /* UI Cards & Panels */
        .ui-card {
            background-color: var(--del-surface);
            border: 1px solid var(--del-border);
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.04);
            margin-bottom: 1.5rem;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        .ui-card:hover {
            border-color: #CBD5E1;
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
            font-size: 0.975rem;
            font-weight: 700;
            color: var(--del-deep);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }

        .ui-card-body {
            padding: 1.35rem;
        }

        /* Modern Minimalist Buttons (Light Blue Accent) */
        .btn-del {
            background-color: var(--del-primary);
            color: #FFFFFF !important;
            border: 1px solid var(--del-primary);
            font-weight: 600;
            font-size: 0.875rem;
            border-radius: 7px;
            padding: 0.5rem 1rem;
            transition: all 0.18s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            box-shadow: 0 2px 4px rgba(2, 132, 199, 0.2);
        }

        .btn-del:hover {
            background-color: var(--del-primary-hover);
            border-color: var(--del-primary-hover);
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.3);
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
            border-radius: 7px;
            padding: 0.5rem 1rem;
            transition: all 0.18s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
        }

        .btn-outline-del:hover {
            background-color: var(--del-soft-blue);
            border-color: var(--del-primary);
            color: var(--del-primary-hover) !important;
            box-shadow: 0 2px 6px rgba(2, 132, 199, 0.15);
        }

        .btn-secondary-del {
            background-color: #F1F5F9;
            color: #334155 !important;
            border: 1px solid #CBD5E1;
            font-weight: 500;
            font-size: 0.875rem;
            border-radius: 7px;
            padding: 0.5rem 0.95rem;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
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
            margin-bottom: 0.35rem;
        }

        .form-control, .form-select {
            font-size: 0.875rem;
            border: 1px solid var(--del-border);
            border-radius: 7px;
            padding: 0.525rem 0.85rem;
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
            padding: 0.85rem 1.15rem;
            white-space: nowrap;
        }

        .table-del td {
            font-size: 0.875rem;
            color: var(--del-text-main);
            padding: 1rem 1.15rem;
            vertical-align: middle;
            border-bottom: 1px solid #F1F5F9;
        }

        .table-del tbody tr {
            transition: background-color 0.1s ease;
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

        /* Alert Notifications */
        .alert-del {
            border-radius: 10px;
            padding: 0.95rem 1.25rem;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
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

        /* Pagination Styling */
        .pagination .page-item.active .page-link {
            background-color: var(--del-primary);
            border-color: var(--del-primary);
            color: #FFFFFF;
            font-weight: 600;
        }

        .pagination .page-link {
            color: var(--del-primary);
            border-color: var(--del-border);
        }

        .pagination .page-link:hover {
            background-color: var(--del-soft-blue);
            color: var(--del-primary-hover);
        }

        /* Minimalist Footer */
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

        /* Mobile Adjustments */
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
        <!-- Sidebar Backdrop for Mobile -->
        <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar()"></div>

        <!-- Sidebar Navigation -->
        <aside class="sidebar" id="appSidebar">
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <div class="sidebar-brand-icon">
                    <i class="bi bi-book-half"></i>
                </div>
                <div>
                    <div class="sidebar-brand-title">SIPUS<span>-Del</span></div>
                    <div class="sidebar-brand-subtitle">Library Management</div>
                </div>
            </a>

            <ul class="sidebar-menu">
                <li class="sidebar-menu-header">Menu Utama</li>
                <li>
                    <a href="{{ route('dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('buku.index') }}" class="sidebar-nav-item {{ request()->routeIs('buku.*') ? 'active' : '' }}">
                        <i class="bi bi-journal-bookmark"></i>
                        <span>Manajemen Buku</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kategori.index') }}" class="sidebar-nav-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                        <i class="bi bi-tags"></i>
                        <span>Manajemen Kategori</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge" style="background-color: var(--del-soft-blue); color: var(--del-primary); border: 1px solid var(--del-border-blue); font-size: 0.65rem; font-weight: 700;">IT DEL</span>
                    <div>
                        <div class="fw-bold text-dark" style="font-size: 0.775rem;">Institut Teknologi Del</div>
                        <div style="font-size: 0.7rem; color: #64748B;">Kampus Laguboti, Toba</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Wrapper -->
        <div class="main-wrapper">
            <!-- Top Header Bar -->
            <header class="top-header">
                <div class="d-flex align-items-center gap-3">
                    <button type="button" class="btn btn-sm btn-light border d-lg-none" onclick="toggleSidebar()" aria-label="Toggle menu">
                        <i class="bi bi-list fs-5"></i>
                    </button>
                    <div>
                        <div class="text-muted" style="font-size: 0.75rem; font-weight: 500;">SIPUS-Del &bull; Sistem Informasi Perpustakaan</div>
                        <div class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $title ?? 'Dashboard' }}</div>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    @if (request()->routeIs('buku.index'))
                        <a href="{{ route('buku.create') }}" class="btn btn-del btn-sm">
                            <i class="bi bi-plus-lg"></i> Tambah Buku
                        </a>
                    @elseif (request()->routeIs('kategori.index'))
                        <a href="{{ route('kategori.create') }}" class="btn btn-del btn-sm">
                            <i class="bi bi-plus-lg"></i> Tambah Kategori
                        </a>
                    @elseif (request()->routeIs('dashboard'))
                        <a href="{{ route('buku.create') }}" class="btn btn-del btn-sm">
                            <i class="bi bi-plus-lg"></i> Tambah Buku
                        </a>
                    @endif
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="content-area">
                <!-- Flash Session Messages -->
                @if (session('success'))
                    <div class="alert-del alert-del-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                        <div class="flex-grow-1">{{ session('success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert-del alert-del-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                        <div class="flex-grow-1">{{ session('error') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-del alert-del-warning alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle-fill fs-5"></i>
                        <div class="flex-grow-1">
                            <div class="fw-semibold">Terdapat kesalahan masukan data:</div>
                            <ul class="mb-0 ps-3 mt-1 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Dynamic Page Content -->
                {{ $slot }}
            </main>

            <!-- Dashboard Footer -->
            <footer class="dashboard-footer">
                <div>
                    <strong>SIPUS-Del</strong> &mdash; Sistem Informasi Perpustakaan Kampus Del
                </div>
                <div>
                    Praktikum Pemrograman &amp; Pengujian Web (PPW) &bull; Institut Teknologi Del
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap 5.3.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('appSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            if (sidebar && backdrop) {
                sidebar.classList.toggle('show');
                backdrop.classList.toggle('show');
            }
        }
    </script>
</body>
</html>
