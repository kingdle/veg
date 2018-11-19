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
    public function myAnswers(Request $request){
        $answers=Answer::where('user_id',$request->userId)->orwhere('to_user_id',$request->userId)->where('is_hidden', '=','F')->get(array('dynamic_id'));
        foreach ($answers as $value){
            $dynamic_ids[]= $value->dynamic_id;
        }
        $dynamic_ids = array_flip($dynamic_ids);
        $dynamic_ids = array_keys($dynamic_ids);
        $dynamics= Dynamic::with('shop','answers','followers','tags')->whereIn("id",$dynamic_ids)->where("is_hidden",'!=','T')->orderBy('updated_at', 'desc')->paginate(9);
        return new DynamicCollection($dynamics);
    }
    public function store(Request $request){
        Answer::create([
            'dynamic_id'=>$request->dynamic_id,
            'to_user_id'=>$request->to_user_id,
            'user_id'=>$request->user_id,
            'body'=>$request->body
        ]);
        $dynamic=Dynamic::find($request->dynamic_id);
        $dynamic->increment('answers_count');
//        $data['id'] = $dynamic->id;
//        $data['user_id'] = $dynamic->user_id;
//        $data['shop_id'] = $dynamic->shop_id;
//        $data['shop'] = Shop::find($dynamic->shop_id);
//        $data['tags'] = $dynamic->updated_at;
//        $data['content'] = $dynamic->content;
//        $data['pic'] = $dynamic->pic;
//        $data['comments_count'] = $dynamic->comments_count;
//        $data['followers_count'] = $dynamic->followers_count;
//        $data['answers_count'] = $dynamic->answers_count;
//        $data['close_comment'] = $dynamic->close_comment;
//        $data['is_hidden'] = $dynamic->is_hidden;
//        $data['published_at'] = $dynamic->published_at;
//        $data['created_at'] = $dynamic->created_at;
//        $data['updated_at'] = $dynamic->updated_at;
        $dynamics = Dynamic::with('shop','answers')->where('id','=',$request->dynamic_id)->get();
        $dy= new DynamicCollection($dynamics);
        return response()->json([
            'status' => false,
            'status_code' => '200',
            'message'=>'回复成功',
            'data'=>$dy
        ]);
    }
    public function updateIsRead(Request $request){
        $userid = Auth::guard('api')->user()->id;
        $answer = Answer::where('to_user_id',$userid)->where('is_read','')->update(['is_read' => 'T','read_at'=>now()]);
        return response()->json([
            'data'=>$answer
        ], 200);
    }
}
