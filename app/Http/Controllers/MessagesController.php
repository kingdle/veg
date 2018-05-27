<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageCollection;
use App\Message;
use Auth;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index()
    {
        $messages = Message::with('shop')->orderBy('id', 'desc')->paginate(9);
        return new MessageCollection($messages);
    }

    public function show($id)
    {
        $messages = Message::find($id);
        if (!$messages) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new MessageCollection($messages);
    }
    public function store(Request $request,Message $message){
        $message->fill($request->all());
        $message->user_id = Auth::guard('api')->user()->id;
        $message->content =$request->messageContent;
        $message->save();
        return response()->json([
            'status' => 'true',
            'status_code' => 200,
            'message' => '留言成功',
            'messageContent' =>$request->messageContent
        ]);
    }
}
