<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViolationPoint extends Model
{
    protected $fillable = ['student_id', 'rule_id', 'date'];

    public function rule()
    {
        return $this->belongsTo(ViolationRule::class, 'rule_id');
    }
}
