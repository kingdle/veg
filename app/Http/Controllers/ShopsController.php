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
    public function show(Shop $shop){
        return $shop;
    }
    public function update()
    {
        request()->user()->update(request()->only('summary','avatar'));
        return response()->json(['status' => true]);
    }
}
