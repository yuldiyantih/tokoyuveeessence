@extends('admin.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin-product-create.css') }}">

<div class="create-container">

    <!-- FORM membungkus SELURUH card -->
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="create-card">

            <!-- KIRI: Upload Image -->
            <div class="left-side">
                <div class="image-preview">
                    <img src="{{ asset('img/default-user.png') }}" alt="preview" id="imgPreview">
                </div>

                <label class="label-upload">Choose File</label>
                <input type="file" name="image" id="imageUpload" class="input-upload" required>
            </div>

            <!-- KANAN: Form Detail Produk -->
            <div class="right-side">
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="name" required>
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
                    <input type="number" name="price" required>
                </div>

                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stock" required>
                </div>

                <!-- BUTTONS -->
                <div class="button-group">
                    <button type="submit" class="btn-simpan">Simpan Produk</button>
                    <a href="{{ route('admin.products.index') }}" class="btn-kembali">Kembali</a>
                </div>
            </div>

        </div> <!-- end of create-card -->
    </form> <!-- end of form -->

</div>

<!-- Script untuk preview gambar -->
<script>
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            document.getElementById('imgPreview').src = URL.createObjectURL(file);
        }
    });
</script>

@endsection