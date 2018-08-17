<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'id','user_id','dynamic_id', 'body','votes_count', 'comments_count','is_hidden','close_comment'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function dynamic(){
        return $this->belongsTo(Dynamic::class);
    }
}
