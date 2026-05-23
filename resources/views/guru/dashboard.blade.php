@extends('layouts.dashboard')

@section('title', 'Guru Dashboard')
@section('header', 'Panel Guru')

@section('content')
<div class="stats-grid">
    <div class="stat-card" style="border-left: 4px solid var(--primary);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div class="label">Siswa Anda</div>
                <div class="value">{{ Auth::user()->students()->count() }}</div>
            </div>
            <div style="width: 48px; height: 48px; border-radius: 12px; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fas fa-users-class"></i>
            </div>
        </div>
    </div>
    
    <div class="stat-card" style="border-left: 4px solid var(--secondary);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div class="label">Mata Pelajaran</div>
                <div class="value">{{ \App\Models\Subject::count() }}</div>
            </div>
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #d1fae5; color: var(--secondary); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fas fa-book-open"></i>
            </div>
        </div>
    </div>
    
    <div class="stat-card" style="border-left: 4px solid var(--warning);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div class="label">Input Nilai Hari Ini</div>
                <div class="value">12</div>
            </div>
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #fef3c7; color: var(--warning); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fas fa-pencil-alt"></i>
            </div>
        </div>
    </div>
    
    <div class="stat-card" style="border-left: 4px solid #6366f1;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div class="label">Pengumuman Aktif</div>
                <div class="value">3</div>
            </div>
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #e0e7ff; color: #4f46e5; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fas fa-bullhorn"></i>
            </div>
        </div>
    </div>
</div>

<div class="header" style="margin-top: 3rem; margin-bottom: 1.5rem;">
    <div>
        <h2 style="font-size: 1.25rem; font-weight: 800; color: var(--gray-900); margin: 0;">Data Siswa Kelas Anda</h2>
        <p style="font-size: 0.875rem; color: var(--gray-500); margin: 0.25rem 0 0 0;">Daftar siswa yang berada dalam bimbingan Anda.</p>
    </div>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>NIS/NISN</th>
                <th>Kelas</th>
                <th style="text-align: right;">Aksi Cepat</th>
            </tr>
        </thead>
        <tbody>
            @foreach(Auth::user()->students as $student)
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 36px; height: 36px; border-radius: 50%; background: #fef3c7; color: #b45309; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.875rem;">
                            {{ substr($student->name, 0, 1) }}
                        </div>
                        <span style="font-weight: 600; color: var(--gray-800);">{{ $student->name }}</span>
                    </div>
                </td>
                <td style="font-family: monospace; color: var(--gray-600);">{{ $student->nis }} / {{ $student->nisn }}</td>
                <td><span class="badge badge-primary">{{ $student->class }}</span></td>
                <td style="text-align: right;">
                    <div style="display: inline-flex; gap: 0.5rem;">
                        <a href="#" class="btn btn-primary" style="padding: 0.35rem 0.75rem; border-radius: 0.5rem; font-size: 0.75rem;">
                            <i class="fas fa-file-invoice" style="margin-right: 0.25rem;"></i> Nilai
                        </a>
                        <a href="#" class="btn btn-primary" style="background-color: var(--secondary); padding: 0.35rem 0.75rem; border-radius: 0.5rem; font-size: 0.75rem;">
                            <i class="fas fa-calendar-alt" style="margin-right: 0.25rem;"></i> Absensi
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
