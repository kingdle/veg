<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'phone',
        'depart',
        'appearance',
        'performance',
        'changes',
        'idea',
        'created_at',
        'updated_at',
    ];
}
