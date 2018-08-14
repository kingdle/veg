<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ShopCollection;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopsController extends Controller
{
    public function weShow()
    {
        $shopId=request()->user()->shop->id;
        $shop = Shop::find($shopId);
        if (!$shop) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new \App\Http\Resources\Shop($shop);
    }
    public function shopList()
    {
        $userId=request()->user()->id;
        $shops = Shop::where('is_hidden','F')->where('is_service','F')->orderBy('title', 'desc')->get(array('id','user_id','title','villageInfo'));
//        foreach ($shops as $value){
//            $id[]= $value->id;
//            $user_id[]=$value->user_id;
//            $title[]= $value->title;
//            $villageInfo[]=$value->villageInfo;
//        }
//        $shopList = [
//            'id' => $id,
//            'user_id' => $user_id,
//            'title' => $title,
//            'villageInfo' => $villageInfo,
//        ];
        return json_encode($shops);
    }
    public function weUpdate(Request $request)
    {
        $userId=request()->user()->id;
        $shopId=request()->user()->shop->id;
        $shop = Shop::find($shopId);
//        if ($request->hasFile('avatar')) {
//            $avatar = $request->file('avatar');
//            $filename = 'avatars/'.$userId.'MG'.uniqid().'.'.$avatar->getClientOriginalExtension();
//            Storage::disk('upyun')->writeStream($filename, fopen($avatar->getRealPath(), 'r'));
//            $filePath=config('filesystems.disks.upyun.protocol').'://'.config('filesystems.disks.upyun.domain').'/'.$filename;
//            $attributes['avatar'] = $filePath;
//        }
        //把session_key
        if($request->summary){
            $attributes['summary'] = $request->summary;
        }
        if($request->country){
            $attributes['country'] = $request->country;

        }
        if($request->province){
            $attributes['province'] = $request->province;
        }
        if($request->cityInfo){
            $attributes['cityInfo'] = $request->cityInfo;
        }
        if($request->villageInfo){
            $attributes['villageInfo'] = $request->villageInfo;
        }
        if($request->longitude){
            $attributes['longitude'] = $request->longitude;
            $attributes['latitude'] = $request->latitude;
        }
        if($request->longitude){
            $attributes['address'] = $request->address;
        }
        // 更新用户数据
        $shop->update($attributes);
        return response()->json([
            'status'=>'true',
            'status_code' => 200,
            'message' => '苗场信息更新成功',
            'data'=>$shop
        ]);
    }
    public function weShopAvatar(Request $request)
    {
        $userId=request()->user()->id;
        $shopId=request()->user()->shop->id;
        $shop = Shop::find($shopId);
        if ($request->hasFile('file')) {
            $avatar = $request->file('file');
            $filename = 'avatars/'.$userId.'MG'.uniqid().'.'.$avatar->getClientOriginalExtension();
            Storage::disk('upyun')->writeStream($filename, fopen($avatar->getRealPath(), 'r'));
            $filePath=config('filesystems.disks.upyun.protocol').'://'.config('filesystems.disks.upyun.domain').'/'.$filename;
            $attributes['avatar'] = $filePath;
            $shop->update($attributes);
            return $filePath;
        }
        return response()->json([
            'status'=>'false',
            'status_code' => 403,
            'message' => '店铺头像更新失败',
        ],403);
    }
}
