<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentDetail;

class FaceApiController extends Controller
{
    public function getUserFace()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $detail = StudentDetail::where('user_id', $user->id)->first();

        return response()->json([
            'name' => $user->name,
            'photo_url' => $detail && $detail->photo
                ? asset('storage/' . $detail->photo)
                : null
        ]);
    }
}
