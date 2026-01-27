<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'student_id',
        'parent_name',
        'type',
        'description',
        'status',
        'photo',
        'location_lat',
        'location_lng',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function files()
    {
        return $this->hasMany(PermissionFile::class, 'permission_id');
    }
}
