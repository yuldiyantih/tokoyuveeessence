@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/frontend-profile-customer.css') }}">

@php
// NULL-SAFE DEFAULT (PENTING)
$province = $profile->province ?? '';
$city = $profile->city ?? '';
@endphp

<div class="page-profile-form">
    <div class="profile-container">
        <h2>Profil Saya</h2>

        @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if($profile)
        {{-- MODE EDIT --}}
        <form method="POST"
            action="{{ route('customer.profile.update') }}"
            data-province="{{ $province }}"
            data-city="{{ $city }}">
            @csrf
            <input type="hidden" name="id" value="{{ $profile->id }}">
            @else
            {{-- MODE TAMBAH --}}
            <form method="POST"
                action="{{ route('customer.profile.store') }}"
                data-province=""
                data-city="">
                @csrf
                @endif

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text"
                        name="name"
                        value="{{ $profile->name ?? '' }}"
                        required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email"
                        value="{{ $profile->email ?? auth()->user()->email }}"
                        readonly>
                </div>

                <div class="form-group">
                    <label>No Handphone</label>
                    <input type="text"
                        name="phone"
                        value="{{ $profile->phone ?? '' }}">
                </div>

                <hr>

                <h3>Alamat Lengkap</h3>

                <div class="form-group">
                    <label>Alamat (Jalan, No Rumah)</label>
                    <textarea name="address" rows="3">{{ $profile->address ?? '' }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Provinsi</label>
                        <select name="province" id="province" required></select>
                    </div>

                    <div class="form-group">
                        <label>Kota / Kabupaten</label>
                        <select name="city" id="city" required></select>
                    </div>

                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="text"
                            name="postal_code"
                            value="{{ $profile->postal_code ?? '' }}">
                    </div>
                </div>

                <button type="submit" class="btn-save">Simpan</button>
            </form>
    </div>
</div>

{{-- =======================
     SCRIPT WILAYAH (AMAN)
   ======================= --}}
<script>
    (() => {
        const API = "https://www.emsifa.com/api-wilayah-indonesia/api";

        const form = document.querySelector("form");
        const provinceEl = document.getElementById("province");
        const cityEl = document.getElementById("city");

        const selectedProvince = form.dataset.province || "";
        const selectedCity = form.dataset.city || "";

        let provincesCache = [];

        const fetchJSON = async (url) => {
            const res = await fetch(url);
            if (!res.ok) throw new Error("Gagal load wilayah");
            return res.json();
        };

        const setOptions = (el, placeholder, items, selectedValue = "") => {
            el.innerHTML = `<option value="">${placeholder}</option>`;
            items.forEach(item => {
                const selected = item.name === selectedValue ? "selected" : "";
                el.innerHTML += `
                <option value="${item.name}" ${selected}>
                    ${item.name}
                </option>
            `;
            });
        };

        const loadProvinces = async () => {
            provincesCache = await fetchJSON(`${API}/provinces.json`);
            setOptions(provinceEl, "Pilih Provinsi", provincesCache, selectedProvince);

            if (selectedProvince) {
                const province = provincesCache.find(p => p.name === selectedProvince);
                if (province) loadCities(province.id);
            }
        };

        const loadCities = async (provinceId) => {
            if (!provinceId) return;
            const cities = await fetchJSON(`${API}/regencies/${provinceId}.json`);
            setOptions(cityEl, "Pilih Kota / Kabupaten", cities, selectedCity);
        };

        provinceEl.addEventListener("change", () => {
            const province = provincesCache.find(p => p.name === provinceEl.value);
            if (province) loadCities(province.id);
        });

        loadProvinces();
    })();
</script>

@endsection