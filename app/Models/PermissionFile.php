<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionFile extends Model
{
    protected $fillable = ['permission_id', 'file_path'];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
