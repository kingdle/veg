<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dynamic extends Model
{
    protected $fillable=['user_id','content','pic','published_at'];
}
