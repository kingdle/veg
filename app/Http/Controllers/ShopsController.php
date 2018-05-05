<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShopCollection;
use App\Shop;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopsController extends Controller
{
    public function index()
    {
        $shops = Shop::with('user')->orderBy('id', 'desc')->paginate(9);
        return new ShopCollection($shops);
    }

    public function distance(Request $request, Shop $shop)
    {
        /**
         * 计算两点地理坐标之间的距离
         * @param  Decimal $longitude1 起点经度
         * @param  Decimal $latitude1  起点纬度
         * @param  Decimal $longitude2 终点经度
         * @param  Decimal $latitude2  终点纬度
         * @param  Int     $unit       单位 1:米 2:公里
         * @param  Int     $decimal    精度 保留小数位数
         * @return Decimal */
        $unit = 2;
        $decimal = 0;
        $latitude1 = $request->latitude;
        $latitude2 = Auth::guard('api')->user()->shop->latitude;
        $longitude1 = $request->longitude;
        $longitude2 = Auth::guard('api')->user()->shop->longitude;
        $EARTH_RADIUS = 6370.996; // 地球半径系数
        $PI = 3.1415926;
        $radLat1 = $latitude1 * $PI / 180.0;
        $radLat2 = $latitude2 * $PI / 180.0;
        $radLng1 = $longitude1 * $PI / 180.0;
        $radLng2 = $longitude2 * $PI / 180.0;
        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;
        $distance = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
        $distance = $distance * $EARTH_RADIUS * 1000;
        if ($unit == 2) {
            $distance = $distance / 1000;
        }
        return round($distance, $decimal);
//        $shops = Shop::with('user')->orderBy('id', 'desc')->paginate(9);
//        return new ShopCollection($shops);
    }

    public function show($id)
    {
        $shop = Shop::find($id);
        if (!$shop) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new \App\Http\Resources\Shop($shop);
    }

    public function store(Request $request, Shop $shop)
    {
        if (!$request->hasFile('avatar')) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        $userid = $request->user()->id;
        $title = $request->title;
        $summary = $request->summary;
        $cityInfo = $request->cityInfo;
        $address = $request->address;
        $longitude = $request->longitude;
        $latitude = $request->latitude;
        $avatar = $request->file('avatar');
        $filename = 'avatars/' . $userid . 'MG' . uniqid() . '.' . $avatar->getClientOriginalExtension();
        Storage::disk('upyun')->writeStream($filename, fopen($avatar->getRealPath(), 'r'));
        $filePath = config('filesystems.disks.upyun.protocol') . '://' . config('filesystems.disks.upyun.domain') . '/' . $filename;

        $shop->user_id = $userid;
        $shop->title = $title;
        $shop->avatar = $filePath;
        $shop->summary = $summary;
        $shop->cityInfo = $cityInfo;
        $shop->address = $address;
        $shop->longitude = $longitude;
        $shop->latitude = $latitude;
        $shop->save();

        return response()->json([
            'status' => 'true',
            'status_code' => 200,
            'message' => '店铺创建成功',
        ]);
    }

    public function update()
    {
        request()->user()->shop->update(request()->only('summary', 'address'));
        return response()->json(['status' => true]);
    }

    public function changeAvatar(Request $request)
    {
//        return (request()->header());
        $file = $request->file('img');
        $shop = $request->user()->shop;
        $avatar = substr($request->user()->shop->avatar, 23);
        Storage::disk('upyun')->delete($avatar);
        $filename = 'avatars/' . $request->user()->id . 'MG' . uniqid() . '.' . $file->getClientOriginalExtension();
//        Storage::disk('upyun')->pub('/avatar',$request->file('image'));
        Storage::disk('upyun')->writeStream($filename, fopen($file->getRealPath(), 'r'));
//        $file->move(public_path('avatars'), $filename);
        $shop->avatar = config('filesystems.disks.upyun.protocol') . '://' . config('filesystems.disks.upyun.domain') . '/' . $filename;

//        $shop->avatar = '/'.$filename;
        $shop->save();

        return ['url' => $shop->avatar];
    }

}
