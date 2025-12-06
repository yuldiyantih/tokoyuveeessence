@extends('admin.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin-product-edit.css') }}">

<div class="create-container">

    <div class="create-card">

        <!-- LEFT: Upload Image -->
        <div class="left-side">
            <div class="image-preview">
                <img src="{{ asset('img/default-user.png') }}" alt="preview" id="imgPreview">
            </div>

            <label class="label-upload">Choose File</label>
            <input type="file" name="image" id="imageUpload" class="input-upload">
        </div>

        <script>
            document.getElementById('imageUpload').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    document.getElementById('imgPreview').src = URL.createObjectURL(file);
                }
            });
        </script>


        <!-- RIGHT: Form -->
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="right-side">
            @csrf

            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="name">
            </div>

            <div class="form-group">
                <label>Slug</label>
                <input type="text" name="slug">
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description"></textarea>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="price">
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stock">
            </div>

            <!-- BUTTONS -->
            <div class="button-group">
                <button type="submit" class="btn-simpan">Simpan Produk</button>
                <a href="{{ route('admin.products.index') }}" class="btn-kembali">Kembali</a>
            </div>
        </form>

    </div>

</div>

@endsection