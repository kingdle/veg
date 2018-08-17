<?php

namespace App\Http\Controllers;
use App\Answer;
use App\Dynamic;
use App\Http\Resources\AnswerCollection;
use Auth;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function index(){
        $answers = Answer::with('dynamic')->orderBy('id', 'desc')->get();
        return new AnswerCollection($answers);
    }
    public function store(Request $request){
        Answer::create([
            'dynamic_id'=>$request->dynamic_id,
            'user_id'=>$request->user_id,
            'body'=>$request->body
        ]);
        Dynamic::find($request->dynamic_id)->increment('answers_count');
        return response()->json([
            'status' => false,
            'status_code' => '200',
            'message'=>'回复成功'
        ]);
    }
}
