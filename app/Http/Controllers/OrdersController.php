<?php

namespace App\Http\Controllers;


use App\Http\Resources\OrderCollection;
use App\Order;
use App\Prod;
use App\Shop;
use App\Tag;
use Auth;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $userId = Auth::guard('api')->user()->id;
        $orders = Order::with('user')->where('to_user_id', '=', $userId)->where('is_del', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        return new OrderCollection($orders);
    }

    public function buyerList()
    {
        $userId = Auth::guard('api')->user()->id;
        $orders = Order::where('user_id', $userId)->where('is_del', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        return new OrderCollection($orders);
    }

    public function pastList(Request $request)
    {
        $userId = Auth::guard('api')->user()->id;
        $phone = $request->phone;
        $orders = Order::where("to_user_id",'=',$userId)->where("phone",'=',$phone)->where('is_del', '=', 'F')->orderby("id","desc")->get();
        if ($orders->count() == 0) {
            $data['status'] = false;
            $data['status_code'] = '401';
            $data['msg'] = '订单为空';
            $data['data'] = [];
            $data['links'] = '';
            $data['meta'] = [
                'current_page' => 0,
                'from' => 0,
                'last_page' => 0,
                'path' => '',
                'per_page' => 9,
                'to' => 0,
                'total' => 0
            ];
            return json_encode($data);
        }
        return new OrderCollection($orders);
    }
    public function weBuyerList(Request $request)
    {
        if($request->phone ==''){
            $data['status'] = false;
            $data['status_code'] = '401';
            $data['msg'] = '手机号不能为空';
            $data['data'] = [];
            $data['links'] = '';
            $data['meta'] = [
                'current_page' => 0,
                'from' => 0,
                'last_page' => 0,
                'path' => '',
                'per_page' => 9,
                'to' => 0,
                'total' => 0
            ];
            return json_encode($data);
        }
        $userId = Auth::guard('api')->user()->id;
        $phone = $request->phone;
        $orders = Order::where("phone",'=',$phone)->with(['shop'=>function($query){
            $query->select('id','title');
        }])->with(['prod'=>function($query){
            $query->select('id','sort_id','title','pic');
        }])->where('is_del', '=', 'F')->orderby("end_at","desc")->get();
        $orderCounts=Order::latest()->where("phone",'=',$phone)->where('is_del', '=','F')->count();//订单总数
        if ($orders->count() == 0) {
            $data['status'] = false;
            $data['status_code'] = '401';
            $data['msg'] = '订单为空';
            $data['data'] = [];
            $data['links'] = '';
            $data['meta'] = [
                'current_page' => 0,
                'from' => 0,
                'last_page' => 0,
                'path' => '',
                'per_page' => 9,
                'to' => 0,
                'total' => 0
            ];
            return json_encode($data);
        }
        foreach($orders as $value){
            $order[] = [
                'id' => $value->id,
                'shop' => $value->shop,
                'prod' => $value->prod,
                'counts' => $value->counts,
                'payment' => $value->payment,
                'state' => $value->state,
                'counts'=>$orderCounts,
                'end_at' => substr($value->end_at,0,10),
                'created_at' => substr($value->created_at,0,10),
            ];
        }
        return $order;
    }
    public function lists()
    {
        $userId = Auth::guard('api')->user()->id;
        $orders = Order::with('tag')->where('to_user_id', $userId)->where('is_del', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        if ($orders->count() == 0) {
            $data['status'] = false;
            $data['status_code'] = '401';
            $data['msg'] = '订单为空';
            $data['data'] = [];
            $data['links'] = '';
            $data['meta'] = [
                'current_page' => 0,
                'from' => 0,
                'last_page' => 0,
                'path' => '',
                'per_page' => 9,
                'to' => 0,
                'total' => 0
            ];
            return json_encode($data);
        }
        return new OrderCollection($orders);
    }
    public function listSize(Request $request)
    {
        $pagination= $request->pagination;
        $userId = Auth::guard('api')->user()->id;
        $orders = Order::with('tag')->where('to_user_id', $userId)->where('is_del', '=', 'F')->orderBy('id', 'desc')->paginate($pagination?$pagination:9);
        if ($orders->count() == 0) {
            $data['status'] = false;
            $data['status_code'] = '401';
            $data['msg'] = '订单为空';
            $data['data'] = [];
            $data['links'] = '';
            $data['meta'] = [
                'current_page' => 0,
                'from' => 0,
                'last_page' => 0,
                'path' => '',
                'per_page' => 9,
                'to' => 0,
                'total' => 0
            ];
            return json_encode($data);
        }
        return new OrderCollection($orders);
    }
    public function queryList()
    {
        $userId = Auth::guard('api')->user()->id;
        $orders = Order::where('to_user_id', $userId)->where('name', '!=', '')->where('is_del', '=', 'F')->distinct()->get(['name']);
        $multiplied = $orders->map(function ($item, $key) {
            return [
                'value'=>$item->name,
            ];
        })->all();
        return $multiplied;
    }
    public function queryPhone()
    {
        $userId = Auth::guard('api')->user()->id;
        $orders = Order::where('to_user_id', $userId)->where('phone', '!=', '')->where('is_del', '=', 'F')->distinct()->get(['phone']);
        return $orders;
    }
    public function queryAddress()
    {
        $userId = Auth::guard('api')->user()->id;
        $orders = Order::where('to_user_id', $userId)->where('villageInfo', '!=', '')->where('is_del', '=', 'F')->distinct()->get(['villageInfo']);
        return $orders;
    }
    public function queryResult(Request $request)
    {
        $userId = Auth::guard('api')->user()->id;
        if($request->name){
            $orders = Order::where('to_user_id', $userId)->where('name','like','%'.$request->name.'%')->orwhere('nickname','like','%'.$request->name.'%')->where('is_del', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->phone){
            $orders = Order::where('to_user_id', $userId)->where('phone','=',$request->phone)->where('is_del', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->villageInfo){
            $orders = Order::where('to_user_id', $userId)->where('villageInfo','like','%'.$request->villageInfo.'%')->orwhere('address','like','%'.$request->villageInfo.'%')->where('is_del', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->start_at){
            $orders = Order::where('to_user_id', $userId)->where('start_at','like','%'.$request->start_at.'%')->where('is_del', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->end_at){
            $orders = Order::where('to_user_id', $userId)->where('end_at','like','%'.$request->end_at.'%')->where('is_del', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->tag_id){
            $orders = Order::where('to_user_id', $userId)->where('tag_id','=',$request->tag_id)->where('is_del', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if ($orders->count() == 0) {
            $data['status'] = false;
            $data['status_code'] = '401';
            $data['msg'] = '订单为空';
            $data['data'] = [];
            $data['links'] = '';
            $data['meta'] = [
                'current_page' => 0,
                'from' => 0,
                'last_page' => 0,
                'path' => '',
                'per_page' => 9,
                'to' => 0,
                'total' => 0
            ];
            return json_encode($data);
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

    public function store(Request $request, Order $order)
    {
        $userId = Auth::guard('api')->user()->id;
        $shopId = Auth::guard('api')->user()->shop->id;
        $order->fill($request->all());
        $order->to_user_id = $userId;
        $order->shop_id = $shopId;
        if ($request->address) {
            $foo = explode(',', $request->address);
            $order->address = $foo[0];
            $order->cityInfo = $foo[2];
            $order->villageInfo = $foo[1];
            $order->latitude = $foo[3];
            $order->longitude = $foo[4];
        }
        if ($request->unit_price && $request->counts) {
            $order->total_price =  $request->unit_price * $request->counts;
        }
        if ($request->tags) {
            $order->tag_id = $this->normalizeTag($request->tags)['0'];
        }
        if ($request->sendDate) {
            $order->start_at = substr($request->sendDate['0'], 0, 10);
            $order->end_at = substr($request->sendDate['1'], 0, 10);
        }
        $success = $order->save();

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
    public function weStore(Request $request, Order $order)
    {
        $userId = Auth::guard('api')->user()->id;
        $shopId = Auth::guard('api')->user()->shop->id;
        $order->fill($request->all());
        $order->to_user_id = $userId;
        $order->shop_id = $shopId;
        if ($request->name) {
            $order->name =$request->name;
        }
        if ($request->provinceName) {
            $order->provinceName = $request->provinceName;
        }
        if ($request->cityName) {
            $order->cityName = $request->cityName;
        }
        if ($request->countyName) {
            $order->countyName = $request->countyName;
        }
        if ($request->detailInfo) {
            $order->detailInfo = $request->detailInfo;
        }
        if ($request->address) {
            $foo = explode(',', $request->address);
            $order->address = $foo[0];
            $order->cityName = $foo[2];
            $order->villageInfo = $foo[1];
            $order->latitude = $foo[3];
            $order->longitude = $foo[4];
        }
        if ($request->unit_price && $request->counts) {
            $order->total_price =  $request->unit_price * $request->counts;
        }
        if ($request->prod_id) {
            $order->prod_id =$request->prod_id;
            Prod::find($request->prod_id)->increment('likes_count');
        }
        if ($request->note_sell) {
            $order->note_sell =$request->note_sell;
        }
        if ($request->end_at) {
            $order->start_at = date("Y-m-d",strtotime("-40 day",strtotime($request->end_at)));
            $order->end_at = $request->end_at;
        }
        $success = $order->save();

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
    public function weOrderUpdate(Request $request){
        $order = Order::where('id', $request->id)->first();
        $attributes['name'] = $request->name;
        $attributes['phone'] = $request->phone;
        $attributes['unit_price'] = $request->unit_price;

        if ($request->end_at) {
            $attributes['start_at'] = date("Y-m-d",strtotime("-40 day",strtotime($request->end_at)));
            $attributes['end_at'] = $request->end_at;
        }
        if ($request->counts) {
            $attributes['counts'] = $request->counts;
        } else {
            $attributes['counts'] = '0';
        }
        if ($request->unit_price && $request->counts) {
            $attributes['total_price'] =  $request->unit_price * $request->counts;
        }
        if ($request->prod_id) {
            $attributes['prod_id'] = $request->prod_id;

            $unlikes=Prod::find($order->prod_id);
            if($unlikes['likes_count'] > 0){
                $unlikes->decrement('likes_count');
            }
            Prod::find($request->prod_id)->increment('likes_count');
        }
        if($request->is_true_location){
            $attributes['is_true_location'] = $request->is_true_location;
        }
        if ($request->provinceName) {
            $attributes['provinceName'] = $request->provinceName;
        }
        if ($request->cityName) {
            $attributes['cityName'] = $request->cityName;
        }
        if ($request->countyName) {
            $attributes['countyName'] = $request->countyName;
        }
        if ($request->detailInfo) {
            $attributes['detailInfo'] = $request->detailInfo;
            $attributes['villageInfo'] = $request->detailInfo;
        }
        if($request->provinceName){
            $attributes['address']= $request->provinceName.$request->cityName.$request->countyName;
        }
        if ($request->latitude) {
            $attributes['latitude'] = $request->latitude;
        }
        if ($request->longitude) {
            $attributes['longitude'] = $request->longitude;
        }
        if ($request->note_sell) {
            $attributes['note_sell'] =$request->note_sell;
        }
        $success = $order->update($attributes);
        if ($success) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = $order->id . '订单编辑成功';
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['msg'] = '系统繁忙，请售后再试';
            return json_encode($data);
        }
    }
    public function updateOrder(Request $request)
    {
        $order = Order::where('id', $request->id)->first();
        $attributes['name'] = $request->name;
        $attributes['phone'] = $request->phone;
        if ($request->counts) {
            $attributes['counts'] = $request->counts;
        } else {
            $attributes['counts'] = '0';
        }
        $attributes['unit_price'] = $request->unit_price;
        if ($request->unit_price && $request->counts) {
            $attributes['total_price'] =  $request->unit_price * $request->counts;
        }
        $attributes['state'] = $request->states;
        $attributes['payment'] = $request->payment;
        if ($request->tags) {
            $attributes['tag_id'] = $this->normalizeTag($request->tags)['0'];
        }
        if ($request->sendDate['0'] != null) {
            $attributes['start_at'] = substr($request->sendDate['0'], 0, 10);
            $attributes['end_at'] = substr($request->sendDate['1'], 0, 10);
        }
        if ($request->address) {
            $foo = explode(',', $request->address);
            $attributes['address'] = $foo[0];
            $attributes['cityInfo'] = $foo[2];
            $attributes['villageInfo'] = $foo[1];
            $attributes['longitude'] = $foo[3];
            $attributes['latitude'] = $foo[4];
        }
        $success = $order->update($attributes);

        if ($success) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = $order->id . '订单编辑成功';
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['msg'] = '系统繁忙，请售后再试';
            return json_encode($data);
        }
    }

    public function edit(Request $request)
    {

    }
    //苗场订单未送苗、未付款listSeller
    public function listSeller()
    {
        $userId = Auth::guard('api')->user()->id;
        $orders = Order::where('to_user_id', $userId)->where('state', '!=', '1')->where('payment', '!=', '1')->where('is_del', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        if ($orders->count()) {
            return new OrderCollection($orders);
        } else {
            $data['status'] = false;
            $data['status_code'] = '404';
            $data['msg'] = '订单为空';
            return json_encode($data);
        }
    }
    //已送苗列表listState
    public function listState()
    {
        $userId = Auth::guard('api')->user()->id;
        $orders = Order::where('to_user_id', '=', $userId)->where('state', 1)->where('is_del', '=', 'F')->orderBy('updated_at', 'desc')->paginate(9);
        if ($orders->count()) {
            return new OrderCollection($orders);
        } else {
            $data['status'] = false;
            $data['status_code'] = '404';
            $data['msg'] = '送苗订单为空';
            return json_encode($data);
        }
    }
    //已付款列表listPayment
    public function listPayment()
    {
        $userId = Auth::guard('api')->user()->id;
        $orders = Order::where('to_user_id', '=', $userId)->where('payment', 1)->where('is_del', '=', 'F')->orderBy('updated_at', 'desc')->paginate(9);
        if ($orders->count()) {
            return new OrderCollection($orders);
        } else {
            $data['status'] = false;
            $data['status_code'] = '404';
            $data['msg'] = '送苗订单为空';
            return json_encode($data);
        }
    }

    public function updatePayment(Request $request)
    {
        $order = Order::where('id', $request->id)->first();
        $attributes['state'] = '2';
        $attributes['payment'] = $request->payment;
        $attributes['payment_at'] = now();
        $success = $order->update($attributes);
        if ($success) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = $order->id . '付款状态更新成功';
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['msg'] = '系统繁忙，请售后再试';
            return json_encode($data);
        }

    }

    public function updateState(Request $request)
    {
        $order = Order::where('id', $request->id)->first();
        $attributes['state'] = $request->state;
        $attributes['state_at'] = now();
        $success = $order->update($attributes);
        if ($success) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = $order->id . '送苗状态更新成功';
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['msg'] = '系统繁忙，请售后再试';
            return json_encode($data);
        }

    }
    public function updateLocation(Request $request)
    {
        $order = Order::where('id', $request->id)->first();
        $attributes['address'] = $request->address;
//        $attributes['provinceName'] = $request->provinceName;
//        $attributes['cityName'] = $request->cityName;
//        $attributes['countyName'] = $request->countyName;
        $attributes['detailInfo'] = $request->name;
        $attributes['villageInfo'] = $request->name;
        $attributes['longitude'] = $request->longitude;
        $attributes['latitude'] = $request->latitude;
        $attributes['is_true_location'] = '0';
        $success = $order->update($attributes);
        if ($success) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = $order->id . '位置更新成功';
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['msg'] = '系统繁忙，请售后再试';
            return json_encode($data);
        }

    }
    public function buyerCreate(Request $request, Order $order)
    {
        $userId = Auth::guard('api')->user()->id;
        $order->fill($request->all());
        $order->user_id = $userId;

        $to_user_id = Shop::where('id', '=', $request->shop_id)->first();
        $order->to_user_id = $to_user_id->user_id;

        if ($request->address) {
            $foo = explode(',', $request->address);
            $order->address = $foo[0];
            $order->cityInfo = $foo[2];
            $order->villageInfo = $foo[1];
            $order->longitude = $foo[3];
            $order->latitude = $foo[4];
        }
        if ($request->nickname) {
            $order->nickname = $request->nickname;
        }
        if ($request->phoneNumber) {
            $order->phone = $request->phoneNumber;
        }
        if ($request->note_buy) {
            $order->note_buy = $request->note_buy;
        }
        $order->state = '0';
        $order->is_confirm = '0';
        $order->buyer_at = now();
        $success = $order->save();
        if ($success) {
            //短信提醒苗场"农户新建订单，请打开苗果小程序与农户取得联系，并填写订单合同。"
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

    public function sellerCreate(Request $request)
    {
        if (!$request->id) {
            $data['status'] = true;
            $data['status_code'] = '404';
            $data['msg'] = '未找到订单';
            $data['name'] = now();
            return json_encode($data);
        }
        $order = Order::where('id', $request->id)->first();
        if ($request->name) {
            $attributes['name'] = $request->name;
        }
        if ($request->counts) {
            $attributes['counts'] = $request->counts;
        }
        if ($request->unit_price) {
            $attributes['unit_price'] = $request->unit_price;
        }
        if ($request->unit_price && $request->counts) {
            $attributes['total_price'] =  $request->unit_price * $request->counts;
        }
        if ($request->tag_id) {
            $attributes['tag_id'] = $request->get('tag_id');
        }
        if ($request->start_at) {
            $attributes['start_at'] = $request->start_at;
        }
        if ($request->end_at) {
            $attributes['end_at'] = $request->end_at;
        }
        if ($request->state) {
            $attributes['state'] = $request->state;
            $attributes['state_at'] = now();
        }
        if ($request->payment) {
            $attributes['payment'] = $request->payment;
            $attributes['payment_at'] = now();
        }
        if ($request->note_sell) {
            $attributes['note_sell'] = $request->note_sell;
        }
        $attributes['state'] = '0';
        $attributes['is_confirm'] = '1';
        $attributes['seller_at'] = now();
        $success = $order->update($attributes);

        if ($success) {
            //短信提醒农户"您订购的**株**苗子，订单合同已拟定，请打开苗果小程序确认订单合同。"
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = '苗厂订单编辑成功';
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '501';
            $data['msg'] = '系统繁忙，请稍后再试';
            return json_encode($data);
        }
    }
    public function buyerConfirm(Request $request)
    {
        $order = Order::where('id', $request->id)->first();
        if ($request->note_buy) {
            $attributes['note_buy'] = $request->note_buy;
        }
        $attributes['is_confirm'] = '2';
        $attributes['buyer_confirm_at'] = now();
        $success = $order->update($attributes);
        if ($success) {
            //短信提醒苗厂"农户已确认订单合同，请于**日期提供**种苗。"
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = $order->id . ' 农户确认订单成功';
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['msg'] = '系统繁忙，请售后再试';
            return json_encode($data);
        }

    }
    public function sellerTransport(Request $request)
    {
        if (!$request->id) {
            $data['status'] = true;
            $data['status_code'] = '404';
            $data['msg'] = '未找到订单';
            $data['name'] = now();
            return json_encode($data);
        }
        $order = Order::where('id', $request->id)->first();

        $attributes['state'] = '1';

        $success = $order->update($attributes);
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

    public function destroy($id)
    {
        $order = Order::where('id', $id)->first();
        $attributes['is_del'] = 'T';
        $attributes['deleted_at'] = now();
        $success = $order->update($attributes);
        if ($success) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = '取消成功';
            $data['order'] = $order;
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['msg'] = '系统繁忙，请售后再试';
            return json_encode($data);
        }
    }
    public function weDestroy(Request $request)
    {
        $id= $request->id;
        $order = Order::where('id', $id)->first();
        $attributes['is_del'] = 'T';
        $attributes['deleted_at'] = now();
        $success = $order->update($attributes);
        if ($success) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = '取消成功';
            $data['order'] = $order;
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['msg'] = '系统繁忙，请售后再试';
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
