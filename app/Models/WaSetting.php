<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaSetting extends Model
{
    protected $fillable = ['api_key', 'phone_number'];
}
