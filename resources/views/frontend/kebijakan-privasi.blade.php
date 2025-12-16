@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/frontend-privacy.css') }}">

<section class="privacy-section">
    <div class="privacy-container">
        <h2 class="privacy-title">🔒 Kebijakan Privasi</h2>

        <div class="privacy-content">
            <p>
                Di <strong>Yuvee Essence</strong>, privasimu adalah prioritas kami. Kami berkomitmen untuk
                melindungi setiap informasi pribadi yang kamu berikan saat menggunakan situs kami atau berbelanja
                produk Yuvee Essence.
            </p>

            <ol class="privacy-list">
                <li>
                    <strong>Pengumpulan Data:</strong> Kami hanya mengumpulkan data yang diperlukan untuk
                    keperluan transaksi dan pelayanan pelanggan.
                </li>
                <li>
                    <strong>Kerahasiaan Data:</strong> Data pribadimu tidak akan dibagikan kepada pihak ketiga tanpa izin.
                </li>
                <li>
                    <strong>Keamanan Informasi:</strong> Kami menggunakan sistem keamanan yang terenkripsi untuk menjaga
                    kerahasiaan informasi pelanggan.
                </li>
                <li>
                    <strong>Hak Pengguna:</strong> Kamu berhak meminta penghapusan atau pembaruan data pribadimu kapan saja.
                </li>
                <li>
                    <strong>Pembaruan Kebijakan:</strong> Dengan menggunakan layanan kami, kamu menyetujui kebijakan privasi
                    ini. Kami dapat memperbarui ketentuan ini sewaktu-waktu, dan versi terbaru akan selalu tersedia di halaman ini.
                </li>
            </ol>

            <p class="privacy-note">
                Terima kasih telah mempercayai <strong>Yuvee Essence</strong> — keindahanmu adalah rahasia yang kami jaga. 💖
            </p>
        </div>
    </div>
</section>
@endsection