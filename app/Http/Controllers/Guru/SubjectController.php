<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('class')->orderBy('name')->get();
        $classes = ['1', '2', '3', '4', '5', '6'];
        return view('guru.subjects.index', compact('subjects', 'classes'));
    }

    public function create()
    {
        $classes = ['1', '2', '3', '4', '5', '6'];
        return view('guru.subjects.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|in:1,2,3,4,5,6',
        ]);

        Subject::create($request->all());

        return redirect()->route('guru.subjects.index')->with('success', 'Mata pelajaran berhasil ditambahkan');
    }

    public function edit(Subject $subject)
    {
        $classes = ['1', '2', '3', '4', '5', '6'];
        return view('guru.subjects.edit', compact('subject', 'classes'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|in:1,2,3,4,5,6',
        ]);

        $subject->update($request->all());

        return redirect()->route('guru.subjects.index')->with('success', 'Mata pelajaran berhasil diperbarui');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('guru.subjects.index')->with('success', 'Mata pelajaran berhasil dihapus');
    }
}
