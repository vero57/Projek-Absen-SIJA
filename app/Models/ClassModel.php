<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';
    protected $fillable = ['name', 'teacher_id'];

    public function students()
    {
        return $this->belongsToMany(User::class, 'class_student');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subject');
    }
}
