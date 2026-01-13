<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Permission;
use App\Models\Journal;

class HomeController extends Controller
{
    public function index()
    {
        $userName = auth()->check() ? auth()->user()->name : null;
        $attendances = [];
        $permissions = [];
        $journals = [];

        if (auth()->check()) {
            $attendances = Attendance::where('student_id', auth()->id())
                ->orderByDesc('date')
                ->orderByDesc('time_in')
                ->get();

            $permissions = Permission::where('student_id', auth()->id())
                ->orderByDesc('created_at')
                ->get();

            $journals = Journal::where('student_id', auth()->id())
                ->orderByDesc('created_at')
                ->get();
        }

        return view('landing.home.index', compact('userName', 'attendances', 'permissions', 'journals'));
    }
}
