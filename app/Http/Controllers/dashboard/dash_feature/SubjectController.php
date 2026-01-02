<?php

namespace App\Http\Controllers\dashboard\dash_feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('name')->paginate(10);
        return view('dashboard.page.subject_page.index', compact('subjects'));
    }

    public function create()
    {
        return view('dashboard.page.subject_page.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        Subject::create($request->only('name'));
        return redirect()->route('dashboard.subjects.index')->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('dashboard.page.subject_page.edit', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $subject = Subject::findOrFail($id);
        $subject->update($request->only('name'));
        return redirect()->route('dashboard.subjects.index')->with('success', 'Mata pelajaran berhasil diupdate.');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return redirect()->route('dashboard.subjects.index')->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
