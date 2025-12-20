@extends('admin.layout')

@push('styles')
<link href="{{ asset('css/admin-users.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="user-container page-user-edit">

    <h2 class="title">Edit User</h2>

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

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="form-card">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Email</label>
            <input
                type="text"
                name="email"
                value="{{ old('email', $user->email) }}"
                class="form-input"
                required>
        </div>

        <div class="form-group">
            <label class="form-label">Nama</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                class="form-input"
                required>
        </div>

        <div class="form-group">
            <label class="form-label">Role</label>
            <select name="role" class="form-input" required>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>
                <option value="superadmin" {{ old('role', $user->role) == 'superadmin' ? 'selected' : '' }}>
                    Super Admin
                </option>
            </select>
        </div>

        <button type="submit" class="btn-submit">
            Update
        </button>
    </form>

</div>
@endsection