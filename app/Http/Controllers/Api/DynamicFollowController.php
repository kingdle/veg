<?php

namespace App\Http\Controllers\Api;

use App\Dynamic;
use App\Follow;
use App\Http\Resources\DynamicCollection;
use Auth;
use Illuminate\Http\Request;

class DynamicFollowController extends Controller
{
    public function follow(Request $request){
        Auth::user()->followThis($request->dynamicId);
        $userId = Auth::guard('api')->user()->id;
        $follow=Follow::where('user_id',$userId)->where('dynamic_id',$request->dynamicId);
        $dynamic=Dynamic::find($request->dynamicId);
        if($follow->count() != 0){
            $dynamic->increment('followers_count');
        }else{
            $dynamic->decrement('followers_count');
        }
        $dynamics = Dynamic::with('shop','answers')->where('id','=',$request->dynamicId)->get();
        $dy= new DynamicCollection($dynamics);
        return response()->json([
            'status' => false,
            'status_code' => '200',
            'message'=>'状态更新成功',
            'data'=>$dy
        ]);
    }
}
