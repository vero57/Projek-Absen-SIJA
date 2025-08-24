<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaceVerification extends Model
{
    protected $fillable = ['user_id', 'face_data'];

    public function logs()
    {
        return $this->hasMany(FaceLog::class, 'verification_id');
    }
}
