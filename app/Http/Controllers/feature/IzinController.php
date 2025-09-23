<?php

namespace App\Http\Controllers\feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    public function index()
    {
        return view('landing.feature.izin.index');
    }
}
