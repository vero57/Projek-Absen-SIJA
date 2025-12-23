<?php

namespace App\Http\Controllers\landing\feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\User;
use App\Models\ParentModel;
use App\Models\Role;

class IzinController extends Controller
{
    public function index()
    {
        return view('landing.feature.izin.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas_siswa' => 'required|string',
            'nama_ortu' => 'required|string|max:255',
            'no_telp' => 'required|string|max:255',
            'tipe_izin' => 'required|in:sakit,izin,dispen',
            'deskripsi' => 'required|string'
        ]);

        // Cari student berdasarkan nama (asumsikan role student)
        $studentRole = Role::where('name', 'student')->first();
        $student = User::where('name', $request->nama_siswa)
                    ->where('role_id', $studentRole->id ?? null)
                    ->first();
        if (!$student) {
            return back()->withErrors(['nama_siswa' => 'Siswa tidak ditemukan.']);
        }

        // Cari parent_id berdasarkan nama ortu (asumsikan dari ParentModel)
        $parent = ParentModel::where('name', $request->nama_ortu)->first(); // Atau query sesuai
        if (!$parent) {
            return back()->withErrors(['nama_ortu' => 'Orang tua tidak ditemukan.']);
        }

        // Map field request ke kolom model
        $data = [
            'student_id' => $student->id,
            'parent_id' => $parent->id,
            'type' => $request->tipe_izin,  // Map dari 'tipe_izin' ke 'type'
            'description' => $request->deskripsi,  // Map dari 'deskripsi' ke 'description'
            'status' => 'pending'  // Default status, sesuaikan jika ada field request
        ];

        // Simpan menggunakan create() (lebih efisien)
        Permission::create($data);

        return redirect()->route('izin.index')->with('success', 'Izin berhasil diajukan.');
    }
}
