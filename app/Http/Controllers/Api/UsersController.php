<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserCollection;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::with('shop')->orderBy('id', 'desc')->paginate(9);
        return new UserCollection($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new \App\Http\Resources\User($user);
    }

    public function weUpdate(Request $request)
    {
        $userid = request()->user()->id;
        $user = User::find($userid);
        $attributes['phone'] = $request->phoneNumber;
        // 更新用户数据
        $user->update($attributes);
        return response()->json([
            'status' => 'true',
            'status_code' => 200,
            'message' => '手机更新成功',
            'data' => $user
        ]);
//
//        return response()->json([
//            'status' => 'false',
//            'status_code' => 404,
//            'message' => '号码已存在',
//        ]);

    }
}
