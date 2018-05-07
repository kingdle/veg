<?php

namespace App\Http\Controllers\Api;

use App\Album;
use App\Dynamic;
use App\Http\Resources\DynamicCollection;
use App\Sort;
use App\Tag;
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
                $dynamics = Dynamic::join('dynamic_sort', 'dynamics.id', '=', 'dynamic_sort.dynamic_id')
                    ->where('dynamic_sort.sort_id', '=', $sortId)
                    ->paginate(9);
                return new DynamicCollection($dynamics);
            }
            if($parentId == '0'){
                $sortIds=Sort::where('parent_id','=',$parent->id)->select('id')->get();
//                return $sortIds;

                foreach ($sortIds as $sortId){
                    $sId[]=$sortId->id;
                }
                $dynamics = Dynamic::join('dynamic_sort', 'dynamics.id', '=', 'dynamic_sort.dynamic_id')
                    ->wherein('dynamic_sort.sort_id', $sId)
                    ->paginate(9);
                return new DynamicCollection($dynamics);
            }
        }

        $dynamics = Dynamic::with('shop')->orderBy('id', 'desc')->paginate(9);
        return new DynamicCollection($dynamics);
    }

    public function uploadImage(Request $request, Album $album)
    {
        $file = $request->file('file');
        $userId = Auth::guard('api')->user()->id;
        $shopId = Auth::guard('api')->user()->shop->id;

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
        $content = $request->dynamicContent;

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
            return response()->json([
                'status' => 'true',
                'status_code' => 200,
                'message' => '动态发布成功',
            ]);
        } else {
            return response()->json([
                'status' => 'false',
                'status_code' => 501,
                'message' => '服务器端错误',
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
