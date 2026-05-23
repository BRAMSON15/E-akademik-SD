@extends('layouts.dashboard')

@section('title', 'Edit Siswa')
@section('header', 'Edit Data Siswa: ' . $student->name)

@section('content')
<div class="card-container">
    <h3 style="font-weight: 600; margin-bottom: 1rem; border-bottom: 2px solid var(--gray-light); padding-bottom: 0.5rem;">Form Edit Data Siswa</h3>
    
    @if ($errors->any())
    <div style="background: var(--danger); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
        <ul style="margin: 0; padding-left: 1.5rem;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('guru.students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Nama Lengkap Siswa</label>
            <input type="text" name="name" value="{{ old('name', $student->name) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">NIS</label>
                <input type="text" name="nis" value="{{ old('nis', $student->nis) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
            </div>
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">NISN</label>
                <input type="text" name="nisn" value="{{ old('nisn', $student->nisn) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
            </div>
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Kelas</label>
            <input type="text" name="class" value="{{ old('class', $student->class) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;" placeholder="Contoh: 1A, 2B">
        </div>
        
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Alamat</label>
            <textarea name="address" rows="3" style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">{{ old('address', $student->address) }}</textarea>
        </div>

        @if($student->parent_id)
        <div style="background: var(--info-light); border-left: 4px solid var(--info); padding: 1rem; border-radius: 0.25rem; margin-bottom: 1.5rem;">
            <p style="margin: 0; font-size: 0.875rem; color: var(--info-dark);">
                <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                <strong>Orang Tua Terdaftar:</strong> {{ $student->parent->name ?? 'Belum ada' }}
            </p>
        </div>
        @endif

        <button type="submit" class="btn btn-primary">Update Siswa</button>
        <a href="{{ route('guru.students.index') }}" class="btn" style="background: var(--gray-light); color: var(--dark); margin-left: 0.5rem;">Batal</a>
    </form>
</div>
@endsection
