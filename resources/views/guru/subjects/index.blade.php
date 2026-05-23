@extends('layouts.dashboard')

@section('title', 'Kelola Mata Pelajaran')
@section('header', 'Kelola Mata Pelajaran')

@section('content')
<div class="card-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 style="font-weight: 600; margin: 0;">Daftar Mata Pelajaran</h3>
        <a href="{{ route('guru.subjects.create') }}" class="btn btn-primary">
            <i class="fas fa-plus" style="margin-right: 0.5rem;"></i> Tambah Mata Pelajaran
        </a>
    </div>

    @if(session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; border-left: 4px solid #10b981;">
            <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i> {{ session('success') }}
        </div>
    @endif

    @forelse($classes as $class)
        <div style="margin-bottom: 2rem;">
            <h4 style="font-weight: 600; color: var(--primary); margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid var(--primary-light);">
                <i class="fas fa-book" style="margin-right: 0.5rem;"></i> Kelas {{ $class }}
            </h4>
            
            @php
                $classSubjects = $subjects->where('class', $class);
            @endphp

            @if($classSubjects->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: var(--gray-light);">
                                <th style="padding: 1rem; text-align: left; font-weight: 600; border-bottom: 2px solid var(--gray-200);">No</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; border-bottom: 2px solid var(--gray-200);">Nama Mata Pelajaran</th>
                                <th style="padding: 1rem; text-align: center; font-weight: 600; border-bottom: 2px solid var(--gray-200);">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classSubjects as $subject)
                                <tr style="border-bottom: 1px solid var(--gray-200); hover: background: var(--gray-light);">
                                    <td style="padding: 1rem;">{{ $loop->iteration }}</td>
                                    <td style="padding: 1rem;">{{ $subject->name }}</td>
                                    <td style="padding: 1rem; text-align: center;">
                                        <a href="{{ route('guru.subjects.edit', $subject->id) }}" class="btn btn-sm" style="background: var(--info); color: white; padding: 0.5rem 1rem; border-radius: 0.25rem; text-decoration: none; font-size: 0.875rem; margin-right: 0.5rem;">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('guru.subjects.destroy', $subject->id) }}" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm" style="background: var(--danger); color: white; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; cursor: pointer; font-size: 0.875rem;">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="background: var(--gray-light); padding: 2rem; border-radius: 0.5rem; text-align: center; color: var(--gray-500);">
                    <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                    Belum ada mata pelajaran untuk kelas {{ $class }}
                </div>
            @endif
        </div>
    @empty
        <div style="background: var(--gray-light); padding: 2rem; border-radius: 0.5rem; text-align: center; color: var(--gray-500);">
            <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
            Belum ada mata pelajaran
        </div>
    @endforelse
</div>
@endsection
