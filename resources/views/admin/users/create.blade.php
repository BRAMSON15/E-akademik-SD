@extends('layouts.dashboard')

@section('title', 'Tambah User')
@section('header', 'Tambah Pengguna Baru')

@section('content')
<div class="card-container">
    <h3 style="font-weight: 600; margin-bottom: 1rem; border-bottom: 2px solid var(--gray-light); padding-bottom: 0.5rem;">Form Data User</h3>
    
    @if ($errors->any())
    <div style="background: var(--danger); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
        <ul style="margin: 0; padding-left: 1.5rem;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 1rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
            </div>
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Role (Hak Akses)</label>
                <select name="role" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
                    <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="orang_tua" {{ old('role') == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">No. Telepon (Opsional)</label>
                <input type="text" name="phone" value="{{ old('phone') }}" style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Password</label>
                <input type="password" name="password" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
            </div>
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan User</button>
        <a href="{{ route('admin.users.index') }}" class="btn" style="background: var(--gray-light); color: var(--dark); margin-left: 0.5rem;">Batal</a>
    </form>
</div>
@endsection
