<?php

namespace App\Http\Controllers\Api;

use App\Album;
use App\Dynamic;
use App\Http\Resources\DynamicCollection;
use App\Shop;
use App\Sort;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DynamicsController extends Controller
{
    public function weIndex(Request $request)
    {
        $sortId = $request->sortId;

        if ($sortId) {
            $parent = Sort::find($sortId);
            $parentId = $parent->parent_id;
            if ($parentId != '0') {
                $dynamics = Dynamic::with('sorts')->join('dynamic_sort', 'dynamics.id', '=', 'dynamic_sort.dynamic_id')
                    ->where('dynamic_sort.sort_id', '=', $sortId)
                    ->select('dynamic_id')
                    ->distinct()
                    ->get();
                if ($dynamics->count() > 0) {
                    foreach ($dynamics as $dynamic) {
                        $dynamicsP[] = $dynamic->dynamic_id;
                    }
                    $dynamics = Dynamic::whereIn('id', $dynamicsP)->where('is_hidden','=','F')->orderBy('id', 'desc')
                        ->paginate(9);
                    return new DynamicCollection($dynamics);
                }
                return response()->json([
                    'status' => 'false',
                    'status_code' => 502,
                    'message' => '分类内容为空',
                ]);
            }
            if ($parentId == '0') {
                $sortIds = Sort::where('parent_id', '=', $parent->id)->select('id')->get();
                foreach ($sortIds as $sortId) {
                    $sId[] = $sortId->id;
                }
                $dss = Dynamic::join('dynamic_sort', 'dynamics.id', '=', 'dynamic_sort.dynamic_id')
                    ->whereIn('dynamic_sort.sort_id', $sId)
                    ->select('dynamic_id')
                    ->distinct()
                    ->get();
                if ($dss->count() > 0) {
                    foreach ($dss as $ds) {
                        $d[] = $ds->dynamic_id;
                    }
                    $dynamics = Dynamic::whereIn('id', $d)->where('is_hidden','=','F')->orderBy('id', 'desc')
                        ->paginate(9);
                    return new DynamicCollection($dynamics);
                }
            }
        }

        $dynamics = Dynamic::with('shop','answers')->where('is_hidden','=','F')->orderBy('id', 'desc')->paginate(9);
        return new DynamicCollection($dynamics);
    }

    public function uploadImage(Request $request, Album $album)
    {
        $file = $request->file('file');
        if($request->shopId){
            $shopId = $request->shopId;
        }else{
            $shopId = Auth::guard('api')->user()->shop->id;
        }
        if($request->userId){
            $userId = $request->userId;
        }else{
            $userId = Auth::guard('api')->user()->id;
        }

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
            $filename = 'dynamics/' . 'MG' . uniqid() . '.' . $ext;
            Storage::disk('upyun')->writeStream($filename, fopen($realPath, 'r'));
            $filePath = config('filesystems.disks.upyun.protocol') . '://' . config('filesystems.disks.upyun.domain') . '/' . $filename;
            $album->user_id = $userId;
            $album->shop_id = $shopId;
            $album->pic = json_encode($filePath);
            $album->save();
            Shop::where('id', $shopId)->increment('pic_count');//图片数加1
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

    public function weCreate(Request $request, Dynamic $dynamic)
    {
        $imageUrl = $request->imageUrl;
        $userId = Auth::guard('api')->user()->id;
        $shopId = Auth::guard('api')->user()->shop->id;
        if($request->dynamicContent){
            $content = $request->dynamicContent;
        }else{
            $content = '';
        }

        $dynamic->user_id = $userId;
        $dynamic->shop_id = $shopId;
        $dynamic->content = $content;
        $dynamic->pic = json_encode($imageUrl);
        $success = $dynamic->save();
        if ($request->get('tags')) {
            $tags = $this->normalizeTag($request->get('tags'));
            $dynamic->tags()->attach($tags);
        }
        if ($request->get('sorts')) {
            $sorts = $this->normalizeSort($request->get('sorts'));
            $dynamic->sorts()->attach($sorts);
        }

        if ($success) {
            Shop::where('id', $shopId)->increment('dynamic_count');//动态数加1
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

    public function upFile(Request $request, Album $album)
    {
        if (!$request->hasFile('file')) {
            return response()->json([], 500, '无法获取上传文件');
        }
        $file = $request->file('file');
        $userId = Auth::guard('api')->user()->id;
        $shopId = Auth::guard('api')->user()->shop->id;
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
                'status_code' => 200,
                'message' => 'success',
                'photo' => $filePath,
                'name' => $originalName,
            ]);

        } else {
            return response()->json([], 500, '文件未通过验证');
        }
    }
    public function adminCreate(Request $request, Dynamic $dynamic)
    {
        if($request->shopId){
            $shopId = $request->shopId;
        }else{
            $shopId = Auth::guard('api')->user()->shop->id;
        }
        if($request->userId){
            $userId = $request->userId;
        }else{
            $userId = Auth::guard('api')->user()->id;
        }
        if($request->dynamicContent){
            $content = $request->dynamicContent;
        }else{
            $content = '';
        }
        if($request->imageUrl){
            $imageUrl = json_encode($request->imageUrl);
        }else{
            $imageUrl = '';
        }
        if($request->videoUrl){
            $video = json_encode($request->videoUrl);
        }else{
            $video = '';
        }
        if($request->video_thumbnail){
            $video_thumbnail = json_encode($request->video_thumbnail);
        }else{
            $video_thumbnail = '';
        }
        $dynamic->user_id = $userId;
        $dynamic->shop_id = $shopId;
        $dynamic->content = $content;
        $dynamic->pic = json_encode($imageUrl);
        $dynamic->video = $video;
        $dynamic->video_thumbnail = $video_thumbnail;

        $success = $dynamic->save();
        if ($request->get('tags')) {
            $tags = $this->normalizeTag($request->get('tags'));
            $dynamic->tags()->attach($tags);
        }
        if ($request->get('sorts')) {
            $sorts = $this->normalizeSort($request->get('sorts'));
            $dynamic->sorts()->attach($sorts);
        }

        if ($success) {
            Shop::where('id', $shopId)->increment('dynamic_count');//动态数加1
            User::where('id', $userId)->increment('likes_count');//点赞数加1
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
    private function normalizeTag(array $tags)
    {
        $ids = Tag::pluck('id');

        $ids = collect($tags)->map(function ($tag) use ($ids) {
            if (is_numeric($tag) && $ids->contains($tag)) {
                return (int)$tag;
            }

            return Tag::firstOrCreate(['name' => $tag])->id;
        })->toArray();

        Tag::whereIn('id', $ids)->increment('dynamics_count');
        return $ids;
    }

    private function normalizeSort(array $sorts)
    {
        $so = Sort::pluck('id');

        $so = collect($sorts)->map(function ($sort) use ($so) {
            if (is_numeric($sort) && $so->contains($sort)) {
                return (int)$sort;
            }

            return Sort::firstOrCreate(['name' => $sort])->id;
        })->toArray();

        Sort::whereIn('id', $so)->increment('hot');
        return $so;
    }
}
