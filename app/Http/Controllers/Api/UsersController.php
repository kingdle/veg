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
    public function userPasswordUpdate(Request $request)
    {
        $userid = request()->user()->id;
        if(!$userid){
            return response()->json([
                'status' => 'false',
                'status_code' => 404,
                'message' => '密码更新失败',
            ]);
        }
        $user = User::find($userid);
        if ($user->is_active == '1') {
            $attributes['password'] = Hash::make($request->password);
            // 更新用户数据
            $user->update($attributes);
            return response()->json([
                'status' => 'true',
                'status_code' => 200,
                'message' => '密码更新成功',
            ]);
        }
        if ($user->is_active == '0') {
            return response()->json([
                'status'=>'false',
                'status_code' => 404,
                'message' => '仅苗厂可修改PC端密码',
            ]);
        }
    }
    public function userPasswordUpdateAdmin(Request $request)
    {
        $userid = request()->user()->id;
        $user = User::find($userid);
        if ($user->is_admin == '1') {
            $userUpdate = User::find($request->id);
            $attributes['password'] = Hash::make($request->password);
            // 更新用户数据
            $userUpdate->update($attributes);
            return response()->json([
                'status' => 'true',
                'status_code' => 200,
                'message' => '密码更新成功',
                'data'=>$userUpdate
            ]);
        }
        if ($user->is_admin == '0') {
            return response()->json([
                'status'=>'false',
                'status_code' => 404,
                'message' => '没有权限',
            ]);
        }
    }
}
