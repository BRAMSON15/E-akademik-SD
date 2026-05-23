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
        return view('guru.grades', compact('students', 'subjects', 'grades'));
    }

    public function storeGrade(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'score' => 'required|numeric|min:0|max:100',
            'type' => 'required|in:ulangan,uas,pr',
            'semester' => 'required|numeric',
        ]);

        // Generate academic year automatically based on current year
        $currentYear = now()->year;
        $nextYear = $currentYear + 1;
        $academic_year = "{$currentYear}/{$nextYear}";

        Grade::create([
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => Auth::id(),
            'score' => $request->score,
            'type' => $request->type,
            'semester' => $request->semester,
            'academic_year' => $academic_year,
        ]);

        return redirect()->route('guru.grades')->with('success', 'Nilai berhasil disimpan');
    }

    public function attendance(Request $request)
    {
        $allStudents = Auth::user()->students;
        
        // Get classes ONLY from students taught by this teacher
        $classes = $allStudents->pluck('class')
                               ->filter() // Remove null values
                               ->unique()
                               ->sort()
                               ->values();
        
        $selectedClass = $request->query('class') ?? $classes->first();
        
        // Filter students by selected class - use strict comparison
        $students = $allStudents->where('class', $selectedClass)->values();
        
        $month = $request->query('month') ? \Carbon\Carbon::createFromFormat('Y-m', $request->query('month')) : today();
        $daysInMonth = $month->daysInMonth;
        
        // Get all attendances for this month for the filtered students
        $attendances = Attendance::whereIn('student_id', $students->pluck('id'))
            ->whereBetween('date', [
                $month->copy()->startOfMonth(),
                $month->copy()->endOfMonth()
            ])
            ->get();
        
        return view('guru.attendance', compact('students', 'attendances', 'month', 'daysInMonth', 'classes', 'selectedClass'));
    }

    public function storeAttendance(Request $request)
    {
        $request->validate([
            'attendance' => 'required|array',
            'month' => 'required|date_format:Y-m',
        ]);

        $month = \Carbon\Carbon::createFromFormat('Y-m', $request->month);

        // Process attendance data
        foreach ($request->attendance as $student_id => $dates) {
            foreach ($dates as $date => $status) {
                if ($status) { // Only save if status is not empty
                    Attendance::updateOrCreate(
                        ['student_id' => $student_id, 'date' => $date],
                        ['status' => $status]
                    );
                } else {
                    // Delete if status is empty
                    Attendance::where('student_id', $student_id)
                        ->where('date', $date)
                        ->delete();
                }
            }
        }

        return redirect()->route('guru.attendance', ['month' => $month->format('Y-m')])->with('success', 'Absensi berhasil disimpan');
    }
}
