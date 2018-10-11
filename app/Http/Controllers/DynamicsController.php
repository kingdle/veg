<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Resources\DynamicCollection;
use App\Dynamic;
use App\Video;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
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

    public function distance(Request $request)
    {
        $dynamics = Dynamic::with('shop')->orderBy('id', 'desc')->with('tags')->paginate(9);
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
        $shopId = Auth::guard('api')->user()->shop->id;
        $dynamics = Dynamic::where('shop_id', $shopId)->orderBy('id', 'desc')->paginate(9);
        if ($dynamics->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new DynamicCollection($dynamics);


    }

    public function lists()
    {
        $shopId = Auth::guard('api')->user()->shop->id;
        $dynamics = Dynamic::where('shop_id', $shopId)->orderBy('id', 'desc')->paginate(9);
        if ($dynamics->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new DynamicCollection($dynamics);
    }

    public function image(Request $request, Album $album)
    {
        $file = $request->file('file');
//        $userId = Auth::guard('api')->user()->id;
//        $shopId = Auth::guard('api')->user()->shop->id;
        $userId = $request->user_id;
        $shopId = $request->shop_id;

        if (!$request->hasFile('file')) {
            return response()->json([
                'status' => 'false',
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
            $album->user_id = $userId;
            $album->shop_id = $shopId;
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

    public function images(Request $request, Dynamic $dynamic)
    {
        $imageurl = $request->imageurl;
//        $userId = Auth::guard('api')->user()->id;
//        $shopId = Auth::guard('api')->user()->shop->id;
        $userId = $request->user_id;
        $shopId = $request->shop_id;
        $content = $request->dynamicContent;

        $dynamic->user_id = $userId;
        $dynamic->shop_id = $shopId;
        $dynamic->content = $content;
        $dynamic->pic = $imageurl;
        $success = $dynamic->save();

        if ($success) {
            return response()->json([
                'status' => 'true',
                'status_code' => 200,
                'message' => '上传成功',
            ]);
        } else {
            return response()->json([
                'status' => 'false',
                'status_code' => 501,
                'message' => '服务器端错误',
            ]);
        }

    }

    public function store(Request $request, Dynamic $dynamic)
    {
        $content = $request->dynamic;
        $userId = Auth::guard('api')->user()->id;
        $shopId = Auth::guard('api')->user()->shop->id;

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
                Album::create(['user_id' => $userId, 'shop_id' => $shopId, 'pic' => json_encode($filePathOne)]);
            }
        }

        $dynamic->user_id = $userId;
        $dynamic->shop_id = $shopId;
        $dynamic->content = $content;
        $dynamic->pic = json_encode($filePath);
        $success = $dynamic->save();

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

    public function uploadVideo(Request $request, Video $video)
    {
        $file = $request->file('file');
        if ($request->shopId) {
            $shopId = $request->shopId;
        } else {
            $shopId = Auth::guard('api')->user()->shop->id;
        }
        if ($request->userId) {
            $userId = $request->userId;
        } else {
            $userId = Auth::guard('api')->user()->id;
        }
        if (!$request->hasFile('file')) {
            return response()->json([
                'status' => 'false',
                'status_code' => 404,
                'message' => '未获取到视频，上传失败',
            ]);
        }
        if ($file->isValid()) {
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg
            // 上传文件
            $title=$shopId . 'MG' . uniqid();
            $path='video/' . $title . '.';
            $filename = $path . $ext;
            $filethumb = $title . '.jpg';
            $filethumbnail = $path . 'jpg';
            Storage::disk('upyun')->writeStream($filename, fopen($realPath, 'r'));
            $filePath = config('filesystems.disks.upyun.protocol') . '://' . config('filesystems.disks.upyun.domain') . '/' . $filename;
            $fileThumbnailPath = config('filesystems.disks.upyun.protocol') . '://' . config('filesystems.disks.upyun.domain') . '/' . $filethumbnail;
            $ffmpeg = FFMpeg::create(array(
                'ffmpeg.binaries'  => '/usr/local/bin/ffmpeg',
                'ffprobe.binaries' => '/usr/local/bin/ffprobe',
                'timeout'          => 3600, // The timeout for the underlying process
                'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
            ), null);
            $video_jpg = $ffmpeg->open($filePath);
            $frame = $video_jpg->frame(TimeCode::fromSeconds(2));
            $frame->save($filethumb);
            $fileUrl=env('APP_URL').'/'.$filethumb;
            Storage::disk('upyun')->writeStream($filethumbnail,fopen($fileUrl, 'r'));
            Storage::delete($filethumb);


            $video->user_id = $userId;
            $video->shop_id = $shopId;
            $video->video_thumbnail = json_encode($fileThumbnailPath);
            $video->video_url = json_encode($filePath);
            $video->video_height = $request->video_height;
            $video->video_width = $request->video_width;
            $video->video_size = $request->video_size;
            $video->video_duration = $request->video_duration;
            $video->clicks_count = '1';
            $video->save();
            return $video->id;

        } else {
            return response()->json([
                'status' => 'false',
                'status_code' => 500,
                'message' => '服务器端错误，请重新上传',
            ]);
        }

    }

    public function uploadVideoThumb(Request $request)
    {
        $file = $request->file('file');
        if ($request->shopId) {
            $shopId = $request->shopId;
        } else {
            $shopId = Auth::guard('api')->user()->shop->id;
        }
        if ($request->userId) {
            $userId = $request->userId;
        } else {
            $userId = Auth::guard('api')->user()->id;
        }
        if (!$request->hasFile('file')) {
            return response()->json([
                'status' => 'false',
                'status_code' => 404,
                'message' => '未获取到视频，上传失败',
            ]);
        }
        if ($file->isValid()) {
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg

            // 上传文件
            $filename = 'video/' . $shopId . 'MG' . uniqid() . 'thumb.' . $ext;
            Storage::disk('upyun')->writeStream($filename, fopen($realPath, 'r'));
            $filePath = config('filesystems.disks.upyun.protocol') . '://' . config('filesystems.disks.upyun.domain') . '/' . $filename;

            return $filePath;
        } else {
            return response()->json([
                'status' => 'false',
                'status_code' => 500,
                'message' => '服务器端错误，请重新上传',
            ]);
        }

    }
}
