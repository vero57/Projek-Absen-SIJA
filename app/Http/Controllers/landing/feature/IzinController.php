<?php

namespace App\Http\Controllers\landing\feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\PermissionFile;
use App\Models\User;
use App\Models\ParentModel;
use App\Models\Role;

class IzinController extends Controller
{
    public function index()
    {
        return view('landing.feature.izin.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string|max:255',
            'parent_name' => 'required|string|max:255',
            'type' => 'required|in:sakit,izin,dispen',
            'description' => 'required|string',
            'status' => 'in:pending,approved,rejected',
        ]);

        $permission = Permission::create([
            'student_id' => $request->student_id,
            'parent_name' => $request->parent_name,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        $permission->save();

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('permissions', 'public');
            PermissionFile::create([
                'permission_id' => $permission->id,
                'file_path' => $filePath
            ]);
        }

        return redirect()->route('landing.home')->with('success', 'Izin berhasil diajukan.');
    }
}
