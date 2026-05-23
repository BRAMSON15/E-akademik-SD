<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['parent', 'teacher'])->where('teacher_id', Auth::id())->latest()->get();
        return view('guru.students.index', compact('students'));
    }

    public function create()
    {
        return view('guru.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:50|unique:students',
            'nisn' => 'required|string|max:50|unique:students',
            'class' => 'required|string|max:50',
            'address' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['teacher_id'] = Auth::id(); // Assign the current teacher

        Student::create($data);

        return redirect()->route('guru.students.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function edit(Student $student)
    {
        if ($student->teacher_id != Auth::id()) {
            abort(403);
        }
        return view('guru.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        if ($student->teacher_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:50|unique:students,nis,'.$student->id,
            'nisn' => 'required|string|max:50|unique:students,nisn,'.$student->id,
            'class' => 'required|string|max:50',
            'address' => 'nullable|string',
        ]);

        $student->update($request->all());

        return redirect()->route('guru.students.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy(Student $student)
    {
        if ($student->teacher_id != Auth::id()) {
            abort(403);
        }
        $student->delete();
        return redirect()->route('guru.students.index')->with('success', 'Data siswa berhasil dihapus');
    }
}
