<?php

namespace App\Http\Controllers\landing\feature;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use App\Models\JournalFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JurnalController extends Controller
{
    public function index()
    {
        $subjects = \App\Models\Subject::all(); // Ambil semua subjects dari database
        return view('landing.feature.jurnal.index', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string|max:255',
            'subject_id' => 'required|string|max:255',
            'description' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:5120' // Tambahkan validasi foto
        ]);

        $journal = Journal::create([
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'description' => $request->description,
        ]);

        $journal->save();

        // Handle upload foto jika ada
        if ($request->hasFile('foto')) {
            $filePath = $request->file('foto')->store('journals', 'public'); // Simpan ke storage/app/public/journals
            JournalFile::create([
                'journal_id' => $journal->id,
                'file_path' => $filePath
            ]);
        }

        return redirect()->route('landing.home')->with('success', 'Jurnal berhasil dikirim.');
    }
}
