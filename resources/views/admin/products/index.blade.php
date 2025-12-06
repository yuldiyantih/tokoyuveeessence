@extends('admin.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin-product.css') }}">

<div class="product-card">

    <!-- Header -->
    <h2 class="page-title">Data Produk</h2>

    <!-- Tombol Tambah -->
    <div class="add-btn-wrapper">
        <a href="{{ route('admin.products.create') }}" class="btn-tambah">
            + Tambah Produk
        </a>
    </div>

    <!-- Table -->
    <table class="table-produk">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th style="text-align: center;">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->name }}</td>

                <td>
                    <div class="aksi-group">

                        <!-- Tombol Ubah -->
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-ubah">
                            ✏️ Ubah
                        </a>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus" onclick="return confirm('Yakin hapus produk ini?')">
                                🗑️ Hapus
                            </button>
                        </form>

                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection