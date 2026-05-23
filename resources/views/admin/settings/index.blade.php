@extends('layouts.dashboard')

@section('title', 'Pengaturan Sistem')
@section('header', 'Pengaturan Sistem')

@section('content')
<div class="card-container">
    <h3 style="font-weight: 600; margin-bottom: 1rem; border-bottom: 2px solid var(--gray-light); padding-bottom: 0.5rem;">Pengaturan Umum</h3>
    
    @if(session('success'))
    <div style="background: var(--success); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <div style="margin-bottom: 1.5rem; max-width: 400px;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Tahun Ajaran Aktif</label>
            <input type="text" name="tahun_ajaran" value="{{ $tahun_ajaran }}" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;" placeholder="Contoh: 2023/2024">
            <small style="color: var(--gray); display: block; margin-top: 0.25rem;">Tahun ajaran ini akan menjadi *default* ketika guru menginput nilai siswa.</small>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
    </form>
</div>
@endsection
