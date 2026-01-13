<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'class_id',
        'date',
        'time_in',
        'time_out',
        'status_id',
        'location_lat',
        'location_lng',
        'photo'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function status()
    {
        return $this->belongsTo(AttendanceStatus::class, 'status_id');
    }

    public function schedule()
    {
        return $this->belongsTo(AttendanceSchedule::class, 'schedule_id');
    }
}
