<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShopCollection;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopsController extends Controller
{
    public function index()
    {
        $shops = Shop::with('user')->orderBy('id', 'desc')->paginate(9);
        return new ShopCollection($shops);
    }

    public function show($id)
    {
        $shop = Shop::find($id);
        if (!$shop) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new \App\Http\Resources\Shop($shop);
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
        $avatar = substr($request->user()->shop->avatar,23);
        Storage::disk('upyun')->delete($avatar);
        $filename = 'avatars/'.$shop->id.'MG'.md5(time()).'.'.$file->getClientOriginalExtension();
//        Storage::disk('upyun')->pub('/avatar',$request->file('image'));
        Storage::disk('upyun')->writeStream($filename, fopen($file->getRealPath(), 'r'));
//        $file->move(public_path('avatars'), $filename);
        $shop->avatar=config('filesystems.disks.upyun.protocol').'://'.config('filesystems.disks.upyun.domain').'/'.$filename;

//        $shop->avatar = '/'.$filename;
        $shop->save();

        return ['url' => $shop->avatar];
    }

}
