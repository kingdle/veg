<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BigSort extends Model
{
    protected $table='bigcode_sorts';
    protected $fillable=['parent_id','title','icon','hot'];
}
