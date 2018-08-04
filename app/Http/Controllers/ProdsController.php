<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProdCollection;
use App\Prod;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdsController extends Controller
{
    public function index()
    {
        $shopId = Auth::guard('api')->user()->shop->id;
        $prods = Prod::where('shop_id',$shopId)->orwhere('shop_id','187')->orderBy('created_at', 'desc')->orderBy('likes_count', 'desc')->get();
        return new ProdCollection($prods);
    }
    public function prodSeller($id)
    {
//        $shopId = Auth::guard('api')->user()->shop->id;
        $prods = Prod::where('shop_id',$id)->where('title','not like','%克隆%')->where('title','not like','%代育%')->where('title','not like','%拷贝%')->orderBy('likes_count', 'desc')->paginage(6);
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
    public function uploadImage(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json([], 500, '无法获取上传文件');
        }
        $file = $request->file('file');
        if ($file->isValid()) {
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg

            // 上传文件
            $filename = 'seedling/' . 'MG' . uniqid() . '.' . $ext;
            Storage::disk('upyun')->writeStream($filename, fopen($realPath, 'r'));
            $filePath = config('filesystems.disks.upyun.protocol') . '://' . config('filesystems.disks.upyun.domain') . '/' . $filename;

            return response()->json([
                'status_code' => 200,
                'message' => 'success',
                'photo' => $filePath,
                'name' => $originalName,
            ]);

        } else {
            return response()->json([], 500, '文件未通过验证');
        }
    }
    public function createProduct(Request $request,Prod $prod)
    {
        $shopId = Auth::guard('api')->user()->shop->id;
       if($request->pic){
           $prod->pic =$request->pic;
       }
        if ($request->sort_id) {
            $prod->sort_id =$request->sort_id;
        }
        if ($request->title) {
            $prod->title =$request->title;
        }
        if ($request->introduce) {
            $prod->introduce =$request->introduce;
        }
        if ($request->unit_price) {
            $prod->unit_price =  $request->unit_price;
        }
        $prod->shop_id =$shopId;
        $is_product = Prod::where('shop_id', $shopId)->where('title', $request->title)->first();
        if ($is_product) {
            return response()->json([
                'status' => 'false',
                'status_code' => 403,
                'message' => '品种已存在',
            ], 403);
        }
        $success = $prod->save();
        if ($success) {
            return response()->json([
                'status' => 'true',
                'status_code' => 200,
                'message' => '品种添加成功',
            ]);
        } else {
            return response()->json([
                'status' => 'false',
                'status_code' => 501,
                'message' => '服务器端错误'.date("h:i:s"),
            ]);
        }

    }
}
