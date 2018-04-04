<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable =['title','summary','user_id','content','property','avatar','pic_count','dynamic_count','address','published_at','code'];
}
