@extends('layouts.dashboard')

@section('title', 'Edit User')
@section('header', 'Edit Pengguna: ' . $user->name)

@section('content')
<div class="card-container">
    <h3 style="font-weight: 600; margin-bottom: 1rem; border-bottom: 2px solid var(--gray-light); padding-bottom: 0.5rem;">Form Edit Data User</h3>
    
    @if ($errors->any())
    <div style="background: var(--danger); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
        <ul style="margin: 0; padding-left: 1.5rem;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
            </div>
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Role (Hak Akses)</label>
                <select name="role" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
                    <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="orang_tua" {{ old('role', $user->role) == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">No. Telepon (Opsional)</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
            </div>
        </div>

        <div style="margin-bottom: 1.5rem; background: var(--gray-light); padding: 1rem; border-radius: 0.5rem;">
            <p style="margin-bottom: 0.5rem; font-size: 0.875rem; color: var(--gray);">Kosongkan jika tidak ingin mengubah password.</p>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Password Baru</label>
                    <input type="password" name="password" style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 0.25rem;">
                </div>
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 0.25rem;">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="{{ route('admin.users.index') }}" class="btn" style="background: #e5e7eb; color: var(--dark); margin-left: 0.5rem;">Batal</a>
    </form>
</div>
@endsection
