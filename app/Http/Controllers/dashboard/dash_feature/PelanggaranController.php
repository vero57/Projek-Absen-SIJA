<?php

namespace App\Http\Controllers\dashboard\dash_feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function index()
    {
        return view('dashboard.page.pelanggaran_page.index');
    }
}
