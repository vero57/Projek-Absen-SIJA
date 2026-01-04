<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role && auth()->user()->role->name === 'Siswa') {
            return redirect()->route('landing.home');
        }

        // Ambil data siswa dengan izin approved
        $approvedPermissions = Permission::whereIn('type', ['sakit', 'izin', 'dispen'])
            ->where('status', 'approved')
            ->with('student')
            ->get();

        // Hitung jumlah siswa berdasarkan type
        $totalSiswa = User::whereHas('role', function($q) {
            $q->where('name', 'Siswa');
        })->count();

        $siswaSakit = $approvedPermissions->where('type', 'sakit')->count();
        $siswaIzin = $approvedPermissions->where('type', 'izin')->count();
        $siswaDispen = $approvedPermissions->where('type', 'dispen')->count();

        // Siswa masuk: total siswa - (sakit + izin + dispen)
        $siswaMasuk = $totalSiswa - ($siswaSakit + $siswaIzin + $siswaDispen);

        // Siswa tanpa keterangan: mungkin dari attendance, tapi untuk sementara 0
        $siswaAlfa = 0;

        return view('dashboard.dash.index', compact(
            'approvedPermissions',
            'totalSiswa',
            'siswaMasuk',
            'siswaSakit',
            'siswaIzin',
            'siswaDispen',
            'siswaAlfa'
        ));
    }
}
