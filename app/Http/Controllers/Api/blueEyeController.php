<?php

namespace App\Http\Controllers\Api;

use App\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class blueEyeController extends Controller
{
    public function index(){
        $blue=Config::find('4');
        return response()->json([
            'status'=>'true',
            'status_code' => 200,
            'message' => '信息获取成功',
            'data'=>$blue,
            'url'=>json_decode($blue->slide)
        ]);
    }
}
