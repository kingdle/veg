<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ShopCollection;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopsController extends Controller
{
    public function weshow()
    {
        $shopid=request()->user()->shop->id;
        $shop = Shop::find($shopid);
        if (!$shop) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new \App\Http\Resources\Shop($shop);
    }
    public function weupdate(Request $request)
    {
        $userid=request()->user()->id;
        $shopid=request()->user()->shop->id;
        $shop = Shop::find($shopid);
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = 'avatars/'.$userid.'MG'.uniqid().'.'.$avatar->getClientOriginalExtension();
            Storage::disk('upyun')->writeStream($filename, fopen($avatar->getRealPath(), 'r'));
            $filePath=config('filesystems.disks.upyun.protocol').'://'.config('filesystems.disks.upyun.domain').'/'.$filename;
            $attributes['avatar'] = $filePath;
        }
        //把session_key
        $attributes['summary'] = $request->summary;
        $attributes['villageInfo'] = $request->villageInfo;
        $attributes['longitude'] = $request->longitude;
        $attributes['latitude'] = $request->latitude;
        $attributes['address'] = $request->address;
        // 更新用户数据
        $shop->update($attributes);
        return response()->json([
            'status'=>'true',
            'status_code' => 200,
            'message' => '店铺信息更新成功',
            'data'=>$shop
        ]);
    }
}
