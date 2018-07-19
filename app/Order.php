<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'user_id',
        'shop_id',
        'to_user_id',
        'prod_id',
        'tag_id',
        'counts',
        'price',
        'unit_price',
        'total_price',
        'name',
        'address',
        'cityInfo',
        'villageInfo',
        'longitude',
        'latitude',
        'is_true_location',
        'phone',
        'state',
        'state_at',
        'payment',
        'payment_at',
        'is_confirm',
        'buyer_at',
        'seller_at',
        'buyer_confirm_at',
        'start_at',
        'end_at',
        'note_buy',
        'rate_buyer',
        'note_sell',
        'rate_seller',
        'is_del',
        'deleted_at'
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function tag(){
        return $this->belongsTo('App\Tag','tag_id');
    }
    public function prod(){
        return $this->belongsTo('App\Prod','prod_id');
    }
}
