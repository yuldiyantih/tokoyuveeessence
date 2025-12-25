@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/frontend-checkout.css') }}">

<div class="checkout-page">

    <h2>Halaman Checkout</h2>

    <div class="checkout-container">

        {{-- =======================
            KIRI - RINGKASAN PESANAN
        ======================= --}}
        <div class="checkout-card">
            <h4>Ringkasan Pesanan</h4>

            @foreach($cartItems as $item)
            <div class="order-item">
                <div class="order-left">
                    <p>{{ $item->product->name }}</p>
                    <small>
                        {{ $item->quantity }} x Rp {{ number_format($item->product->price, 0, ',', '.') }}
                    </small>
                </div>

                <div class="order-right">
                    Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                </div>
            </div>
            @endforeach

            <hr>

            <div class="order-total">
                <span>Total Pembayaran</span>
                <strong>
                    Rp {{ number_format($total, 0, ',', '.') }}
                </strong>
            </div>
        </div>


        {{-- =======================
            KANAN - CUSTOMER + PEMBAYARAN
        ======================= --}}
        <div class="checkout-card">
            <h4>Informasi Customer</h4>

            <div class="info-row">
                <span>Nama Lengkap</span>
                <strong>{{ $profile->name }}</strong>
            </div>

            <div class="info-row">
                <span>Email</span>
                <strong>{{ $profile->email }}</strong>
            </div>

            <div class="info-row">
                <span>No. Telepon</span>
                <strong>{{ $profile->phone }}</strong>
            </div>

            <div class="info-row">
                <span>Alamat Lengkap</span>
                <strong>
                    {{ $profile->address }} <br>
                    {{ $profile->city }},
                    {{ $profile->province }},
                    {{ $profile->postal_code }}
                </strong>
            </div>
        </div>


        <hr>

        <form action="{{ route('customer.checkout.process') }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf

            {{-- 🔥 KIRIM CART IDS JIKA CHECKOUT DARI CART --}}
            @if(isset($cartItems))
            @foreach($cartItems as $item)
            @if(isset($item->id))
            <input type="hidden" name="cart_ids[]" value="{{ $item->id }}">
            @endif
            @endforeach
            @endif

            <label>Metode Pembayaran</label>
            <select name="payment_method" required>
                <option value="">-- Pilih Bank --</option>
                <option value="BCA">Transfer BCA (1234567890)</option>
                <option value="BRI">Transfer BRI (1204567856)</option>
                <option value="Mandiri">Transfer Mandiri (1223344557)</option>
                <option value="BSI">Transfer BSI (1223344596)</option>
            </select>

            <label>Upload Bukti Pembayaran</label>
            <input type="file" name="payment_proof" required>
            <small>Max 5MB</small>

            <button type="submit" class="btn-submit">
                Pesan Sekarang
            </button>
        </form>

    </div>
</div>
@endsection