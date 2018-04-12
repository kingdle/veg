<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sort extends Model
{
    protected $fillable=['parent_id','title','icon','hot'];
}
