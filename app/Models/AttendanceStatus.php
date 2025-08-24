<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceStatus extends Model
{
    protected $fillable = ['name'];

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'status_id');
    }
}
