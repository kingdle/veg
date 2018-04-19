<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Resources\DynamicCollection;
use App\Dynamic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DynamicsController extends Controller
{
    public function index()
    {
        $dynamics = Dynamic::with('user')->paginate(5);
        return new DynamicCollection($dynamics);
    }

    public function show($shop_id)
    {
        $dynamics = Dynamic::where('shop_id', $shop_id)->paginate(5);
        if ($dynamics) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return \App\Http\Resources\Dynamic($dynamics);
    }

    public function store(Request $request, Dynamic $dynamic)
    {
        $content = $request->dynamic;
        $userid = Auth::guard('api')->user()->id;
        $shopid = Auth::guard('api')->user()->shop->id;

        $img = $request->images;
        $filePath = [];
        if ($img) {
            foreach ($img as $key => $value) {
                $img = json_encode($value);
                $start = strpos($img, ',');
                $img = substr($img, $start + 1);
                $data = base64_decode($img);
                $destinationPath = './images/dynamics/';
                $sqlPath = '/images/dynamics/';
                $fileName = $userid . date('YmdHis') . uniqid() . '.jpg';
                $success = file_put_contents($destinationPath . $fileName, $data);
                $filePath[] = $sqlPath . $fileName;
                $data = array();
                Album::create(['user_id' => $userid, 'shop_id' => $shopid, 'pic' => json_encode($sqlPath . $fileName)]);
            }
        }

        $dynamic->user_id = $userid;
        $dynamic->shop_id = $shopid;
        $dynamic->content = $content;
        $dynamic->pic = json_encode($filePath);
        $dynamic->save();

        if ($success) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = '动态发布成功';
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '501';
            $data['msg'] = '系统繁忙，请售后再试';
            return json_encode($data);
        }
//         这是postman多图上传的存储方式
//        $file = $request->file('images');
//        $filePath = [];
//        if($file){
//            foreach ($file as $key => $value) {
//                if (!$value->isValid()) {
//                    return $this->response->errorNotFound('图片上传失败，请重试');
//                }
//                if (!empty($value)) {
//                    $allowed_extensions = ["png", "jpg", "jpeg", "gif"];
//                    if ($value->getClientOriginalExtension() && !in_array($value->getClientOriginalExtension(), $allowed_extensions)) {
//                        return $this->response->errorNotFound('您只能上传PNG、JPG或GIF格式的图片！');
//                    }
//                    $destinationPath = '/uploads/images/project/' . date("Ym", time()) . '/' . date("d", time());
//                    $extension = $value->getClientOriginalExtension();
//                    $fileName = date('YmdHis') . mt_rand(100, 999) . '.' . $extension;
//                    $value->move(public_path() . $destinationPath, $fileName);
//                    $filePath[] = $destinationPath . '/' . $fileName;
//
//                }
//            }
//        }
//        $news->images = json_encode($filePath);
    }
}
