<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Greenhouse extends Model
{
    protected $fillable = [
        'user_id','shop_id','title','phone','summary','content',
        'avatar','pic_count','dynamic_count','address',
        'country','city','district','town','village','longitude','latitude',
        'published_at','code','is_true','is_hidden'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
