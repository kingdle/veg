<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['user_id','to_user_id','prod_id','tag_id','count','price','name','address','cityInfo','villageInfo','longitude','latitude','phone','state','start_at','end_at','note_buy','note_sell'];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function tag(){
        return $this->belongsTo('App\Tag','tag_id');
    }
}
