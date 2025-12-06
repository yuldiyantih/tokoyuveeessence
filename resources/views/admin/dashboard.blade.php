@extends('admin.layout')

@section('content')

<div class="dashboard-header d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">All Product</h4>
</div>

<div class="product-grid d-flex flex-wrap gap-3">

    @foreach($products as $p)
    <div class="product-card p-3 rounded shadow-sm" style="width: 230px; background: #fff;">

        <div class="product-img mb-2" style="height: 160px; overflow: hidden; border-radius: 10px;">
            <img
                src="{{ asset('storage/' . $p->image) }}" <!-- YANG SUDAH DIPERBAIKI -->
            alt="{{ $p->name }}"
            style="width: 100%; height: 100%; object-fit: contain;">
        </div>

        <div class="product-info text-center">
            <span class="name d-block fw-bold">{{ $p->name }}</span>
            <span class="price text-danger fw-bold">Rp {{ number_format($p->price, 0, ',', '.') }}</span>
        </div>

    </div>
    @endforeach

</div>

@endsection