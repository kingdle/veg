<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sort extends Model
{
    protected $fillable=['parent_id','title','icon','hot'];
    public function dynamics(){
        return $this->belongsToMany(Dynamic::class,'dynamic_sort')->withTimestamps();
    }
    public function prod(){
        return $this->belongsTo('App\Prod','prod_id');
    }
}
