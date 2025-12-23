<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'student_id',
        'parent_id',
        'type',
        'description',
        'status',
    ];

    public function files()
    {
        return $this->hasMany(PermissionFile::class, 'permission_id');
    }
}
