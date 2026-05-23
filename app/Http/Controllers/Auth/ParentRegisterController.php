<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ParentRegisterController extends Controller
{
    /**
     * Display the parent registration view.
     */
    public function create(): View
    {
        return view('auth.parent-register');
    }

    /**
     * Handle an incoming parent registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'student_name' => ['required', 'string', 'max:255'],
            'nis' => ['required', 'string', 'max:50'],
        ]);

        // Check if student exists with the given name and NIS
        $student = Student::where('name', $request->student_name)
                          ->where('nis', $request->nis)
                          ->first();

        if (!$student) {
            throw ValidationException::withMessages([
                'student_name' => 'Data siswa dengan nama dan NIS tersebut tidak ditemukan.',
            ]);
        }

        // Check if student already has a parent
        if ($student->parent_id) {
            throw ValidationException::withMessages([
                'student_name' => 'Siswa ini sudah terdaftar dengan orang tua lain.',
            ]);
        }

        // Create parent user with auto-generated credentials
        $parentName = 'Orang Tua ' . $student->name;
        $username = 'ortu_' . strtolower(str_replace(' ', '_', $student->name)) . '_' . $student->nis;
        $password = 'Sekolah123!'; // Default password
        $email = 'ortu_' . $student->nis . '@sekolah.local';

        $user = User::create([
            'name' => $parentName,
            'username' => $username,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'orang_tua',
        ]);

        // Link student to parent
        $student->update(['parent_id' => $user->id]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('parent.dashboard', absolute: false));
    }
}
