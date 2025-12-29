<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = ['student_id', 'subject_id', 'description'];

    public function files()
    {
        return $this->hasMany(JournalFile::class, 'journal_id');
    }
}
