@extends('layouts.dashboard')

@section('title', 'Rekap Kehadiran')
@section('header', 'Riwayat Kehadiran Siswa')

@section('content')
<div class="card-container">
    <h3 style="font-weight: 600; margin-bottom: 1rem; border-bottom: 2px solid var(--gray-light); padding-bottom: 0.5rem;">Data Kehadiran</h3>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Siswa</th>
                    <th>Status Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $attendance)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($attendance->date)->translatedFormat('l, d F Y') }}</td>
                    <td style="font-weight: 600;">{{ $attendance->student->name }}</td>
                    <td>
                        @if($attendance->status == 'hadir')
                            <span class="badge badge-success">Hadir</span>
                        @elseif($attendance->status == 'izin')
                            <span class="badge badge-warning" style="background-color: #f59e0b; color: white;">Izin</span>
                        @elseif($attendance->status == 'sakit')
                            <span class="badge badge-warning" style="background-color: #3b82f6; color: white;">Sakit</span>
                        @else
                            <span class="badge badge-danger">Alpa</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center; color: var(--gray);">Belum ada riwayat kehadiran yang dicatat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
