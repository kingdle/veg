<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dynamic extends Model
{
    protected $fillable=['user_id','shop_id','sort_id','content','pic','followers_count','published_at','is_hidden'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function shop(){
        return $this->belongsTo('App\Shop','shop_id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'dynamic_tag')->withTimestamps();
    }
}
