<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable=['user_id','shop_id','dynamic_id','video_thumbnail','video_url','video_height','video_width','video_size','video_duration','clicks_count','comments_count','is_hidden','close_comment'];
}
