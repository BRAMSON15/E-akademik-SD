@extends('layouts.dashboard')

@section('title', 'Data Siswa')
@section('header', 'Manajemen Data Siswa')

@section('content')
@if(session('success'))
<div style="background: var(--success); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
    {{ session('success') }}
</div>
@endif

<div class="header" style="margin-bottom: 1rem;">
    <h2 style="font-size: 1.25rem; font-weight: 700;">Daftar Siswa</h2>
    <a href="{{ route('guru.students.create') }}" class="btn btn-primary">Tambah Siswa Baru</a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>NIS / NISN</th>
                <th>Kelas</th>
                <th>Wali Kelas</th>
                <th>Orang Tua</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td style="font-weight: 600;">{{ $student->name }}</td>
                <td>{{ $student->nis }} / {{ $student->nisn }}</td>
                <td>{{ $student->class }}</td>
                <td>{{ $student->teacher->name ?? '-' }}</td>
                <td>{{ $student->parent->name ?? '-' }}</td>
                <td>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('guru.students.edit', $student->id) }}" class="btn btn-primary" style="padding: 0.25rem 0.5rem;"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('guru.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus siswa ini?');" style="display:inline;">
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
