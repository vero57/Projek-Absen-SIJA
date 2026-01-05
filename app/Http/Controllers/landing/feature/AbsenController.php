<?php

namespace App\Http\Controllers\landing\feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\AttendanceStatus;
use App\Models\AttendanceSchedule;

class AbsenController extends Controller
{
    public function index()
    {
        return view('landing.feature.absen.index');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        // Ambil class_id user (menggunakan relasi belongsToMany 'classes')
        $classId = $user->classes()->first()->id ?? null;
        if (!$classId) {
            return response()->json(['success' => false, 'message' => 'Class ID tidak ditemukan'], 422);
        }

        // Ambil jadwal absen kelas
        $schedule = AttendanceSchedule::where('class_id', $classId)->first();
        if (!$schedule) {
            return response()->json(['success' => false, 'message' => 'Jadwal absen kelas tidak ditemukan'], 422);
        }

        // Ambil waktu sekarang dalam zona Asia/Jakarta (WIB)
        $nowWIB = now('Asia/Jakarta');
        $today = $nowWIB->toDateString();

        // Cek apakah sudah absen hari ini
        $sudahAbsen = Attendance::where('student_id', $user->id)
            ->where('date', $today)
            ->first();
        if ($sudahAbsen) {
            return response()->json(['success' => false, 'message' => 'Sudah absen hari ini']);
        }

        // Validasi label wajah (jika dikirim dari frontend)
        if ($request->has('face_label') && strtolower($request->face_label) !== strtolower($user->name)) {
            return response()->json(['success' => false, 'message' => 'Wajah tidak dikenali sebagai user. Absen ditolak.'], 403);
        }

        // Cek waktu absen
        $startTimeIn = $schedule->start_time_in; // format: 'H:i:s'
        $endTimeIn = $schedule->end_time_in;     // format: 'H:i:s'
        $nowTime = $nowWIB->format('H:i:s');

        if ($nowTime < $startTimeIn) {
            return response()->json(['success' => false, 'message' => 'Belum waktunya absen. Silakan absen mulai pukul ' . $startTimeIn . ' WIB.']);
        }

        // Status default Hadir
        $statusName = 'Hadir';
        if ($nowTime > $endTimeIn) {
            $statusName = 'Telat';
        }
        $status = \App\Models\AttendanceStatus::where('name', $statusName)->first();
        if (!$status) {
            return response()->json(['success' => false, 'message' => 'Status ' . $statusName . ' tidak ditemukan'], 422);
        }

        $photoPath = null;
        if ($request->photo) {
            // Proses base64 ke file
            $base64 = $request->photo;
            if (preg_match('/^data:image\/(\w+);base64,/', $base64, $type)) {
                $base64 = substr($base64, strpos($base64, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, etc
                $base64 = base64_decode($base64);
                $filename = 'attendance_' . $user->id . '_' . time() . '.' . $type;
                $path = 'attendance_photos/' . $filename;
                \Storage::disk('public')->put($path, $base64);
                $photoPath = 'storage/' . $path;
            }
        }

        $absen = Attendance::create([
            'student_id' => $user->id,
            'class_id' => $classId,
            'date' => $today,
            'time_in' => $nowWIB->format('H:i:s'),
            'status_id' => $status->id,
            'location_lat' => $request->lat,
            'location_lng' => $request->lng,
            'photo' => $photoPath
        ]);

        return response()->json(['success' => true]);
    }
}
