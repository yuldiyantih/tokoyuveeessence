@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}
<section class="hero">
    <div class="hero-text">
        <h1>Glow up your skin,</h1>
        <h1>show up your shine!</h1>
        <p>
            Discover make up picks that keep you glowing, laughing, and loving your self every day.
        </p>
        <a href="{{ route('produk.index') }}" class="shop-btn">Shop Now</a>
    </div>

    <div class="hero-img">
        <img src="{{ asset('storage/products/backgroundhome1.png') }}" alt="Yuvee Essence">
    </div>
</section>

{{-- BESTSELLER SECTION --}}
<section class="bestseller-section">
    <h2>Our Bestsellers</h2>

    @php
    // 3 gambar bestseller statis dari public/storage/products
    $bestsellerImages = [
    asset('storage/products/lipstikmerah1remove.png'),
    asset('storage/products/foundation.png'),
    asset('storage/products/blushon3.png'),
    ];
    @endphp

    <div class="product-grid">
        @foreach ($products as $index => $product)
        <div class="product-card">

            {{-- Gambar statis bestseller --}}
            <img src="{{ $bestsellerImages[$index % 3] }}" alt="Bestseller Product">

            <h3>{{ $product->name }}</h3>
            <p>★★★★★ <span>5.0</span></p>

            <form action="{{ route('checkout.index', $product->id) }}" method="GET">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="cart-btn">Buy Now</button>
            </form>

        </div>
        @endforeach
    </div>
</section>


{{-- ESSENCE HIGHLIGHT --}}
<section class="essence-highlight">
    <div class="highlight-text">
        <h2>"Whispers of Beauty, Touched by Yuvee"</h2>
        <p>
            Yuvee Essence — karena setiap warna punya cerita. Discover shades that make you smile and confidence that never fades.
        </p>
        <a href="{{ route('produk.index') }}" class="btn explore-btn">Explore our collection</a>
    </div>

    <div class="highlight-img">
        <img src="{{ asset('storage/products/backgroundhome4.png') }}" alt="Koleksi Cantik">
    </div>
</section>

@endsection