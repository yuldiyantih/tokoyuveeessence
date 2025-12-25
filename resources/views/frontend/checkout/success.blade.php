@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/frontend-checkout.css') }}">

<section class="checkout-page">
    <div class="checkout-container" style="grid-template-columns: 1fr; text-align:center;">

        <div class="checkout-card" style="padding:50px 30px;">

            <h2>Pesanan Kamu Sedang Diproses 💕</h2>

            <p style="font-size:16px; color:#222; margin-top:20px; line-height:1.8;">
                Terima kasih sudah mempercayai kami ✨<br>
                Pesanan kamu telah berhasil dibuat dan sedang kami siapkan dengan penuh cinta 💖
            </p>

            <p style="font-size:15px; color:#555; margin-top:15px;">
                Kami akan memastikan produk terbaik sampai ke tangan kamu dengan aman dan cepat 🚚💨
            </p>

            <div style="margin-top:35px;">
                <a href="{{ route('home') }}" class="btn-submit" style="text-decoration:none; display:inline-block;">
                    ⬅️ Kembali ke Beranda
                </a>
            </div>

            <p style="margin-top:30px; font-size:14px; color:#777;">
                Tetap cantik dan percaya diri setiap hari 🌸✨
            </p>

        </div>

    </div>
</section>
@endsection