<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\Attendance;

class GuruController extends Controller
{
    public function index()
    {
        return view('guru.dashboard');
    }

    public function grades()
    {
        $students = Auth::user()->students;
        // Only show subjects that have been assigned to a specific class
        // (subjects with null class are old/global seeds that should be ignored)
        $subjects = Subject::whereNotNull('class')
                           ->orderBy('class')
                           ->orderBy('name')
                           ->get();

        $grades = Grade::where('teacher_id', Auth::id())->latest()->get();
        $tahun_ajaran = \App\Models\Setting::where('key', 'tahun_ajaran')->first()->value ?? '2023/2024';
        return view('guru.grades', compact('students', 'subjects', 'grades', 'tahun_ajaran'));
    }

    public function storeGrade(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'score' => 'required|numeric|min:0|max:100',
            'type' => 'required|in:ulangan,uas,pr',
            'semester' => 'required|numeric',
            'academic_year' => 'required|string',
        ]);

        Grade::create([
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => Auth::id(),
            'score' => $request->score,
            'type' => $request->type,
            'semester' => $request->semester,
            'academic_year' => $request->academic_year,
        ]);

        return redirect()->route('guru.grades')->with('success', 'Nilai berhasil disimpan');
    }

    public function attendance()
    {
        $students = Auth::user()->students;
        $attendances = Attendance::whereIn('student_id', $students->pluck('id'))
            ->whereDate('date', today())
            ->get();
        return view('guru.attendance', compact('students', 'attendances'));
    }

    public function storeAttendance(Request $request)
    {
        $request->validate([
            'attendances' => 'required|array',
            'attendances.*' => 'in:hadir,izin,sakit,alpa',
        ]);

        $date = today();

        foreach ($request->attendances as $student_id => $status) {
            Attendance::updateOrCreate(
                ['student_id' => $student_id, 'date' => $date],
                ['status' => $status]
            );
        }

        return redirect()->route('guru.attendance')->with('success', 'Absensi berhasil disimpan');
    }
}
