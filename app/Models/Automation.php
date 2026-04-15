<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Automation extends Model
{
    protected $fillable = [
        'name',
        'description',
        'trigger_type',
        'active',
        'user_id'
    ];
}
