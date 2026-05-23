@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
@section('header', 'Dashboard Utama')

@section('content')
<div class="stats-grid">
    <div class="stat-card" style="border-left: 4px solid var(--primary);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div class="label">Total Siswa</div>
                <div class="value">{{ \App\Models\Student::count() }}</div>
            </div>
            <div style="width: 48px; height: 48px; border-radius: 12px; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>
    </div>
    
    <div class="stat-card" style="border-left: 4px solid var(--secondary);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div class="label">Total Guru</div>
                <div class="value">{{ \App\Models\User::where('role', 'guru')->count() }}</div>
            </div>
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #d1fae5; color: var(--secondary); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
        </div>
    </div>
    
    <div class="stat-card" style="border-left: 4px solid var(--warning);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div class="label">Total Orang Tua</div>
                <div class="value">{{ \App\Models\User::where('role', 'orang_tua')->count() }}</div>
            </div>
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #fef3c7; color: var(--warning); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    
    <div class="stat-card" style="background: linear-gradient(135deg, var(--primary) 0%, #db2777 100%); color: white; border: none;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div class="label" style="color: rgba(255,255,255,0.9)">Tahun Ajaran</div>
                <div class="value" style="color: white">{{ $tahun_ajaran }}</div>
            </div>
            <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(255,255,255,0.2); color: white; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>
    </div>
</div>

<div class="header" style="margin-top: 3rem; margin-bottom: 1.5rem;">
    <div>
        <h2 style="font-size: 1.25rem; font-weight: 800; color: var(--gray-900); margin: 0;">Daftar Guru Terbaru</h2>
        <p style="font-size: 0.875rem; color: var(--gray-500); margin: 0.25rem 0 0 0;">Guru yang baru ditambahkan ke dalam sistem.</p>
    </div>
    <!-- <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Guru
    </a> -->
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Nama Guru</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Status</th>
                <!-- <th style="text-align: right;">Aksi</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach(\App\Models\User::where('role', 'guru')->limit(5)->get() as $guru)
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 36px; height: 36px; border-radius: 50%; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.875rem;">
                            {{ substr($guru->name, 0, 1) }}
                        </div>
                        <span style="font-weight: 600; color: var(--gray-800);">{{ $guru->name }}</span>
                    </div>
                </td>
                <td>{{ $guru->email }}</td>
                <td>{{ $guru->phone ?? '-' }}</td>
                <td><span class="badge badge-success">Aktif</span></td>
                <td style="text-align: right;">
                    <div style="display: inline-flex; gap: 0.5rem;">
                        <!-- <button class="btn btn-primary" style="padding: 0.35rem 0.65rem; border-radius: 0.5rem; font-size: 0.75rem; box-shadow: none;" title="Edit">
                            <i class="fas fa-edit" style="margin: 0;"></i>
                        </button>
                        <button class="btn btn-danger" style="padding: 0.35rem 0.65rem; border-radius: 0.5rem; font-size: 0.75rem; box-shadow: none;" title="Hapus">
                            <i class="fas fa-trash" style="margin: 0;"></i>
                        </button> -->
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
