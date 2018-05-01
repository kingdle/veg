<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seed extends Model
{
    protected $fillable =['user_id','username','title','address','email','property','content','phone','web_url','remark','published_at','code','is_active'];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
