<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaNotification extends Model
{
    protected $fillable = ['student_id', 'message', 'status'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
