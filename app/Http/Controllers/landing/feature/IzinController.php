<?php

namespace App\Http\Controllers\landing\feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    public function index()
    {
        return view('landing.feature.izin.index');
    }
}
