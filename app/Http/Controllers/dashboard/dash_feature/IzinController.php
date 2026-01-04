<?php

namespace App\Http\Controllers\dashboard\dash_feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;

class IzinController extends Controller
{
    public function index()
    {
        $permissions = Permission::with(['student'])->paginate(10);
        return view('dashboard.page.izin_page.index', compact('permissions'));
    }

    public function show($id)
    {
        $permission = Permission::with(['student'])->findOrFail($id);
        return view('dashboard.page.izin_page.show', compact('permission'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status izin berhasil diupdate.');
    }
}
