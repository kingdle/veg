<?php

namespace App\Http\Controllers\Api;

use App\Favorite;
use App\Http\Resources\DynamicCollection;
use App\Shop;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class FavoritesController extends Controller
{
    public function index(){
       return Auth::user()->favorites()->pluck('shop_id');
    }
    public function followShopList(){
        $shop=Favorite::where('user_id',Auth::user()->id)->pluck('shop_id');
        $shops = Shop::with('shop','answers')->whereIn('id',$shop)->get();
        $shopsList= new DynamicCollection($shops);
        return response()->json([
            'status' => false,
            'status_code' => '200',
            'message'=>'我收藏的苗厂',
            'data'=>$shopsList
        ]);
    }
    public function isFavorites(Request $request){
        $user_id=Auth::user()->id;
        $shop_id=$request->shop_id;
        $favorites=Favorite::where('user_id',$user_id)->where('shop_id',$shop_id)->get();
        if ($favorites->count() == 0) {
            return response()->json(['status' => false,'message'=>'未收藏', 'status_code' => '401']);
        }
        return response()->json([
            'status' => true,
            'status_code' => '200',
            'message'=>'已收藏',
            'data'=>$favorites
        ]);
    }
    public function store(Request $request){
        $userId=Shop::where('id',$request->get('shop_id'))->first()->user_id;
//        User::where('id', $userId)->increment('followings_count');//关注用户的被关注数加1//increment自增decrement自减
        User::where('id', Auth::user()->id)->increment('followers_count');//用户关注数加1
        Shop::where('id',$request->get('shop_id'))->increment('followers_count');//苗厂关注数加1
        Auth::user()->favorites()->attach($request->get('shop_id'));
        return response()->json([
            'status'=>'true',
            'status_code' => 200,
            'message' => '苗场收藏成功',
            'data' => ''
        ]);
    }
    public function destroy($id){
        $userId=Shop::where('id',$id)->first()->user_id;
        Auth::user()->favorites()->detach($id);
//        User::where('id', $userId)->decrement('followings_count');//关注用户的被关注数减1//increment自增decrement自减
        User::where('id', Auth::user()->id)->decrement('followers_count');//关注数减1
        Shop::where('id',$id)->decrement('followers_count');//苗厂关注数减1
        return response()->json([
            'status'=>'true',
            'status_code' => 201,
            'message' => '取消收藏成功',
            'data' => ''
        ]);
    }
}
