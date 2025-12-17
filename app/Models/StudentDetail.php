<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nis',
        'nisn',
        'gender',
        'birth_place',
        'birth_date',
        'address',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
