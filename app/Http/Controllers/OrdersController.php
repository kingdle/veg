<?php

namespace App\Http\Controllers;


use App\Http\Resources\OrderCollection;
use App\Order;
use App\Shop;
use App\Tag;
use Auth;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $userId = Auth::guard('api')->user()->id;
        $orders = Order::with('user')->where('to_user_id','=',$userId)->orderBy('id', 'desc')->paginate(9);
        return new OrderCollection($orders);
    }
    public function buyerList(){
        $userId = Auth::guard('api')->user()->id;
        $orders = Order::where('user_id', $userId)->orderBy('id', 'desc')->paginate(9);
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
            $order->tag_id=$this->normalizeTag($request->tags)['0'];
        }
        if($request->sendDate){
            $order->start_at=substr($request->sendDate['0'],0,10);
            $order->end_at=substr($request->sendDate['1'],0,10);
        }
        $success=$order->save();
        if ($success) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = '订单新建成功';
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
    public function buyerCreate(Request $request,Order $order){
        $userId = Auth::guard('api')->user()->id;
        $order->fill($request->all());
        $order->user_id=$userId;

        $to_user_id=Shop::where('id','=',$request->shop_id)->first();
        $order->to_user_id=$to_user_id->user_id;

        if($request->address){
            $foo = explode(',',$request->address);
            $order->address=$foo[0];
            $order->cityInfo=$foo[2];
            $order->villageInfo=$foo[1];
            $order->longitude=$foo[3];
            $order->latitude=$foo[4];
        }
        if($request->nickname){
            $order->nickname = $request->nickname;
        }
        if($request->phoneNumber){
            $order->phone = $request->phoneNumber;
        }
        if($request->note_buy){
            $order->note_buy = $request->note_buy;
        }
        $order->state = '0';
        $success=$order->save();
        if ($success) {
            //短信提醒苗场"农户新建订单，请打开苗果小程序与农户取得联系，并填写订单。"
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = '农户订单新建成功';
            $data['name'] = $request->nickname;
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '501';
            $data['msg'] = '系统繁忙，请售后再试';
            $data['name'] = $request->nickname;
            return json_encode($data);
        }
    }
    public function sellerCreate(Request $request){
        if(!$request->id){
            $data['status'] = true;
            $data['status_code'] = '404';
            $data['msg'] = '未找到订单';
            $data['name'] = now();
            return json_encode($data);
        }
        $order = Order::where('id', $request->id)->first();
        if($request->name){
            $attributes['name'] =$request->name;
        }
        if($request->count){
            $attributes['count'] =$request->count;
        }
        if($request->tags){
            $attributes['tag_id']=$this->normalizeTag($request->get('tags'));
            $order->tags()->attach($tags);
        }
        if($request->start_at){
            $attributes['start_at']=$request->start_at;
        }
        if($request->end_at){
            $attributes['end_at']=$request->end_at;
        }
        if($request->note_sell){
            $attributes['note_sell']=$request->note_sell;
        }
        $attributes['state'] = '1';
        $success=$order->update($attributes);

        if ($success) {
            //短信提醒农户"苗场已根据您的需要填写了订单，请打开苗果小程序确认订单。"
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = '苗场订单编辑成功';
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
    public function sellerTransport(Request $request){
        if(!$request->id){
            $data['status'] = true;
            $data['status_code'] = '404';
            $data['msg'] = '未找到订单';
            $data['name'] = now();
            return json_encode($data);
        }
        $order = Order::where('id', $request->id)->first();

        $attributes['state'] = '2';
        $success=$order->update($attributes);
        if ($success) {
            //短信提醒农户"苗场已根据您的需要填写了订单，请打开苗果小程序确认订单。"
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = '标记已送苗成功';
            $data['name'] = $order->name;
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '501';
            $data['msg'] = '系统繁忙，请售后再试';
            $data['name'] = $order->name;
            return json_encode($data);
        }
    }
    private function normalizeTag($tags)
    {
        $ids = Tag::pluck('id');

        $ids = collect($tags)->map(function ($tag) use ($ids) {
            if (is_numeric($tag) && $ids->contains($tag)) {
                return (int)$tag;
            }
            return Tag::firstOrCreate(['name' => $tag])->id;
        });
        Tag::whereIn('id', $ids)->increment('dynamics_count');
        return $ids;
    }

}
