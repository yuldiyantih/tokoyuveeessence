@extends('layouts.app')

@section('content')
<!-- Panggil CSS khusus produk -->
<link rel="stylesheet" href="{{ asset('css/frontend-produk.css') }}">

<section class="produk-hero">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Enjoy shopping<br>with us!</h1>
        </div>
        <div class="hero-image">
            <!-- HERO IMAGE -->
            <img src="{{ asset('storage/products/modelproduk1.png') }}" alt="Model Yuvee Essence">
        </div>
    </div>
</section>

<section class="produk-grid">
    @foreach ($products as $product)
    <div class="product-card">

        <!-- PERBAIKAN GAMBAR PRODUK -->
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">

        <h3>{{ $product->name }}</h3>
        <p>Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
        <a href="{{ route('produk.show', $product->id) }}" class="view-btn">View More</a>
    </div>
    @endforeach
</section>

@endsection