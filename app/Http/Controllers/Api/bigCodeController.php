<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class bigCodeController extends Controller
{
    public function index(){
        $blue=Config::find('5');
        return response()->json([
            'status'=>'true',
            'status_code' => 200,
            'message' => '信息获取成功',
            'data'=>$blue,
            'url'=>json_decode($blue->slide)
        ]);
    }
}
