<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
        'host','domain', 'prefix','title', 'slogan','newsTitle','newsSlogan',
        'slide','notice','admission','header_indicator_dots','header_auto_play',
        'header_interval','header_duration','header_circular','shop_indicator_dots',
        'shop_auto_play','shop_interval','shop_duration','shop_circular',
        'btn_register','btn_order','btn_love','btn_follower','btn_comment','btn_answer'
    ];
}
