@extends('admin.layout')

@section('content')
<div class="form-container">
    <h2 class="form-title">Tambah User</h2>

    <form action="{{ route('admin.users.store') }}" method="POST" class="form-card">
        @csrf

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-input">
                <option value="admin">Admin</option>
                <option value="superadmin">Super Admin</option>
            </select>
        </div>

        <button class="btn-submit">Simpan</button>
    </form>
</div>
@endsection