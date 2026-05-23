@extends('layouts.dashboard')

@section('title', 'Absensi Siswa')
@section('header', 'Input Absensi Hari Ini')

@section('content')
@if(session('success'))
<div style="background: var(--success); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
    {{ session('success') }}
</div>
@endif

<div class="card-container">
    <h3 style="font-weight: 600; margin-bottom: 1rem; border-bottom: 2px solid var(--gray-light); padding-bottom: 0.5rem;">Daftar Siswa Kelas Anda - {{ \Carbon\Carbon::now()->format('d M Y') }}</h3>
    <form action="{{ route('guru.attendance.store') }}" method="POST">
        @csrf
        <div class="table-container" style="margin-bottom: 1.5rem;">
            <table>
                <thead>
                    <tr>
                        <th>Siswa</th>
                        <th>NIS</th>
                        <th>Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                    @php
                        $attendance = $attendances->firstWhere('student_id', $student->id);
                        $status = $attendance ? $attendance->status : 'hadir';
                    @endphp
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->nis }}</td>
                        <td>
                            <div style="display: flex; gap: 1rem;">
                                <label style="display: flex; align-items: center; gap: 0.25rem;">
                                    <input type="radio" name="attendances[{{ $student->id }}]" value="hadir" {{ $status == 'hadir' ? 'checked' : '' }}> Hadir
                                </label>
                                <label style="display: flex; align-items: center; gap: 0.25rem;">
                                    <input type="radio" name="attendances[{{ $student->id }}]" value="izin" {{ $status == 'izin' ? 'checked' : '' }}> Izin
                                </label>
                                <label style="display: flex; align-items: center; gap: 0.25rem;">
                                    <input type="radio" name="attendances[{{ $student->id }}]" value="sakit" {{ $status == 'sakit' ? 'checked' : '' }}> Sakit
                                </label>
                                <label style="display: flex; align-items: center; gap: 0.25rem;">
                                    <input type="radio" name="attendances[{{ $student->id }}]" value="alpa" {{ $status == 'alpa' ? 'checked' : '' }}> Alpa
                                </label>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align: center; color: var(--gray);">Belum ada siswa di kelas Anda.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($students->count() > 0)
        <button type="submit" class="btn btn-primary">Simpan Absensi</button>
        @endif
    </form>
</div>
@endsection
