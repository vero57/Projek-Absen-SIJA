<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = ['teacher_id', 'class_id', 'subject_id', 'content'];

    public function files()
    {
        return $this->hasMany(JournalFile::class, 'journal_id');
    }
}
