<?php

namespace App\Http\Controllers\dashboard\dash_feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = ClassModel::with('walas')->paginate(10);
        return view('dashboard.page.kelas_page.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $class = ClassModel::with(['walas', 'students', 'attendanceSchedule'])->findOrFail($id);
        $teachers = \App\Models\User::whereHas('role', function ($q) {
            $q->where('name', 'Guru');
        })->get();

        // Ambil siswa yang belum masuk kelas manapun
        $availableStudents = \App\Models\User::whereHas('role', function ($q) {
            $q->where('name', 'Siswa');
        })
            ->whereDoesntHave('classes')
            ->get();

        return view('dashboard.page.kelas_page.show', compact('class', 'teachers', 'availableStudents'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Update wali kelas.
     */
    public function updateWalas(Request $request, $id)
    {
        $request->validate([
            'walas_id' => 'required|exists:users,id'
        ]);
        $class = ClassModel::findOrFail($id);
        $class->walas_id = $request->walas_id;
        $class->save();
        return redirect()->route('dashboard.kelas.show', $id)->with('success_walas', 'Wali Kelas berhasil diubah.');
    }

    /**
     * Tambah siswa ke kelas.
     */
    public function addStudents(Request $request, $id)
    {
        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:users,id'
        ]);
        $class = ClassModel::findOrFail($id);
        $studentIds = \App\Models\User::whereIn('id', $request->student_ids)
            ->whereHas('role', function ($q) {
                $q->where('name', 'Siswa');
            })
            ->whereDoesntHave('classes')
            ->pluck('id')
            ->toArray();

        $class->students()->attach($studentIds);

        return redirect()->route('dashboard.kelas.show', $id)->with('success_siswa', 'Siswa berhasil ditambahkan ke kelas.');
    }

    /**
     * Keluarkan siswa dari kelas.
     */
    public function removeStudents(Request $request, $id)
    {
        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:users,id'
        ]);
        $class = ClassModel::findOrFail($id);
        $class->students()->detach($request->student_ids);

        return redirect()->route('dashboard.kelas.show', $id)->with('success_siswa', 'Siswa berhasil dikeluarkan dari kelas.');
    }

    /**
     * Update jadwal kelas.
     */
    public function updateSchedule(Request $request, $id)
    {
        $request->validate([
            'schedule_type' => 'required|in:pagi,siang'
        ]);
        $class = ClassModel::findOrFail($id);

        if ($request->schedule_type == 'pagi') {
            $data = [
                'start_time_in' => '05:00:00',
                'end_time_in' => '07:00:00',
                'start_time_out' => '15:00:00',
                'end_time_out' => '18:00:00',
            ];
        } else {
            $data = [
                'start_time_in' => '09:00:00',
                'end_time_in' => '11:00:00',
                'start_time_out' => '15:00:00',
                'end_time_out' => '18:00:00',
            ];
        }

        $schedule = $class->attendanceSchedule;
        if ($schedule) {
            $schedule->update($data);
        } else {
            $class->attendanceSchedule()->create($data);
        }

        return redirect()->route('dashboard.kelas.show', $id)->with('success_jadwal', 'Jadwal berhasil diubah.');
    }

    /**
     * Update nama kelas.
     */
    public function updateName(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $class = ClassModel::findOrFail($id);
        $class->name = $request->name;
        $class->save();
        return redirect()->route('dashboard.kelas.show', $id)->with('success_nama_kelas', 'Nama kelas berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
