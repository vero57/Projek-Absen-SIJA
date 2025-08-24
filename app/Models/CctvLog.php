<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CctvLog extends Model
{
    protected $fillable = ['cctv_id', 'event', 'timestamp'];

    public function cctv()
    {
        return $this->belongsTo(Cctv::class, 'cctv_id');
    }
}
