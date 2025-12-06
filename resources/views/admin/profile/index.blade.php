@extends('admin.layout')

@section('content')
<div class="profile-container">
    <div class="profile-card">

        <h2 class="title">Ubah Profil Manager</h2>

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-grid">

                {{-- FOTO --}}
                <div class="photo-section">
                    <label>Foto</label>

                    <div class="photo-box">
                        @if($manager->foto)
                        <img id="preview-photo"
                            src="{{ asset('uploads/profile/' . $manager->foto) }}"
                            class="preview-photo">
                        @else
                        <img id="preview-photo" class="preview-photo" style="display:none;">
                        <div class="photo-placeholder"></div>
                        @endif
                    </div>

                    <input type="file" name="foto" class="file-input" id="file-input">
                </div>

                {{-- PREVIEW SCRIPT --}}
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const input = document.getElementById('file-input');
                        const preview = document.getElementById('preview-photo');

                        input.addEventListener('change', function(event) {
                            const file = event.target.files[0];
                            if (file) {
                                preview.src = URL.createObjectURL(file);
                                preview.style.display = 'block';

                                const placeholder = document.querySelector('.photo-placeholder');
                                if (placeholder) placeholder.style.display = 'none';
                            }
                        });
                    });
                </script>

                {{-- FORM RIGHT SIDE --}}
                <div class="form-section">

                    {{-- STATUS --}}
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status">
                            <option value="aktif" {{ $manager->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ $manager->status == 'nonaktif' ? 'selected' : '' }}>Non Aktif</option>
                        </select>
                    </div>

                    {{-- NAMA --}}
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" value="{{ $manager->name }}">
                    </div>

                    {{-- EMAIL --}}
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $manager->email }}">
                    </div>

                    {{-- NO HP --}}
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="no_hp" value="{{ $manager->no_hp }}">
                    </div>

                </div>
            </div>

            <div class="btn-area">
                <button type="submit" class="btn-update">Perbaharui</button>
                <a href="{{ route('admin.dashboard') }}" class="btn-back">Kembali</a>
            </div>

        </form>

    </div>
</div>
@endsection