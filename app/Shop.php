<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable =[
        'user_id','title','summary','content','property',
        'legal_person','legal_person_id','legal_person_id_card','business_license','business_license_pic',
        'avatar','pic_count','dynamic_count','click_count',
        'address','published_at','code','longitude','latitude',
        'language','country','province','cityInfo','villageInfo'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function order(){
        return $this->hasMany('App\Order','shop_id','id');
    }
    public function dynamic(){
        return $this->hasMany('App\Dynamic','shop_id','id');
    }

}

