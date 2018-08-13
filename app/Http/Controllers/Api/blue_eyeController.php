<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class blue_eyeController extends Controller
{
    public function index(){
        $planting=Config::find('4');
        return response()->json([
            'status'=>'true',
            'status_code' => 200,
            'message' => '信息获取成功',
            'data'=>$planting,
            'url'=>json_decode($planting->slide)
        ]);
    }
}
