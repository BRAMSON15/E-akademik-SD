@extends('layouts.dashboard')

@section('title', 'Absensi Siswa')
@section('header', 'Input Absensi Siswa')

@section('content')
@if(session('success'))
<div style="background: var(--success); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
    {{ session('success') }}
</div>
@endif

<div class="card-container" style="margin-bottom: 2rem;">
    <h3 style="font-weight: 600; margin-bottom: 1rem;">Pilih Kelas, Bulan dan Tahun</h3>
    <form id="filterForm" method="GET" action="{{ route('guru.attendance') }}" style="display: flex; gap: 1rem; align-items: flex-end;">
        <div style="flex: 1; max-width: 200px;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Kelas</label>
            <select id="classSelect" name="class" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
                @foreach($classes as $class)
                    <option value="{{ $class }}" {{ $selectedClass == $class ? 'selected' : '' }}>Kelas {{ $class }}</option>
                @endforeach
            </select>
        </div>
        <div style="flex: 1; max-width: 300px;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Bulan dan Tahun</label>
            <input type="month" name="month" value="{{ $month->format('Y-m') }}" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
        </div>
        <button type="submit" class="btn btn-primary">Tampilkan</button>
    </form>
</div>

<script>
    document.getElementById('classSelect').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
</script>

<div class="card-container">
    <h3 style="font-weight: 600; margin-bottom: 1rem; text-align: center;">Rekap Absensi Siswa Kelas {{ $selectedClass }} - {{ $month->format('F Y') }}</h3>
    
    @if($students->count() > 0)
    <form action="{{ route('guru.attendance.store') }}" method="POST">
        @csrf
        <input type="hidden" name="month" value="{{ $month->format('Y-m') }}">
        <input type="hidden" name="class" value="{{ $selectedClass }}">
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 0.9rem;">
                <thead>
                    <tr style="background: #4CAF50; color: white;">
                        <th style="padding: 0.75rem; border: 1px solid #ddd; text-align: left; min-width: 40px;">No</th>
                        <th style="padding: 0.75rem; border: 1px solid #ddd; text-align: left; min-width: 100px;">Nama Siswa</th>
                        <th style="padding: 0.75rem; border: 1px solid #ddd; text-align: left; min-width: 80px;">NIS</th>
                        @for($day = 1; $day <= $daysInMonth; $day++)
                            @php
                                $date = $month->copy()->day($day);
                                $dayName = $date->format('D');
                            @endphp
                            <th style="padding: 0.5rem; border: 1px solid #ddd; text-align: center; min-width: 50px; background: #f0f0f0;">
                                <div style="font-weight: 600;">{{ $day }}</div>
                                <div style="font-size: 0.8rem; color: #666;">{{ $dayName }}</div>
                            </th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $index => $student)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 0.75rem; border: 1px solid #ddd; text-align: center; background: #f9f9f9;">{{ $index + 1 }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #ddd;">{{ $student->name }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #ddd;">{{ $student->nis }}</td>
                        
                        @for($day = 1; $day <= $daysInMonth; $day++)
                            @php
                                $date = $month->copy()->day($day);
                                $attendance = $attendances->where('student_id', $student->id)
                                                          ->where('date', $date->format('Y-m-d'))
                                                          ->first();
                                $status = $attendance ? $attendance->status : '';
                                $statusMap = [
                                    'hadir' => 'H',
                                    'sakit' => 'S',
                                    'izin' => 'I',
                                    'alpa' => 'A'
                                ];
                                $initial = isset($statusMap[$status]) ? $statusMap[$status] : '';
                                $bgColor = '';
                                if ($status === 'hadir') $bgColor = '#90EE90';
                                elseif ($status === 'sakit') $bgColor = '#FFB6C1';
                                elseif ($status === 'izin') $bgColor = '#87CEEB';
                                elseif ($status === 'alpa') $bgColor = '#FFD700';
                            @endphp
                            <td style="padding: 0.5rem; border: 1px solid #ddd; text-align: center; background: {{ $bgColor }}; cursor: pointer; font-weight: 600;" 
                                onclick="cycleStatus(this, '{{ $student->id }}', '{{ $date->format('Y-m-d') }}')">
                                <input type="hidden" name="attendance[{{ $student->id }}][{{ $date->format('Y-m-d') }}]" value="{{ $status }}" class="status-input">
                                <span class="status-display">{{ $initial }}</span>
                            </td>
                        @endfor
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 2rem; display: flex; gap: 1rem; align-items: center;">
            <button type="submit" class="btn btn-primary">Simpan Absensi</button>
            
            <div style="display: flex; gap: 1rem; margin-left: auto;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 30px; height: 30px; background: #90EE90; border: 1px solid #ddd;"></div>
                    <span>Hadir (H)</span>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 30px; height: 30px; background: #FFB6C1; border: 1px solid #ddd;"></div>
                    <span>Sakit (S)</span>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 30px; height: 30px; background: #87CEEB; border: 1px solid #ddd;"></div>
                    <span>Izin (I)</span>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 30px; height: 30px; background: #FFD700; border: 1px solid #ddd;"></div>
                    <span>Alpa (A)</span>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 30px; height: 30px; background: white; border: 1px solid #ddd;"></div>
                    <span>Kosong</span>
                </div>
            </div>
        </div>
    </form>

    <script>
        const statusCycle = ['', 'hadir', 'sakit', 'izin', 'alpa'];
        const statusMap = {
            '': '',
            'hadir': 'H',
            'sakit': 'S',
            'izin': 'I',
            'alpa': 'A'
        };
        const bgColorMap = {
            '': 'white',
            'hadir': '#90EE90',
            'sakit': '#FFB6C1',
            'izin': '#87CEEB',
            'alpa': '#FFD700'
        };

        function cycleStatus(cell, studentId, date) {
            const input = cell.querySelector('.status-input');
            const display = cell.querySelector('.status-display');
            const currentStatus = input.value;
            const currentIndex = statusCycle.indexOf(currentStatus);
            const nextIndex = (currentIndex + 1) % statusCycle.length;
            const nextStatus = statusCycle[nextIndex];

            input.value = nextStatus;
            display.textContent = statusMap[nextStatus];
            cell.style.background = bgColorMap[nextStatus];
        }
    </script>
    @else
    <div style="background: var(--gray-light); padding: 2rem; border-radius: 0.5rem; text-align: center; color: var(--gray-500);">
        <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
        Belum ada siswa di kelas Anda.
    </div>
    @endif
</div>
@endsection
