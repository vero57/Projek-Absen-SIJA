<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['student_id', 'status_id', 'schedule_id'];

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
