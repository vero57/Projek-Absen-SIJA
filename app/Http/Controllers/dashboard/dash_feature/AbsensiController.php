<?php

namespace App\Http\Controllers\dashboard\dash_feature;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

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

    public function exportPdf()
    {
        $attendances = Attendance::with(['student', 'status'])
            ->orderByDesc('date')
            ->orderByDesc('time_in')
            ->get();

        $dompdf = new Dompdf();
        $html = view('dashboard.page.absensi_page.pdf', compact('attendances'))->render();
        $dompdf->loadHtml($html);
        $dompdf->render();

        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="daftar_absensi_siswa.pdf"'
        ]);
    }
}
