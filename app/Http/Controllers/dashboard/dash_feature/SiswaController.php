<?php

namespace App\Http\Controllers\dashboard\dash_feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentDetail;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {
        $users = User::whereHas('role', function ($q) {
            $q->where('name', 'Siswa');
        })->paginate(10);

        return view('dashboard.page.siswa_page.index', compact('users'));
    }

    public function createDetail($user_id)
    {
        $user = User::findOrFail($user_id);
        $detail = $user->studentDetail;
        if ($detail) {
            // Jika detail sudah ada, arahkan ke halaman edit
            return redirect()->route('dashboard.siswa.detail.edit', $user->id);
        }
        return view('dashboard.page.siswa_page.edit', compact('user'));
    }

    public function storeDetail(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $detail = $user->studentDetail;

        $rules = [
            'nis' => 'required|string|max:20|unique:student_details,nis,' . ($detail ? $detail->id : 'NULL'),
            'nisn' => 'nullable|string|max:20|unique:student_details,nisn,' . ($detail ? $detail->id : 'NULL'),
            'gender' => 'required|in:L,P',
            'birth_place' => 'required|string|max:100',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ];
        $request->validate($rules);

        $data = $request->only(['nis', 'nisn', 'gender', 'birth_place', 'birth_date', 'address']);
        $data['user_id'] = $user->id;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('student_photos', 'public');
        }

        if ($detail) {
            // Update detail jika sudah ada
            $detail->update($data);
            return redirect()->route('dashboard.siswa')->with('success', 'Detail siswa berhasil diupdate!');
        } else {
            StudentDetail::create($data);
            return redirect()->route('dashboard.siswa')->with('success', 'Detail siswa berhasil ditambahkan!');
        }
    }

    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('dashboard.page.siswa_page.show', compact('user'));
    }

    public function editDetail($user_id)
    {
        $user = User::findOrFail($user_id);
        $detail = $user->studentDetail;
        if (!$detail) {
            // Jika belum ada detail, arahkan ke tambah
            return redirect()->route('dashboard.siswa.detail.create', $user->id);
        }
        return view('dashboard.page.siswa_page.edit', compact('user', 'detail'));
    }

    public function updateDetail(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $detail = $user->studentDetail;
        if (!$detail) {
            return redirect()->route('dashboard.siswa.detail.create', $user->id);
        }

        $rules = [
            'nis' => 'required|string|max:20|unique:student_details,nis,' . $detail->id,
            'nisn' => 'nullable|string|max:20|unique:student_details,nisn,' . $detail->id,
            'gender' => 'required|in:L,P',
            'birth_place' => 'required|string|max:100',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ];
        $request->validate($rules);

        $data = $request->only(['nis', 'nisn', 'gender', 'birth_place', 'birth_date', 'address']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('student_photos', 'public');
        }

        $detail->update($data);

        return redirect()->route('dashboard.siswa')->with('success', 'Detail siswa berhasil diupdate!');
    }
}
