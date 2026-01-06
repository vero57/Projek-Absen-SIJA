<?php

namespace App\Http\Controllers\dashboard\dash_feature;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        // Ambil semua data presensi beserta relasi user, kelas, dan status
        $attendances = Attendance::with(['student', 'status'])
            ->orderByDesc('date')
            ->orderByDesc('time_in')
            ->get();

        return view('dashboard.page.absensi_page.index', compact('attendances'));
    }

    public function show($attendance_id)
    {
        $attendance = Attendance::with(['student', 'status'])->findOrFail($attendance_id);
        return view('dashboard.page.absensi_page.show', compact('attendance'));
    }
}
