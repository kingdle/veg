<?php

namespace App\Http\Controllers\Api;

use App\Favorite;
use App\Shop;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class FavoritesController extends Controller
{
    public function index(){
        $favorites=Auth::user()->favorites();
        return $favorites;
    }
    public function store(Request $request){
        $userId=Shop::where('id',$request->get('shop_id'))->first()->user_id;
        User::where('id', $userId)->increment('followings_count');//关注用户的被关注数加1//increment自增decrement自减
        User::where('id', Auth::user()->id)->increment('followers_count');//关注数加1
        Auth::user()->favorites()->attach($request->get('shop_id'));
        return response()->json([
            'status'=>'true',
            'status_code' => 200,
            'message' => '苗场收藏成功'
        ]);
    }
    public function destroy($id){
        $userId=Shop::where('id',$id)->first()->user_id;
        Auth::user()->favorites()->detach($id);
        User::where('id', $userId)->decrement('followings_count');//关注用户的被关注数减1//increment自增decrement自减
        User::where('id', Auth::user()->id)->decrement('followers_count');//关注数减1
        return response()->json([
            'status'=>'true',
            'status_code' => 200,
            'message' => '取消收藏成功'
        ]);
    }
}
