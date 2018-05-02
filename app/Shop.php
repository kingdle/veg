<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable =['user_id','title','summary','content','property','avatar','pic_count','dynamic_count','address','published_at','code','longitude','latitude','cityInfo','villageInfo'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function dynamic(){
        return $this->hasMany('App\Dynamic','shop_id','id');
    }

}

