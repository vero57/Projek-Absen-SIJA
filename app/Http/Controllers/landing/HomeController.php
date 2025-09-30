<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('landing.home.index');
    }
}
