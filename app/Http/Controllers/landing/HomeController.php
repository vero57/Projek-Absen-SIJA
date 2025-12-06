<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $userName = auth()->check() ? auth()->user()->name : null;
        return view('landing.home.index', compact('userName'));
    }
}
