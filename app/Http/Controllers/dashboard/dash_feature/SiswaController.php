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
        return view('dashboard.page.siswa_page.edit', compact('user'));
    }

    public function storeDetail(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $request->validate([
            'nis' => 'required|string|max:20|unique:student_details,nis',
            'nisn' => 'nullable|string|max:20|unique:student_details,nisn',
            'gender' => 'required|in:L,P',
            'birth_place' => 'required|string|max:100',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nis', 'nisn', 'gender', 'birth_place', 'birth_date', 'address']);
        $data['user_id'] = $user->id;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('student_photos', 'public');
        }

        StudentDetail::create($data);

        return redirect()->route('dashboard.siswa')->with('success', 'Detail siswa berhasil ditambahkan!');
    }
}
