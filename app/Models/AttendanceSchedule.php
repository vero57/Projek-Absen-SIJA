<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceSchedule extends Model
{
    protected $fillable = [
        'class_id',
        'start_time_in',
        'end_time_in',
        'start_time_out',
        'end_time_out'
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'schedule_id');
    }
}
