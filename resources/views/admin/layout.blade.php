<!doctype html>
<html lang="en">

<head>
    <!-- Bootstrap & SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Global CSS -->
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-users.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/riwayat-transaksi-detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/riwayat-transaksi.css') }}">

    <!-- untuk @push('styles') -->
    @stack('styles')

    <style>
        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 250px !important;
            background: #800020 !important;
            /* MAROON */
            color: #ffffff !important;
            min-height: 100vh !important;
            padding: 20px !important;
            transition: all 0.3s ease !important;
            overflow: hidden;
        }

        /* COLLAPSE MODE */
        .sidebar.collapsed {
            width: 80px !important;
            padding: 20px 10px !important;
        }

        .sidebar.collapsed .brand-name,
        .sidebar.collapsed .menu span {
            display: none !important;
        }

        .sidebar.collapsed a {
            justify-content: center !important;
        }

        /* BRAND */
        .sidebar .brand {
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
            margin-bottom: 25px !important;
        }

        .sidebar .brand img {
            width: 40px !important;
            height: 40px !important;
            object-fit: cover !important;
            border-radius: 8px !important;
        }

        /* MENU */
        .sidebar .menu li {
            list-style: none !important;
            margin-bottom: 10px !important;
        }

        .sidebar a {
            text-decoration: none !important;
            color: #ffffff !important;
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
            padding: 12px 15px !important;
            border-radius: 12px !important;
            transition: all 0.25s ease !important;
            font-weight: 500;
        }

        /* HOVER & ACTIVE */
        .sidebar li.active a,
        .sidebar a:hover {
            background: #f8a1c4 !important;
            /* PINK SOFT */
            color: #800020 !important;
            transform: translateX(5px);
        }

        /* ICON */
        .sidebar svg {
            width: 18px !important;
            height: 18px !important;
            transition: 0.3s;
        }

        /* CONTENT TRANSITION */
        .content {
            transition: margin-left 0.3s ease;
        }
    </style>
</head>

<body>

    <div class="admin-wrapper d-flex">

        <!-- SIDEBAR -->
        <aside class="sidebar">

            <div class="brand">
                <img src="{{ asset('storage/products/logonew.jpeg') }}" alt="Logo">
                <span class="brand-name">Yuvee Essence</span>
            </div>

            <ul class="menu mt-4">

                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i data-feather="home"></i>
                        <span>Beranda</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}">
                        <i data-feather="users"></i>
                        <span>User</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}">
                        <i data-feather="box"></i>
                        <span>Data Produk</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.transactions.index') }}">
                        <i data-feather="clipboard"></i>
                        <span>Riwayat Transaksi</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile.index') }}">
                        <i data-feather="settings"></i>
                        <span>Setting</span>
                    </a>
                </li>

            </ul>

        </aside>

        <!-- MAIN CONTENT -->
        <main class="content flex-grow-1">

            <nav class="topbar d-flex justify-content-between align-items-center">
                <button class="btn btn-light">≡</button>

                <div>
                    <a href="{{ route('admin.profile.show') }}" class="btn btn-sm btn-outline-secondary">
                        Profile
                    </a>

                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-outline-danger">Logout</button>
                    </form>
                </div>
            </nav>

            <div class="container-fluid mt-3">
                @yield('content')
            </div>

        </main>

    </div>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>

    <!-- COLLAPSE SIDEBAR -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.querySelector(".topbar button");
            const sidebar = document.querySelector(".sidebar");

            toggleBtn.addEventListener("click", function() {
                sidebar.classList.toggle("collapsed");
            });
        });
    </script>

    <!-- untuk @push('scripts') -->
    @stack('scripts')

</body>

</html>