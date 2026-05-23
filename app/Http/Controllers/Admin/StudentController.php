<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['parent', 'teacher'])->latest()->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $parents = User::where('role', 'orang_tua')->get();
        $teachers = User::where('role', 'guru')->get();
        return view('admin.students.create', compact('parents', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:50|unique:students',
            'nisn' => 'required|string|max:50|unique:students',
            'class' => 'required|string|max:50',
            'address' => 'nullable|string',
            'parent_id' => 'required|exists:users,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        Student::create($request->all());

        return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function edit(Student $student)
    {
        $parents = User::where('role', 'orang_tua')->get();
        $teachers = User::where('role', 'guru')->get();
        return view('admin.students.edit', compact('student', 'parents', 'teachers'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:50|unique:students,nis,'.$student->id,
            'nisn' => 'required|string|max:50|unique:students,nisn,'.$student->id,
            'class' => 'required|string|max:50',
            'address' => 'nullable|string',
            'parent_id' => 'required|exists:users,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $student->update($request->all());

        return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil dihapus');
    }
}
