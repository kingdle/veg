<?php

namespace App\Http\Controllers\Api;

use App\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class bigCodeController extends Controller
{
    public function index(){
        $bigCode=Config::find('5');
        return response()->json([
            'status'=>'true',
            'status_code' => 200,
            'message' => '信息获取成功',
            'data'=>$bigCode,
            'url'=>json_decode($bigCode->slide)
        ]);
    }
}
