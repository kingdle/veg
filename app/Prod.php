<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prod extends Model
{
    protected $fillable=['shop_id','sort_id','title','introduce','pic','unit_prince','comments_count','likes_count','followers_count','publish_at'];

    public function sort(){
        return $this->hasOne('App\Sort','id','sort_id');
    }
}
