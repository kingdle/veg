<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BigAlbum extends Model
{
    protected $table='bigcode_albums';
    protected $fillable=['id','user_id','pic'];
}
