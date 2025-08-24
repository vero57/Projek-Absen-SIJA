<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaceLog extends Model
{
    protected $fillable = ['verification_id', 'result', 'timestamp'];

    public function verification()
    {
        return $this->belongsTo(FaceVerification::class, 'verification_id');
    }
}
