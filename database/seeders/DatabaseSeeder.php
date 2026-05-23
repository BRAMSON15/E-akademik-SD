<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Teachers (Guru)
        $guru1 = User::create([
            'name' => 'Budi Santoso, S.Pd',
            'username' => 'budi',
            'email' => 'budi@guru.com',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        $guru2 = User::create([
            'name' => 'Siti Aminah, S.Pd',
            'username' => 'siti',
            'email' => 'siti@guru.com',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        // Parents (Orang Tua)
        $ortu1 = User::create([
            'name' => 'Sugeng',
            'username' => 'sugeng',
            'email' => 'sugeng@ortu.com',
            'password' => bcrypt('password'),
            'role' => 'orang_tua',
        ]);

        // Subjects
        $subjects = ['Matematika', 'Bahasa Indonesia', 'IPA', 'IPS', 'Pendidikan Agama', 'PJOK', 'Seni Budaya'];
        foreach ($subjects as $subject) {
            \App\Models\Subject::create(['name' => $subject]);
        }

        // Students
        \App\Models\Student::create([
            'name' => 'Ani Wijaya',
            'nis' => '12345',
            'nisn' => '0098765432',
            'class' => '1A',
            'parent_id' => $ortu1->id,
            'teacher_id' => $guru1->id,
        ]);
    }
}
