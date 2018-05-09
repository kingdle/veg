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
        $orders = Order::with('user')->where('to_user_id','=',$userId)->paginate(9);
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
        $order->fill($request->all());
        $order->save();
    }
}
