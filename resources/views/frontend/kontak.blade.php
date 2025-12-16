@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/frontend-kontak.css') }}">

<section class="contact-section">
    <div class="contact-container">
        <h2 class="contact-title">📞 Kontak Kami</h2>

        <div class="contact-content">
            <p><strong>Hubungi Yuvee Essence – We’re Here for You!</strong></p>

            <ol class="contact-list">
                <li>
                    <strong>Customer Service:</strong><br>
                    (+62) 8111-2222-7777<br>
                    <a href="mailto:support@yuveeessence.com">support@yuveeessence.com</a><br>
                    Setiap hari pukul 09.00 – 21.00 WIB
                </li>

                <li>
                    <strong>Alamat Kantor Pusat:</strong><br>
                    Jl. Pembangunan 3, Neglasari, Kota Tangerang, Indonesia
                </li>

                <li>
                    <strong>Media Sosial:</strong><br>
                    Instagram: <a href="https://www.instagram.com/yuveeessence" target="_blank">@yuveeessence</a><br>
                    TikTok: <a href="https://www.tiktok.com/@yuveeessence.id" target="_blank">@yuveeessence.id</a><br>
                    Facebook: <a href="https://www.facebook.com/yuveeessenceofficial" target="_blank">Yuvee Essence Official</a>
                </li>
            </ol>

            <p class="contact-note">
                ✨ Glow up your skin, show up your shine! ✨
            </p>
        </div>
    </div>
</section>
@endsection