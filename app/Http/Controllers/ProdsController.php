<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProdCollection;
use App\Prod;
use Auth;
use Illuminate\Http\Request;

class ProdsController extends Controller
{
    public function index()
    {
        $shopId = Auth::guard('api')->user()->shop->id;
        $prods = Prod::where('shop_id',$shopId)->orwhere('shop_id','187')->orderBy('updated_at', 'desc')->orderBy('likes_count', 'desc')->get();
        return new ProdCollection($prods);
    }

    public function show($id)
    {
        $prod = Prod::find($id);
        if (!$prod) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new \App\Http\Resources\Order($prod);
    }
    public function store(Request $request,Tag $tag){
        $tag->fill($request->all());
        $tag->save();
    }

    public function search(Request $request)
    {
        $prods = Prod::select(['sort_id','title','introduce'])
            ->where('title','like','%'.$request->q.'%')->orwhere('bio','like','%'.$request->q.'%')->orderBy('likes_count', 'desc')->get();
        return new ProdCollection($prods);
    }
}
