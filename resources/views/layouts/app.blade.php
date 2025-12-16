<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul ?? 'Yuvee Essence' }}</title>

    {{-- CSS utama --}}
    <link rel="stylesheet" href="{{ asset('css/frontend-home.css') }}">

    {{-- Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    {{-- HEADER --}}
    <header class="topbar">
        <div class="topbar-left">
            <img src="{{ asset('storage/Products/logo.png') }}"
                alt="Logo"
                class="logo-kecil">
            <span class="topbar-title">Yuvee Essence</span>
        </div>
    </header>

    {{-- NAVBAR --}}
    <nav class="navbar">
        <div class="navbar-container">
            <div class="logo">
                <span class="brand">Yuvee <span>Essence</span></span>
            </div>

            <ul class="nav-links">
                <li>
                    <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a>
                </li>
                <li><a href="{{ route('produk.index') }}" class="{{ Request::routeIs('produk.*') ? 'active' : '' }}">Produk</a></li>
                <li><a href="{{ route('tentang') }}" class="{{ Request::routeIs('tentang') ? 'active' : '' }}">Tentang</a></li>
                <li><a href="{{ route('kontak') }}" class="{{ Request::routeIs('kontak') ? 'active' : '' }}">Kontak</a></li>
            </ul>
        </div>
    </nav>

    {{-- KONTEN --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="footer">
        <div class="footer-container">

            {{-- KOLOM 1 : LOGO --}}
            <div class="footer-logo">
                <img src="{{ asset('storage/Products/logo.png') }}" alt="Yuvee Essence Logo" class="footer-logo-img">
                <h3>Yuvee Essence</h3>
                <p>Kecantikan yang alami, dari hati.</p>
            </div>

            {{-- KOLOM 2 : EXPLORE --}}
            <div class="footer-links">
                <h3>Explore</h3>
                <ul>
                    <li><a href="{{ route('tentang') }}">About Us</a></li>
                    <li><a href="{{ route('kontak') }}">Contact</a></li>
                    <li><a href="/kebijakan-privasi">Kebijakan Privasi</a></li>
                    <li><a href="{{ route('syarat') }}">Syarat & Ketentuan</a></li>
                </ul>
            </div>

            {{-- KOLOM 3 : CONTACT / SUBSCRIBE --}}
            <div class="footer-contact">
                <h4>Stay in Touch</h4>
                <p>Welcome to our Yuvee world!</p>
                <form action="#" novalidate>
                    <input type="email" placeholder="Your Email">
                    <button type="submit">OK</button>
                </form>
                </form>
            </div>

        </div>

        <p class="copyright">©2025, Yuvee Essence</p>
    </footer>

</body>

</html>