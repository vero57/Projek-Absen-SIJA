<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['student_id', 'reason', 'date'];

    public function files()
    {
        return $this->hasMany(PermissionFile::class, 'permission_id');
    }
}
