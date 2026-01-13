<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaceVerification extends Model
{
    protected $fillable = [
        'student_id',
        'attendance_id',
        'expression_required',
        'expression_verified',
        'verified_at'
    ];

    public function logs()
    {
        return $this->hasMany(FaceLog::class, 'verification_id');
    }
}
