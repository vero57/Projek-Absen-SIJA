<?php

namespace App\Http\Controllers\dashboard\dash_feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Journal;
use Dompdf\Dompdf;

class JurnalController extends Controller
{
    public function index()
    {
        $journals = Journal::with(['student', 'subject'])->paginate(10);
        return view('dashboard.page.jurnal_page.index', compact('journals'));
    }

    public function show($id)
    {
        $journal = Journal::with(['student', 'subject', 'files'])->findOrFail($id);
        return view('dashboard.page.jurnal_page.show', compact('journal'));
    }

    public function exportPdf()
    {
        $journals = Journal::with(['student', 'subject'])->get();

        $dompdf = new Dompdf();
        $html = view('dashboard.page.jurnal_page.pdf', compact('journals'))->render();
        $dompdf->loadHtml($html);
        $dompdf->render();

        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="daftar_jurnal_siswa.pdf"'
        ]);
    }
}
