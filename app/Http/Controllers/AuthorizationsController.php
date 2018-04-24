<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthorizationsController extends Controller
{
    public function socialStore(Request $request,$type)
    {
        if (!in_array($type, ['weixin'])) {
            return response()->json([
                'status'=>'false',
                'status_code' => 404,
                'message' => 'errorBadRequest',
            ]);
        }

        $driver = \Socialite::driver($type);

        try {
            if ($code = $request->code) {
                $response = $driver->getAccessTokenResponse($code);
                $token = array_get($response, 'access_token');
            } else {
                $token = $request->access_token;

                if ($type == 'weixin') {
                    $driver->setOpenId($request->openid);
                }
            }

            $oauthUser = $driver->userFromToken($token);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>'false',
                'status_code' => 404,
                'message' => '参数错误，未获取用户信息',
            ]);
        }

        switch ($type) {
            case 'weixin':
                $unionid = $oauthUser->offsetExists('unionid') ? $oauthUser->offsetGet('unionid') : null;

                if ($unionid) {
                    $user = User::where('unionid', $unionid)->first();
                } else {
                    $user = User::where('openid', $oauthUser->getId())->first();
                }

                // 没有用户，默认创建一个用户
                if (!$user) {
                    $user = User::create([
                        'nickname' => $oauthUser->getNickname(),
                        'avatar_url' => $oauthUser->getAvatar(),
                        'openid' => $oauthUser->getId(),
                        'unionid' => $unionid,
                    ]);
                }

                break;
        }
        return response()->json([
            'status'=>'true',
            'status_code' => 200,
            'message' => '店铺创建成功',
            'token' => $user->id
        ]);
    }
    public function store(Request $request)
    {
        $username = $request->phone;

        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['phone'] = $username;

        $credentials['password'] = $request->password;

        if (!$token = \Auth::guard('api')->attempt($credentials)) {
            return $this->response->errorUnauthorized('用户名或密码错误');
        }

        return $this->respondWithToken($token)->setStatusCode(201);

    }
}
