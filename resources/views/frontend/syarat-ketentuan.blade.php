@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/frontend-syarat.css') }}">

<section class="syarat-section">
    <div class="syarat-container">
        <h2 class="syarat-title">📜 Syarat dan Ketentuan Penggunaan</h2>

        <div class="syarat-content">
            <p>Selamat datang di situs resmi <strong>Yuvee Essence</strong>.</p>

            <p>
                Dengan mengakses atau menggunakan layanan kami, kamu dianggap telah membaca,
                memahami, dan menyetujui syarat & ketentuan berikut:
            </p>

            <ol class="syarat-list">
                <li>
                    <strong>Penggunaan Produk:</strong>
                    Produk <strong>Yuvee Essence</strong> ditujukan untuk penggunaan pribadi, bukan untuk dijual kembali tanpa izin resmi.
                </li>

                <li>
                    <strong>Perubahan Harga dan Ketersediaan:</strong>
                    Harga dan ketersediaan produk dapat berubah sewaktu-waktu tanpa pemberitahuan sebelumnya.
                </li>

                <li>
                    <strong>Penolakan Pesanan:</strong>
                    Kami berhak menolak atau membatalkan pesanan yang tidak memenuhi ketentuan kami.
                </li>

                <li>
                    <strong>Gambar Produk:</strong>
                    Gambar produk di situs ini hanya sebagai ilustrasi — warna dapat sedikit berbeda tergantung pencahayaan dan layar perangkat.
                </li>

                <li>
                    <strong>Persetujuan Transaksi:</strong>
                    Dengan bertransaksi di situs kami, kamu menyetujui seluruh syarat dan kebijakan yang berlaku.
                </li>
            </ol>

            <p class="syarat-note">
                Terima kasih telah mempercayakan perawatan kecantikanmu bersama <strong>Yuvee Essence</strong> 🌸
            </p>
        </div>
    </div>
</section>
@endsection