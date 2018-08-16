<?php

namespace App\Http\Controllers\Api;

use App\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlantingController extends Controller
{
    public function index(){
        $planting=Config::find('3');
        return response()->json([
            'status'=>'true',
            'status_code' => 200,
            'message' => '信息获取成功',
            'data'=>$planting,
            'url'=>json_decode($planting->slide),
            'notice'=>json_decode($planting->notice)
        ]);
    }
}
