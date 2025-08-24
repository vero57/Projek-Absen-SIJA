<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    protected $table = 'parents';
    protected $fillable = ['name', 'phone', 'address'];

    public function students()
    {
        return $this->hasMany(User::class, 'parent_id');
    }
}
