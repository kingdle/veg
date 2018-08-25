<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BigUser extends Model
{
    protected $table='bigcode_users';
    protected $fillable = [
        'name', 'phone', 'email', 'password','avatar','country','province','language','city','is_active',
        'username', 'nickname','avatar_url','gender',
        'weixin_session_key','weapp_openid',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
