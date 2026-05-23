@extends('layouts.dashboard')

@section('title', 'Parent Dashboard')
@section('header', 'Pantauan Akademik Anak')

@section('content')
<div class="stats-grid">
    @foreach(Auth::user()->students as $student)
    <div class="stat-card" style="border-left: 4px solid var(--warning);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div class="label" style="color: var(--warning);">Profil Anak</div>
                <div class="value" style="font-size: 1.5rem;">{{ $student->name }}</div>
                <div style="margin-top: 0.5rem; display: inline-flex; gap: 0.5rem;">
                    <span class="badge badge-warning">Kelas {{ $student->class }}</span>
                    <span style="font-size: 0.75rem; color: var(--gray-500); padding: 0.25rem 0; font-family: monospace;">NIS: {{ $student->nis }}</span>
                </div>
            </div>
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #fef3c7; color: var(--warning); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fas fa-child"></i>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
    <!-- Left Column: Grades -->
    <div class="glass-card" style="padding: 2rem;">
        <div class="header" style="margin-bottom: 1.5rem;">
            <h2 style="font-size: 1.25rem; font-weight: 800; color: var(--gray-900); margin: 0;">
                <i class="fas fa-chart-line text-primary" style="margin-right: 0.5rem; color: var(--primary);"></i> Daftar Nilai Akademik
            </h2>
        </div>
        
        @php
            $gradeTypes = [
                'ulangan' => 'Nilai Ulangan',
                'uas' => 'Ujian Akhir Semester',
                'pr' => 'Nilai Pekerjaan Rumah (PR)'
            ];
        @endphp

        @foreach($gradeTypes as $typeKey => $typeLabel)
        <div style="margin-bottom: 2rem;">
            <h3 style="font-size: 0.95rem; font-weight: 700; margin-bottom: 1rem; color: var(--gray-700); border-bottom: 2px solid var(--gray-100); padding-bottom: 0.5rem;">
                {{ $typeLabel }}
            </h3>
            <div class="table-container" style="box-shadow: none; border: 1px solid var(--gray-200);">
                <table>
                    <thead>
                        <tr style="background-color: var(--gray-50);">
                            <th>Mata Pelajaran</th>
                            <th>Siswa</th>
                            <th>Nilai</th>
                            <th>Semester</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($grades[$typeKey]) && $grades[$typeKey]->count() > 0)
                            @foreach($grades[$typeKey] as $grade)
                            <tr>
                                <td style="font-weight: 600; color: var(--gray-800);">{{ $grade->subject->name }}</td>
                                <td>{{ $grade->student->name }}</td>
                                <td>
                                    @if($grade->score >= 75)
                                        <span class="badge badge-success" style="font-size: 0.85rem;">{{ $grade->score }}</span>
                                    @else
                                        <span class="badge badge-danger" style="font-size: 0.85rem;">{{ $grade->score }}</span>
                                    @endif
                                </td>
                                <td><span style="font-size: 0.85rem; color: var(--gray-500);">Smt {{ $grade->semester }} ({{ $grade->academic_year }})</span></td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" style="text-align: center; color: var(--gray-500); padding: 1.5rem;">
                                    <div style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem;">
                                        <i class="fas fa-inbox" style="font-size: 1.5rem; color: var(--gray-300);"></i>
                                        <span>Belum ada {{ strtolower($typeLabel) }} yang diinput.</span>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Right Column: Announcements -->
    <div class="glass-card" style="padding: 2rem;">
        <div class="header" style="margin-bottom: 1.5rem;">
            <h2 style="font-size: 1.25rem; font-weight: 800; color: var(--gray-900); margin: 0;">
                <i class="fas fa-bullhorn" style="margin-right: 0.5rem; color: var(--accent);"></i> Pengumuman Sekolah
            </h2>
        </div>
        
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @forelse($announcements as $index => $announcement)
            <div style="background: white; border: 1px solid var(--gray-200); border-radius: 1rem; padding: 1.25rem; position: relative; overflow: hidden; transition: transform 0.2s ease; box-shadow: var(--shadow-sm);">
                <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: {{ $index % 2 == 0 ? 'var(--primary)' : 'var(--accent)' }};"></div>
                <h3 style="font-size: 1rem; font-weight: 700; color: var(--gray-900); margin: 0 0 0.5rem 0;">{{ $announcement->title }}</h3>
                <p style="font-size: 0.875rem; color: var(--gray-600); line-height: 1.5; margin: 0 0 1rem 0;">{{ $announcement->content }}</p>
                <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.75rem; color: var(--gray-500);">
                    <i class="far fa-calendar-alt"></i>
                    <span>{{ \Carbon\Carbon::parse($announcement->date)->format('d M Y') }}</span>
                </div>
            </div>
            @empty
            <div style="text-align: center; color: var(--gray-500); padding: 3rem 1rem; border: 1px dashed var(--gray-300); border-radius: 1rem;">
                <i class="fas fa-bell-slash" style="font-size: 2rem; color: var(--gray-300); margin-bottom: 1rem; display: block;"></i>
                Tidak ada pengumuman terbaru saat ini.
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
