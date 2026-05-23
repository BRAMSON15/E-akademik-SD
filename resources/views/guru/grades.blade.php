@extends('layouts.dashboard')

@section('title', 'Input Nilai')
@section('header', 'Input Nilai Siswa')

@section('content')
@if(session('success'))
<div style="background: var(--success); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
    {{ session('success') }}
</div>
@endif

<div class="card-container" style="margin-bottom: 2rem;">
    <h3 style="font-weight: 600; margin-bottom: 1rem; border-bottom: 2px solid var(--gray-light); padding-bottom: 0.5rem;">Form Input Nilai</h3>
    <form action="{{ route('guru.grades.store') }}" method="POST">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Siswa</label>
                <select id="student_select" name="student_id" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
                    <option value="">Pilih Siswa</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" data-class="{{ $student->class }}">{{ $student->name }} ({{ $student->nis }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Mata Pelajaran</label>
                <select id="subject_select" name="subject_id" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
                    <option value="">Pilih Mata Pelajaran</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" data-class="{{ $subject->class }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <script>
            const studentSelect = document.getElementById('student_select');
            const subjectSelect = document.getElementById('subject_select');
            // Cache all options from the original rendered select
            const allSubjectOptions = Array.from(subjectSelect.options);

            // Hide all subject options initially (before a student is picked)
            while (subjectSelect.options.length > 1) {
                subjectSelect.remove(1);
            }

            studentSelect.addEventListener('change', function() {
                const selectedClass = this.options[this.selectedIndex].dataset.class;
                // Extract numeric grade level: "3A" -> "3", "1B" -> "1"
                const numericMatch = selectedClass ? selectedClass.match(/^\d+/) : null;
                const gradeLevel = numericMatch ? numericMatch[0] : null;

                // Clear current subject options (keep first "Pilih" placeholder)
                while (subjectSelect.options.length > 1) {
                    subjectSelect.remove(1);
                }
                subjectSelect.selectedIndex = 0;

                if (gradeLevel) {
                    // Only add subjects whose class STRICTLY matches the grade level number
                    // (e.g. subject.class === "1" for a student in class "1A")
                    // Subjects with null class (old global seeds) are intentionally excluded
                    allSubjectOptions.forEach(option => {
                        if (option.value && option.dataset.class === gradeLevel) {
                            subjectSelect.appendChild(option.cloneNode(true));
                        }
                    });
                }
            });
        </script>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Jenis Nilai</label>
                <select name="type" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
                    <option value="ulangan">Ulangan</option>
                    <option value="uas">Ujian Akhir Semester</option>
                    <option value="pr">Pekerjaan Rumah (PR)</option>
                </select>
            </div>
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Nilai (0-100)</label>
                <input type="number" name="score" min="0" max="100" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
            </div>
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Semester</label>
                <select name="semester" required style="width: 100%; padding: 0.5rem; border: 1px solid var(--gray-light); border-radius: 0.25rem;">
                    <option value="1">1 (Ganjil)</option>
                    <option value="2">2 (Genap)</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
    </form>
</div>

<div class="card-container">
    <h3 style="font-weight: 600; margin-bottom: 1rem; border-bottom: 2px solid var(--gray-light); padding-bottom: 0.5rem;">Riwayat Nilai</h3>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Siswa</th>
                    <th>Mata Pelajaran</th>
                    <th>Jenis Nilai</th>
                    <th>Nilai</th>
                    <th>Semester</th>
                    <th>Tahun Ajaran</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grades as $grade)
                <tr>
                    <td>{{ $grade->student->name }}</td>
                    <td>{{ $grade->subject->name }}</td>
                    <td style="text-transform: capitalize;">{{ $grade->type == 'uas' ? 'Ujian Akhir Semester' : ($grade->type == 'pr' ? 'PR' : 'Ulangan') }}</td>
                    <td style="font-weight: bold; color: {{ $grade->score >= 75 ? 'var(--success)' : 'var(--danger)' }}">{{ $grade->score }}</td>
                    <td>{{ $grade->semester }}</td>
                    <td>{{ $grade->academic_year }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: var(--gray);">Belum ada riwayat nilai.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
