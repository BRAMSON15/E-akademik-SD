@extends('layouts.dashboard')

@section('title', 'Edit Mata Pelajaran')
@section('header', 'Edit Mata Pelajaran: ' . $subject->name)

@section('content')
<div class="card-container">
    <h3 style="font-weight: 600; margin-bottom: 1rem; border-bottom: 2px solid var(--gray-light); padding-bottom: 0.5rem;">Form Edit Mata Pelajaran</h3>
    
    @if ($errors->any())
    <div style="background: var(--danger); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
        <ul style="margin: 0; padding-left: 1.5rem;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('guru.subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Nama Mata Pelajaran</label>
            <input type="text" name="name" value="{{ old('name', $subject->name) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Kelas</label>
            <select name="class" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
                <option value="">-- Pilih Kelas --</option>
                @foreach($classes as $class)
                    <option value="{{ $class }}" {{ old('class', $subject->class) == $class ? 'selected' : '' }}>Kelas {{ $class }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Mata Pelajaran</button>
        <a href="{{ route('guru.subjects.index') }}" class="btn" style="background: var(--gray-light); color: var(--dark); margin-left: 0.5rem;">Batal</a>
    </form>
</div>
@endsection
