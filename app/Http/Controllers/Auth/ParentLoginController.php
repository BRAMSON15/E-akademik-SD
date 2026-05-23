<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ParentLoginController extends Controller
{
    /**
     * Handle an incoming parent login request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'student_name' => ['required', 'string'],
            'nis' => ['required', 'string'],
        ]);

        // Debug: Log the input
        \Log::info('Parent Login Attempt', [
            'student_name' => $request->student_name,
            'nis' => $request->nis,
        ]);

        // Find student by name and NIS
        $student = Student::where('name', $request->student_name)
                          ->where('nis', $request->nis)
                          ->first();

        // Debug: Log the search result
        \Log::info('Student Search Result', [
            'found' => $student ? 'yes' : 'no',
            'student' => $student ? $student->toArray() : null,
        ]);

        if (!$student) {
            // Show all students for debugging
            $allStudents = Student::all(['id', 'name', 'nis', 'parent_id'])->toArray();
            \Log::info('All Students in Database', $allStudents);
            
            throw ValidationException::withMessages([
                'student_name' => 'Data siswa tidak ditemukan. Pastikan nama dan NIS sesuai dengan yang terdaftar.',
            ]);
        }

        if (!$student->parent_id) {
            // Auto-register the parent if they don't exist yet
            $parentName = 'Orang Tua ' . $student->name;
            $username = 'ortu_' . strtolower(str_replace(' ', '_', $student->name)) . '_' . $student->nis;
            $password = 'Sekolah123!'; // Default password
            $email = 'ortu_' . $student->nis . '@sekolah.local';

            $user = \App\Models\User::create([
                'name' => $parentName,
                'username' => $username,
                'email' => $email,
                'password' => \Illuminate\Support\Facades\Hash::make($password),
                'role' => 'orang_tua',
            ]);

            // Link student to parent
            $student->update(['parent_id' => $user->id]);
            
            \Illuminate\Support\Facades\Auth::login($user);
        } else {
            // Login as existing parent
            \Illuminate\Support\Facades\Auth::login($student->parent);
        }
        
        $request->session()->regenerate();

        return redirect()->intended(route('parent.dashboard', absolute: false));
    }
}
