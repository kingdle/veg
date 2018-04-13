<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::with('shop')->paginate(5);
        return new UserCollection($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        return new \App\Http\Resources\User($user);
    }


//    public function store(Request $request)
//    {
//        if (!$request->get('phone') or !$request->get('password')) {
//            return [
//                'status' => 'error',
//                'status_code' => '404',
//                'message' => '请重新输入手机号'
//            ];
//        }
//        User::create([
//            'phone' => $request->phone,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//        ]);
//        return response()->json(['status' => true]);
//    }
    public function update()
    {
        request()->user()->update(request()->only('name'));
        return response()->json(['status' => true]);
    }
}
