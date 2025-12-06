@extends('admin.layout')

@section('content')
<div class="form-container">
    <h2 class="form-title">Edit User</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="form-card">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="{{ $user->email }}" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-input">
                <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                <option value="superadmin" {{ $user->role=='superadmin'?'selected':'' }}>Super Admin</option>
            </select>
        </div>

        <button class="btn-submit">Update</button>
    </form>
</div>
@endsection