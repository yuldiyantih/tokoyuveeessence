@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/frontend-profile-customer.css') }}">

<div class="page-account">
    <div class="profile-container">

        <h2>Status Profil</h2>

        @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- =======================
             JIKA BELUM ADA PROFILE
           ======================= --}}
        @if($profiles->isEmpty())

        <div class="status-box warning">
            <strong>Profil kamu belum lengkap ❗</strong>
            <p>Lengkapi profil untuk memudahkan proses checkout.</p>
        </div>

        <a href="{{ route('customer.profile.index') }}" class="btn-save">
            ➕ Tambah Profil
        </a>

        {{-- =======================
             JIKA SUDAH ADA PROFILE
           ======================= --}}
        @else

        <div class="status-box success">
            <strong>Profil kamu sudah lengkap ✅</strong>
        </div>

        <div class="profile-list">
            @foreach($profiles as $profile)
            <div class="profile-card">

                <div class="account-item">
                    <span>Nama</span>
                    <strong>{{ $profile->name }}</strong>
                </div>

                <div class="account-item">
                    <span>Email</span>
                    <strong>{{ $profile->email }}</strong>
                </div>

                <div class="account-item">
                    <span>No HP</span>
                    <strong>{{ $profile->phone }}</strong>
                </div>

                <div class="account-item">
                    <span>Alamat</span>
                    <strong>
                        {{ $profile->address }}<br>
                        {{ $profile->city }}, {{ $profile->province }}<br>
                        {{ $profile->postal_code }}
                    </strong>
                </div>

                <div class="card-action">
                    <a href="{{ route('customer.profile.index', ['id' => $profile->id]) }}"
                        class="btn-edit">
                        ✏ Edit
                    </a>

                    <form method="POST"
                        action="{{ route('customer.profile.delete', $profile->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">🗑</button>
                    </form>
                </div>

            </div>
            @endforeach
        </div>

        <a href="{{ route('customer.profile.index') }}" class="btn-save">
            ➕ Tambah Profil
        </a>

        @endif

    </div>
</div>
@endsection