@extends('layouts.dashboard')

@section('title', 'Manajemen User')
@section('header', 'Kelola Pengguna Sistem')

@section('content')
@if(session('success'))
<div style="background: var(--success); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
    {{ session('success') }}
</div>
@endif

<div class="header" style="margin-bottom: 1rem;">
    <h2 style="font-size: 1.25rem; font-weight: 700;">Daftar Semua User</h2>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah User Baru</a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>No. Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td style="font-weight: 600;">{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>
                    <span class="badge {{ $user->role == 'admin' ? 'badge-primary' : ($user->role == 'guru' ? 'badge-success' : 'badge-warning') }}" style="text-transform: uppercase;">
                        {{ str_replace('_', ' ', $user->role) }}
                    </span>
                </td>
                <td>{{ $user->phone ?? '-' }}</td>
                <td>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary" style="padding: 0.25rem 0.5rem;"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem;"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
