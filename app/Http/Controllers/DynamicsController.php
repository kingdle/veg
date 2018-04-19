<?php

namespace App\Http\Controllers;

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
        if ($dynamics->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return $dynamics;
    }
    public function store(Request $request,Dynamic $dynamic)
    {
        $file = $request->images;
        $base64 = preg_replace("/\s/",'+',$file);
        $img = base64_decode($base64);
        return $img;
        $filePath = [];
        if($file){
            foreach ($file as $key => $value) {
                if (!empty($value)) {
                    $allowed_extensions = ["png", "jpg", "jpeg", "gif"];
                    if ($value->getClientOriginalExtension() && !in_array($value->getClientOriginalExtension(), $allowed_extensions)) {
                        return $this->response->errorNotFound('您只能上传PNG、JPG或GIF格式的图片！');
                    }
                    $destinationPath = '/uploads/images/dynamics/' . date("Ym", time()) . '/' . date("d", time());
                    $extension = $value->getClientOriginalExtension();
                    $fileName = date('YmdHis') . mt_rand(100, 999) . '.' . $extension;
                    $value->move(public_path() . $destinationPath, $fileName);
                    $filePath[] = $destinationPath . '/' . $fileName;

                }
            }
        }

        $news->images = json_encode($filePath);
        return $news->images;

        $content = $request->dynamic;
        $userid = Auth::guard('api')->user()->id;
        $shopid = $userid = Auth::guard('api')->user()->shop->id;
        $img = $request->images;
        $destinationPath = null;
        if($request->has('images')){
            $destinationPath = public_path() . '/uploads/sent/uploaded' . time() . '.jpg';
            $base64 = $request->get('images');

            file_put_contents($destinationPath, base64_decode($base64));
        }

        $filePath = [];


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
//
//        $news->images = json_encode($filePath);






        $dynamic->user_id = $userid;
        $dynamic->content = $content;
        $dynamic->pic = json_encode($filePath);
        $dynamic->save();
        return ['status' => true,'status_code'=>'200','msg'=>'动态发布成功'];
    }
    public function upload(){
        define('UPLOAD_DIR', './images/');
        $img = $_POST['image'];
        $start=strpos($img,',');
        $img= substr($img,$start+1);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $fileName = UPLOAD_DIR . uniqid() . '.jpg';
        $success = file_put_contents($fileName, $data);
        $data=array();
        if($success){
            $data['status']=1;
            $data['msg']='上传成功';
            echo json_encode($data);
        }else{
            $data['status']=0;
            $data['msg']='系统繁忙，请售后再试';
            echo json_encode($data);
        }
    }
}
