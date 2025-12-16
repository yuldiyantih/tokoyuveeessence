<!doctype html>
<html lang="en">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/layout.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin-users.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin-product.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin-profile.css') }}">

@stack('css')

<style>
    .sidebar {
        width: 250px;
        background: #222;
        color: white;
        min-height: 100vh;
        padding: 20px;
    }

    .sidebar .brand {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar .brand img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 8px;
    }

    .sidebar .menu li {
        list-style: none;
        margin-bottom: 10px;
    }

    .sidebar a {
        text-decoration: none !important;
        color: white !important;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px;
        border-radius: 8px;
        transition: 0.2s;
    }

    .sidebar li.active a,
    .sidebar a:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .topbar {
        background: #fff;
        padding: 15px;
        border-bottom: 1px solid #eee;
    }

    .sidebar svg {
        width: 18px;
        height: 18px;
        margin-right: 8px;
    }
</style>
</head>

<body>

    <div class="admin-wrapper d-flex">

        <!-- Sidebar -->
        <aside class="sidebar">

            <div class="brand">
                <img src="{{ asset('storage/products/logonew.jpeg') }}" alt="Logo">
                <span class="brand-name">Yuvee Essence</span>
            </div>

            <ul class="menu mt-4">

                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i data-feather="home"></i> Beranda
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}">
                        <i data-feather="users"></i> User
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}">
                        <i data-feather="box"></i> Data Produk
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.transactions.index') }}">
                        <i data-feather="clipboard"></i> Riwayat Transaksi
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile.index') }}">
                        <i data-feather="settings"></i> Setting
                    </a>
                </li>

            </ul>

        </aside>

        <!-- Main Content -->
        <main class="content flex-grow-1">

            <nav class="topbar d-flex justify-content-between align-items-center">
                <button class="btn btn-light">≡</button>

                <div>
                    <!-- 🔥 Link navbar Profile diperbaiki -->
                    <a href="{{ route('admin.profile.show') }}" class="btn btn-sm btn-outline-secondary">Profile</a>

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
    <script src="https://unpkg.com/feather-icons"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            feather.replace();
        });
    </script>

</body>

</html>

</script>

</body>

</html>