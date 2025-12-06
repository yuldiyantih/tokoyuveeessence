@extends('admin.layout')

@section('content')

{{-- Tambahkan CSS --}}
<link rel="stylesheet" href="{{ asset('css/profilemanager.css') }}">

<div class="profile-wrapper">

    <h2 class="profile-title">Profil Manager</h2>

    <div class="profile-flex">

        {{-- FOTO --}}
        <div class="profile-photo">
            <img src="{{ asset('uploads/profile/' . $manager->foto) }}" alt="Foto Manager">
        </div>

        {{-- DATA --}}
        <div class="profile-data">
            <p><strong>Nama:</strong> {{ $manager->name }}</p>
            <p><strong>Email:</strong> {{ $manager->email }}</p>
            <p><strong>No HP:</strong> {{ $manager->no_hp }}</p>
            <p><strong>Status:</strong> {{ ucfirst($manager->status) }}</p>
        </div>

    </div>

    {{-- TOMBOL --}}
    <div class="profile-buttons">
        <a href="{{ route('admin.profile.index') }}" class="btn-pink">Ubah Profil</a>
        <a href="{{ route('admin.dashboard') }}" class="btn-blue">Kembali</a>
    </div>

</div>


@endsection