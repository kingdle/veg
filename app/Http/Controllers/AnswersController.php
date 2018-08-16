<?php

namespace App\Http\Controllers;
use App\Answer;
use App\Dynamic;
use Auth;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
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
