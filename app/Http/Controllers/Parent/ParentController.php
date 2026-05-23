<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Grade;
use App\Models\Announcement;

class ParentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $studentIds = $user->students->pluck('id');
        $grades = Grade::whereIn('student_id', $studentIds)->with('subject', 'student')->latest()->get()->groupBy('type');
        $announcements = Announcement::latest()->get();
        
        return view('parent.dashboard', compact('grades', 'announcements'));
    }

    public function attendance()
    {
        $user = Auth::user();
        $studentIds = $user->students->pluck('id');
        $attendances = \App\Models\Attendance::whereIn('student_id', $studentIds)->with('student')->latest('date')->get();
        
        return view('parent.attendance', compact('attendances'));
    }
}
