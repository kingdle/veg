<?php

namespace App\Http\Controllers\bigcode;

use App\BigAlbum;
use App\BigDynamic;
use App\Http\Resources\bigDynamicCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Storage;

class dynamicsController extends Controller
{
    public function index()
    {
        $dynamics = BigDynamic::where('is_hidden','F')->orderBy('published_at', 'desc')->paginate(9);
        return new bigDynamicCollection($dynamics);
    }

    public function show($id)
    {
        $dynamics = BigDynamic::find($id)->get();
        if ($dynamics->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return $dynamics;
    }
    public function weCreate(Request $request, BigDynamic $dynamic)
    {
//        $dynamic->user_id = Auth::guard('api')->user()->id;
        $dynamic->title =$request->title;
        $dynamic->content = $request->contents;
        $dynamic->price = $request->price;
        $dynamic->counts = $request->counts;
        $dynamic->pic = json_encode($request->pics);
        $success = $dynamic->save();
        if ($success) {
            return response()->json([
                'status' => 'true',
                'status_code' => 200,
                'message' => '动态发布成功'.date("h:i:s"),
            ]);
        } else {
            return response()->json([
                'status' => 'false',
                'status_code' => 501,
                'message' => '服务器端错误'.date("h:i:s"),
            ]);
        }
    }
    public function uploadImage(Request $request, BigAlbum $album)
    {
        $file = $request->file('file');
//        if($request->userId){
//            $userId = $request->userId;
//        }else{
//            $userId = Auth::guard('api')->user()->id;
//        }
        if (!$request->hasFile('file')) {
            return response()->json([
                'status' => 'false',
                'status_code' => 404,
                'message' => '未获取到图片，上传失败',
            ]);
        }
        if ($file->isValid()) {
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg

            // 上传文件
            $filename = 'Bigcode/orders/' . 'BC' . uniqid() . '.' . $ext;
            Storage::disk('upyun')->writeStream($filename, fopen($realPath, 'r'));
            $filePath = config('filesystems.disks.upyun.protocol') . '://' . config('filesystems.disks.upyun.domain') . '/' . $filename;
//            $album->user_id = $userId;
            $album->pic = json_encode($filePath);
            $album->save();
            return response()->json([
                'status' => 'true',
                'status_code' => 200,
                'message' => '上传成功',
                'url' => $filePath,
                'name' => $originalName,
            ]);
        } else {
            return response()->json([
                'status' => 'false',
                'status_code' => 500,
                'message' => '服务器端错误，请重新上传',
            ]);
        }
    }
    public function destroy($id)
    {
        $dynamic = BigDynamic::where('id', $id)->first();
        $attributes['is_hidden'] = 'T';
        $attributes['updated_at'] = now();
        $success = $dynamic->update($attributes);
        if ($success) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = '删除成功';
            $data['dynamic'] = $dynamic;
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['msg'] = '系统繁忙，请售后再试';
            return json_encode($data);
        }
    }

}
