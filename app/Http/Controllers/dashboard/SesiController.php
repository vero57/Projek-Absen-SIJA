<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role && ($user->role->name === 'Admin' || $user->role->name === 'Guru')) {
                return redirect('/dashboard');
            }
            // Jika siswa, arahkan ke landing page
            if ($user->role && $user->role->name === 'Siswa') {
                return redirect()->route('landing.home');
            }
        }
        return view('auth.login_dash');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();
            if ($user->role && ($user->role->name === 'Admin' || $user->role->name === 'Guru')) {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            } else {
                Auth::logout();
                // Jika siswa, arahkan ke landing page
                if ($user->role && $user->role->name === 'Siswa') {
                    return redirect()->route('landing.home');
                }
                return back()->withErrors(['email' => 'Akses hanya untuk admin atau guru.']);
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth_dash');
    }
}
