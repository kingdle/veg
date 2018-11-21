<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table='user_dynamic';
    protected $fillable = ['user_id','dynamic_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function dynamic(){
        return $this->belongsTo(Dynamic::class);
    }
}
