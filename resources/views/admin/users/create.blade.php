@extends('admin.layout')

@push('styles')
<link href="{{ asset('css/admin-users.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="user-container page-user-create">

    <h2 class="title">Tambah User</h2>

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul style="margin:0; padding-left:20px;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- NOTIFIKASI SUKSES --}}
    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST" class="form-card">
        @csrf

        <div class="form-group">
            <label class="form-label">Email</label>
            <input
                type="email"
                name="email"
                class="form-input"
                value="{{ old('email') }}"
                required>
        </div>

        <div class="form-group">
            <label class="form-label">Nama</label>
            <input
                type="text"
                name="name"
                class="form-input"
                value="{{ old('name') }}"
                required>
        </div>

        <div class="form-group">
            <label class="form-label">Password</label>
            <input
                type="password"
                name="password"
                class="form-input"
                required>
        </div>

        <div class="form-group">
            <label class="form-label">Role</label>
            <select name="role" class="form-input" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>
                <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>
                    Super Admin
                </option>
            </select>
        </div>

        <button type="submit" class="btn-submit">
            Simpan
        </button>
    </form>

</div>
@endsection