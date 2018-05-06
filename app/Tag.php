<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name','bio','pic','dynamics_count','followers_count'];
    public function dynamics(){
        return $this->belongsToMany(Dynamic::class,'dynamic_tag')->withTimestamps();
    }
}
