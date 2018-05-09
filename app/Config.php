<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
        'host','domain', 'prefix', 'slogan'
    ];
}
