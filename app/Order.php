<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['user_id','prod_id','count','price','name','address','phone','state','note_buy','note_sell'];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
