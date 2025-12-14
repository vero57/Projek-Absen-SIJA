<?php

namespace App\Http\Controllers\dashboard\dash_feature;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        // Ambil user dengan role siswa beserta kelasnya
        $students = User::with('classes')
            ->whereHas('role', function ($q) {
                $q->where('name', 'Siswa');
            })
            ->get();

        return view('dashboard.page.absensi_page.index', compact('students'));
    }

    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('dashboard.page.absensi_page.show', compact('user'));
    }
}
