<?php

namespace App\Http\Controllers;

use App\Http\Resources\SeedCollection;
use App\Seed;
use Auth;
use Illuminate\Http\Request;

class SeedsController extends Controller
{
    public function index()
    {
        $seeds = Seed::with('user')->where('is_active',1)->orderBy('id', 'desc')->paginate(9);
        return $seeds;
    }

    public function show($id)
    {
        $seeds = Seed::find($id);
        if (!$seeds) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new \App\Http\Resources\Seed($seeds);
    }
    public function store(Request $request){
        $data=[
            'user_id'=>Auth::guard('api')->user()->id,
            'title'=>$request->get('title'),
            'username'=>$request->get('username'),
            'property'=>$request->get('property'),
            'content'=>$request->get('content'),
            'phone'=>$request->get('phone'),
            'email'=>$request->get('email'),
            'address'=>$request->get('address'),
            'web_url'=>$request->get('web_url'),
            'publish_at'=>now(),
            'is_active'=>'1',
        ];
        $seed = Seed::create($data);
        return $seed;

    }
    public function update($id)
    {
        $seed = Seed::find($id);
        $seed->title = $request->get('title');
        $seed->username = $request->get('username');
        $seed->content = $request->get('content');
        $seed->content = $request->get('content');
        $seed->phone = $request->get('phone');
        $seed->email = $request->get('email');
        $seed->address = $request->get('address');
        $seed->web_url = $request->get('web_url');
        $seed->remark = $request->get('remark');
        $seed->save();
        return $seed;
    }
    public function destroy($id)
    {
        $seed = Seed::find($id);
        $seed->is_active = '0';
        $seed->save();
        return response()->json(['deleted']);
    }
}
