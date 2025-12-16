@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/frontend-checkout.css') }}">

<section class="checkout-page">

    <h2>Checkout</h2>

    <div class="checkout-container">

        {{-- PRODUK KIRI --}}
        <div class="checkout-product">

            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">

            <h3>{{ $product->name }}</h3>
            <p>Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p>Jumlah: {{ $qty }}</p>
            <p class="total">
                Total: Rp {{ number_format($product->price * $qty, 0, ',', '.') }}
            </p>

        </div>

        {{-- FORM KANAN --}}
        <form action="{{ route('checkout.process', $product->id) }}" method="POST" class="checkout-form">
            @csrf

            <input type="hidden" name="quantity" value="{{ $qty }}">

            <label>Nama Lengkap</label>
            <input type="text" name="customer_name" required>

            <label>Email</label>
            <input type="email" name="customer_email" required>

            <label>No Handphone</label>
            <input type="text" name="customer_phone" required>

            <label>Alamat Lengkap</label>
            <textarea name="customer_address" required></textarea>

            <button type="submit" class="btn-submit">Buat Pesanan</button>
        </form>

    </div>

</section>

@endsection