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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --del-primary: #4C1D95;
            --del-deep: #3B0764;
            --del-soft-lavender: #F3EEFF;
            --del-bg: #F8F9FC;
            --del-surface: #FFFFFF;
            --del-text-main: #202033;
            --del-text-muted: #6B7280;
            --del-border: #E8E8F0;

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
            width: 38px;
            height: 38px;
            background-color: var(--del-soft-lavender);
            color: var(--del-primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .sidebar-brand-title {
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            line-height: 1.2;
            color: var(--del-text-main);
        }

        .sidebar-brand-subtitle {
            font-size: 0.6875rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--del-text-muted);
            margin-top: 1px;
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
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #9CA3AF;
            padding: 0.5rem 0.65rem 0.25rem;
        }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 0.85rem;
            color: var(--del-text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.15s ease-in-out;
            position: relative;
        }

        .sidebar-nav-item i {
            font-size: 1.05rem;
            transition: color 0.15s ease-in-out;
        }

        .sidebar-nav-item:hover {
            color: var(--del-text-main);
            background-color: #F9FAFB;
        }

        .sidebar-nav-item.active {
            color: var(--del-primary);
            background-color: var(--del-soft-lavender);
            font-weight: 600;
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
            width: 3.5px;
            background-color: var(--del-primary);
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
        }

        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid var(--del-border);
            font-size: 0.775rem;
            color: var(--del-text-muted);
            background-color: #FCFDFF;
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
            border-radius: 10px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.03);
            margin-bottom: 1.5rem;
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
            font-weight: 600;
            color: var(--del-text-main);
            margin: 0;
        }

        .ui-card-body {
            padding: 1.35rem;
        }

        /* Minimalist Buttons */
        .btn-del {
            background-color: var(--del-primary);
            color: #FFFFFF !important;
            border: 1px solid var(--del-primary);
            font-weight: 500;
            font-size: 0.875rem;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
        }

        .btn-del:hover {
            background-color: var(--del-deep);
            border-color: var(--del-deep);
            box-shadow: 0 2px 6px rgba(76, 29, 149, 0.2);
        }

        .btn-outline-del {
            background-color: transparent;
            color: var(--del-primary) !important;
            border: 1px solid var(--del-border);
            font-weight: 500;
            font-size: 0.875rem;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
        }

        .btn-outline-del:hover {
            background-color: var(--del-soft-lavender);
            border-color: var(--del-primary);
        }

        .btn-secondary-del {
            background-color: #F3F4F6;
            color: #374151 !important;
            border: 1px solid #E5E7EB;
            font-weight: 500;
            font-size: 0.875rem;
            border-radius: 6px;
            padding: 0.5rem 0.95rem;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
        }

        .btn-secondary-del:hover {
            background-color: #E5E7EB;
            color: #1F2937 !important;
        }

        /* Form Controls */
        .form-label {
            font-size: 0.825rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.35rem;
        }

        .form-control, .form-select {
            font-size: 0.875rem;
            border: 1px solid var(--del-border);
            border-radius: 6px;
            padding: 0.525rem 0.85rem;
            color: var(--del-text-main);
            background-color: #FFFFFF;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--del-primary);
            box-shadow: 0 0 0 3px rgba(76, 29, 149, 0.12);
            outline: none;
        }

        /* Tables */
        .table-del {
            margin: 0;
            width: 100%;
        }

        .table-del th {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6B7280;
            background-color: #F9FAFB;
            border-bottom: 1px solid var(--del-border);
            padding: 0.85rem 1.15rem;
            white-space: nowrap;
        }

        .table-del td {
            font-size: 0.875rem;
            color: var(--del-text-main);
            padding: 1rem 1.15rem;
            vertical-align: middle;
            border-bottom: 1px solid #F1F3F7;
        }

        .table-del tbody tr {
            transition: background-color 0.1s ease;
        }

        .table-del tbody tr:hover {
            background-color: #FBFBFE;
        }

        /* Badges */
        .badge-category {
            background-color: var(--del-soft-lavender);
            color: var(--del-primary);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35rem 0.65rem;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            text-decoration: none;
        }

        .badge-status {
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.35rem 0.65rem;
            border-radius: 5px;
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
            border-radius: 8px;
            padding: 0.875rem 1.15rem;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border: 1px solid transparent;
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
                background-color: rgba(0, 0, 0, 0.35);
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
                    <div class="sidebar-brand-title">SIPUS<span style="color: var(--del-primary);">-Del</span></div>
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
                    <span class="badge bg-light text-dark border p-1" style="font-size: 0.65rem;">IT DEL</span>
                    <div>
                        <div class="fw-semibold text-dark" style="font-size: 0.775rem;">Institut Teknologi Del</div>
                        <div style="font-size: 0.7rem; color: #9CA3AF;">Kampus Laguboti, Toba</div>
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
                        <div class="text-muted" style="font-size: 0.75rem;">SIPUS-Del &bull; Perpustakaan</div>
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
