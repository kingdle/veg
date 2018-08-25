<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BigDynamic extends Model
{
    protected $table='bigcode_dynamics';
    protected $fillable=['id','user_id','sort_id','content','pic','published_at','is_hidden'];
}
