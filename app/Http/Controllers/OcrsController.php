<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OcrsController extends Controller
{
    public function upload(Request $request){
        $file=$request->file('file');
        // 获取文件相关信息
        $ext = $file->getClientOriginalExtension();     // 扩展名
        $realPath = $file->getRealPath();   //临时文件的绝对路径

        // 上传文件
        $filename = 'ocrs/' . 'MG' . uniqid() . '.' . $ext;
        Storage::disk('upyun')->writeStream($filename, fopen($realPath, 'r'));
        $filePath = config('filesystems.disks.upyun.protocol') . '://' . config('filesystems.disks.upyun.domain') . '/' . $filename;
        return $this->ocr($filePath);
    }
    public function imgUrl(Request $request){
        return $this->ocr($request->imgUrl);
    }
    public function ocr($filePath){
        $host = "https://wordimg.market.alicloudapi.com";
        $path = "/word";
        $method = "POST";
        $appcode = env('OCR_CODE', '');
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        //根据API的要求，定义相对应的Content-Type
        array_push($headers, "Content-Type".":"."application/x-www-form-urlencoded; charset=UTF-8");
        $querys = "";
        $bodys = "image=".$filePath;
        //或者base64
        //$bodys = "image=data:image/jpeg;base64,/9j/4A......";
        $url = $host . $path;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
        $out_put = curl_exec($curl);
        return $out_put;
    }
    public function object_to_array($obj) {
        $obj = (array)$obj;
        foreach ($obj as $k => $v) {
            if (gettype($v) == 'resource') {
                return;
            }
            if (gettype($v) == 'object' || gettype($v) == 'array') {
                $obj[$k] = (array)object_to_array($v);
            }
        }

        return $obj;
    }
}
