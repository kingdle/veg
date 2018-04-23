<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Resources\DynamicCollection;
use App\Dynamic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DynamicsController extends Controller
{
    public function index()
    {
        $dynamics = Dynamic::with('shop')->orderBy('id', 'desc')->paginate(9);
        return new DynamicCollection($dynamics);
    }

    public function show($shop_id)
    {
        $dynamics = Dynamic::where('shop_id', $shop_id)->orderBy('id', 'desc')->paginate(9);
        if ($dynamics->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new DynamicCollection($dynamics);
    }

    public function user()
    {
        $shopid = Auth::guard('api')->user()->shop->id;
        $dynamics = Dynamic::where('shop_id', $shopid)->orderBy('id', 'desc')->paginate(9);
        if ($dynamics->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new DynamicCollection($dynamics);
    }

    public function image(Request $request, Album $album)
    {
        $file = $request->file('file');
//        $userid = Auth::guard('api')->user()->id;
//        $shopid = Auth::guard('api')->user()->shop->id;
        $userid = $request->user_id;
        $shopid = $request->shop_id;

        if (!$request->hasFile('file')) {
            return response()->json([
                'status'=>'false',
                'status_code' => 404,
                'message' => '未获取到图片，请重新上传',
            ]);
        }
        if ($file->isValid()) {
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg

            // 上传文件
            $filename = 'dynamics/' . 'MG' . uniqid() . '.' . $ext;
            Storage::disk('upyun')->writeStream($filename, fopen($realPath, 'r'));
            $filePath = config('filesystems.disks.upyun.protocol') . '://' . config('filesystems.disks.upyun.domain') . '/' . $filename;
            $album->user_id = $userid;
            $album->shop_id = $shopid;
            $album->pic = json_encode($filePath);
            $album->save();
            return response()->json([
                'status'=>'true',
                'status_code' => 200,
                'message' => '上传成功',
                'url' => $filePath,
                'name' => $originalName,
            ]);
        }else{
            return response()->json([
                'status'=>'false',
                'status_code' => 500,
                'message' => '服务器端错误，请重新上传',
            ]);
        }

    }

    public function news(Request $request, Dynamic $dynamic)
    {
        $imageurl = $request->imageurl;
        $userid = Auth::guard('api')->user()->id;
        $shopid = Auth::guard('api')->user()->shop->id;
        $content = $request->dynamicContent;

        $dynamic->user_id = $userid;
        $dynamic->shop_id = $shopid;
        $dynamic->content = $content;
        $dynamic->pic = $imageurl;
        $success = $dynamic->save();

        if ($success) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = '动态发布成功';
            $data['url'] = $filePath;
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '501';
            $data['msg'] = '系统繁忙，请售后再试';
            return json_encode($data);
        }

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
                $fileName = 'dynamics/' . 'MG' . uniqid() . '.jpg';
                Storage::disk('upyun')->write($fileName, $data);
                $filePathOne = config('filesystems.disks.upyun.protocol') . '://' . config('filesystems.disks.upyun.domain') . '/' . $fileName;
                $filePath[] = config('filesystems.disks.upyun.protocol') . '://' . config('filesystems.disks.upyun.domain') . '/' . $fileName;
//                $success = file_put_contents($destinationPath . $fileName, $data);
//                $filePath[] = $sqlPath . $fileName;
                $data = array();
                Album::create(['user_id' => $userid, 'shop_id' => $shopid, 'pic' => json_encode($filePathOne)]);
            }
        }

        $dynamic->user_id = $userid;
        $dynamic->shop_id = $shopid;
        $dynamic->content = $content;
        $dynamic->pic = json_encode($filePath);
        $success=$dynamic->save();

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

    }
}
