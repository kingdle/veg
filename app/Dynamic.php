<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dynamic extends Model
{
    protected $fillable=['user_id','shop_id','content','pic','published_at'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
