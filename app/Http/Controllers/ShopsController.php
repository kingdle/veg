<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShopCollection;
use App\Shop;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function index(){
        $shops = Shop::with('user')->paginate(5);
        return new ShopCollection($shops);
    }
    public function show($user_id){
        $shop = Shop::where('user_id', $user_id)->get();
        if ($shop->count() == 0) {
            return response()->json(['status' => false,'status_code' => '401']);
        }
        return $shop[0];
    }
    public function update()
    {
        request()->user()->shop->update(request()->only('summary'));
        return response()->json(['status' => true]);
    }
}
