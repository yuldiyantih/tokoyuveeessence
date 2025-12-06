@extends('admin.layout')

@section('content')

{{-- Flash Message --}}
@if(session('success'))
<div class="alert-success">
    {{ session('success') }}
</div>
@endif
<div class="user-container">

    <a href="{{ route('admin.users.create') }}" class="btn-tambah">+ Tambah</a>

    <h2 class="title">Data User</h2>

    <div class="card">
        <table class="table-user">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $i => $u)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->name }}</td>
                    <td>
                        @if($u->role === 'superadmin')
                        <span class="role-superadmin">Super Admin</span>
                        @else
                        <span class="role-admin">Admin</span>
                        @endif
                    </td>

                    <td class="status-buttons">
                        <a href="{{ route('admin.users.edit', $u->id) }}" class="btn-edit">✏ Ubah</a>

                        <form action="{{ route('admin.users.destroy', $u->id) }}"
                            method="POST"
                            onsubmit="return confirm('Apakah kamu yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete">Hapus</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
@endsection