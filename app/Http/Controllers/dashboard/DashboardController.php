<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role && auth()->user()->role->name === 'Siswa') {
            return redirect()->route('landing.home');
        }
        return view('dashboard.dash.index');
    }
}
