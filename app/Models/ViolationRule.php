<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViolationRule extends Model
{
    protected $fillable = ['name', 'points'];

    public function violations()
    {
        return $this->hasMany(ViolationPoint::class, 'rule_id');
    }
}
