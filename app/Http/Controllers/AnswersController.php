<?php

namespace App\Http\Controllers;
use App\Answer;
use App\Dynamic;
use App\Http\Resources\AnswerCollection;
use App\Http\Resources\DynamicCollection;
use App\Shop;
use Auth;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function index(){
        $answers = Answer::with('dynamic')->with('user')->orderBy('id', 'desc')->get();
        return new AnswerCollection($answers);
    }
    public function store(Request $request){
        Answer::create([
            'dynamic_id'=>$request->dynamic_id,
            'user_id'=>$request->user_id,
            'body'=>$request->body
        ]);
        $dynamic=Dynamic::find($request->dynamic_id);
        $dynamic->increment('answers_count');
        $data['id'] = $dynamic->id;
        $data['user_id'] = $dynamic->user_id;
        $data['shop_id'] = $dynamic->shop_id;
        $data['shop'] = Shop::find($dynamic->shop_id);
        $data['content'] = $dynamic->content;
        $data['pic'] = $dynamic->pic;
        $data['comments_count'] = $dynamic->comments_count;
        $data['followers_count'] = $dynamic->followers_count;
        $data['answers_count'] = $dynamic->answers_count;
        $data['close_comment'] = $dynamic->close_comment;
        $data['is_hidden'] = $dynamic->is_hidden;
        $data['published_at'] = $dynamic->published_at;
        $data['created_at'] = $dynamic->created_at;
        $data['updated_at'] = $dynamic->updated_at;
        return response()->json([
            'status' => false,
            'status_code' => '200',
            'message'=>'回复成功',
            'data'=>$data
        ]);
    }
}
