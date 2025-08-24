<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalFile extends Model
{
    protected $fillable = ['journal_id', 'file_path'];

    public function journal()
    {
        return $this->belongsTo(Journal::class);
    }
}
