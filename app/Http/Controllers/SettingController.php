<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $tahun_ajaran = Setting::where('key', 'tahun_ajaran')->first()->value ?? '';
        return view('admin.settings.index', compact('tahun_ajaran'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string|max:50',
        ]);

        Setting::updateOrCreate(
            ['key' => 'tahun_ajaran'],
            ['value' => $request->tahun_ajaran]
        );

        return back()->with('success', 'Pengaturan berhasil diperbarui');
    }
}
