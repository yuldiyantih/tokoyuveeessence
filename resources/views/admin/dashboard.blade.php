@extends('admin.layout')

@section('content')

<div class="dashboard-header d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">All Product</h4>
</div>

{{-- GRID PRODUK --}}
<div class="product-grid">

    @foreach($products as $p)
    <div class="product-card">

        {{-- GAMBAR PRODUK --}}
        <div class="product-img">
            <img
                src="{{ asset('storage/' . $p->image) }}"
                alt="{{ $p->name }}">
        </div>

        {{-- INFO PRODUK --}}
        <div class="product-info">
            <span class="name">{{ $p->name }}</span>
            <span class="price">
                Rp {{ number_format($p->price, 0, ',', '.') }}
            </span>
        </div>

    </div>
    @endforeach

</div>

@endsection