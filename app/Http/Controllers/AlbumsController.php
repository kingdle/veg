<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    public function index()
    {
        $shops = Shop::with('user')->paginate(5);
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
}
