<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cctv extends Model
{
    protected $fillable = ['name', 'location'];

    public function logs()
    {
        return $this->hasMany(CctvLog::class, 'cctv_id');
    }
}
