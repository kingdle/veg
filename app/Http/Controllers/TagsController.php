<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagCollection;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::select(['id','name','bio'])
            ->where('name','like','%'.$request->query('q').'%')->orderBy('dynamics_count', 'desc')->get();
        return new TagCollection($tags);
    }
    public function show($id)
    {
        $tag = Tag::find($id)->get();
        if ($tag->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new TagCollection($tag);
    }
    public function store(Request $request,Tag $tag){
        $tag->fill($request->all());
        $tag->save();
    }
    public function search(Request $request)
    {
        $tags = Tag::select(['id','name','bio'])
            ->where('name','like','%'.$request->q.'%')->orwhere('bio','like','%'.$request->q.'%')->orderBy('dynamics_count', 'desc')->get();
        return new TagCollection($tags);
    }
}
