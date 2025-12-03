<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\ClassModel;

class LoginRegisterController extends Controller
{
    public function showLoginRegister()
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role && $user->role->name === 'Siswa') {
                return redirect()->route('landing.home');
            }
            // Jika admin/guru, arahkan ke dashboard
            return redirect()->route('dashboard.dash');
        }
        $classes = \App\Models\ClassModel::all();
        return view('auth.login-register', compact('classes'));
    }

    public function loginSiswa(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();
            if ($user->role && $user->role->name === 'Siswa') {
                $request->session()->regenerate();
                // Redirect ke landing page setelah login
                return redirect()->route('landing.home');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'Akses hanya untuk siswa.']);
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logoutSiswa(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login-register');
    }

    public function registerSiswa(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:6|confirmed',
            'no_telp'    => 'required|string|max:20',
            'class_id'   => 'required|exists:classes,id',
        ]);

        $role = Role::where('name', 'Siswa')->first();

        $user = User::create([
            'name'        => $request->nama_siswa,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'phone_number' => $request->no_telp,
            'role_id'     => $role ? $role->id : null,
        ]);

        // Simpan kelas siswa ke tabel pivot
        $user->classes()->attach($request->class_id);

        Auth::login($user);

        return redirect()->route('landing.home');
    }
}
