<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShopCollection;
use App\Shop;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function index()
    {
        $shops = Shop::with('user')->paginate(5);
        return new ShopCollection($shops);
    }

    public function show($user_id)
    {
        $shop = Shop::where('user_id', $user_id)->get();
        if ($shop->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return $shop[0];
    }

    public function update()
    {
        request()->user()->shop->update(request()->only('summary', 'address'));
        return response()->json(['status' => true]);
    }

    public function changeAvatar(Request $request)
    {
//        return (request()->header());
        $file = $request->img;
        $shop = $request->user()->shop;
        $filename = $shop->id.'MG'.md5(time()).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('avatars'), $filename);

        $shop->avatar = '/avatars/'.$filename;
        $shop->save();

//        return ['url' => $shop->avatar];
        return json_encode(array(
            'errcode' => 0,
            'data' => array(
                'src' =>  $shop->avatar,
            )
            )
        );
    }

}
