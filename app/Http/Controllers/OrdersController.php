<?php

namespace App\Http\Controllers;


use App\Http\Resources\OrderCollection;
use App\Order;
use Auth;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $userId = Auth::guard('api')->user()->id;
        $orders = Order::with('user')->where('to_user_id','=',$userId)->orderBy('end_at', 'desc')->paginate(20);
        return new OrderCollection($orders);
    }
    public function lists()
    {
        $userId = Auth::guard('api')->user()->id;
        $orders = Order::with('tag')->where('to_user_id', $userId)->orderBy('id', 'desc')->paginate(9);
        if ($orders->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new OrderCollection($orders);
    }

    public function show($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new \App\Http\Resources\Order($order);
    }
    public function store(Request $request,Order $order){
        $userId = Auth::guard('api')->user()->id;
        $order->fill($request->all());
        $order->to_user_id=$userId;
        if($request->address){
            $foo = explode(',',$request->address);
            $order->address=$foo[0];
            $order->cityInfo=$foo[2];
            $order->villageInfo=$foo[1];
            $order->longitude=$foo[3];
            $order->latitude=$foo[4];
        }
        if($request->tags){
            $order->tag_id=$request->tags;
        }
        if($request->sendDate){
            $order->start_at=substr($request->sendDate['0'],0,10);
            $order->end_at=substr($request->sendDate['1'],0,10);
        }
        $success=$order->save();
        if ($success) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = '动态发布成功';
            $data['name'] = $request->name;
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '501';
            $data['msg'] = '系统繁忙，请售后再试';
            $data['name'] = $request->name;
            return json_encode($data);
        }
    }
}
