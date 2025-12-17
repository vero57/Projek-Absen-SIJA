<?php

namespace App\Http\Controllers\dashboard\dash_feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index()
    {
        return view('dashboard.page.jurnal_page.index');
    }

    public function show()
    {
        return view('dashboard.page.jurnal_page.show');
    }
}
