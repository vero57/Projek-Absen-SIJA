<?php

namespace App\Http\Controllers\dashboard\dash_feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ViolationPoint;
use Dompdf\Dompdf;

class PelanggaranController extends Controller
{
    public function index()
    {
        return view('dashboard.page.pelanggaran_page.index');
    }

    public function show()
    {
        return view('dashboard.page.pelanggaran_page.show');
    }

    public function exportPdf()
    {
        $violations = ViolationPoint::with(['rule', 'student'])->get();

        $pdf = new Dompdf();
        $pdf->loadHtml(view('dashboard.page.pelanggaran_page.pdf', compact('violations')));
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return response($pdf->output())
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="pelanggaran.pdf"');
    }
}
