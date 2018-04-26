<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\User;
use App\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\Api\WeappAuthorizationRequest;

class AuthorizationsController extends Controller
{
    public function weappRegister(WeappAuthorizationRequest $request)
    {
        $code = $request->code;

        // 根据 code 获取微信 openid 和 session_key
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);

        // 如果结果错误，说明 code 已过期或不正确，返回 401 错误
        if (isset($data['errcode'])) {
            return response()->json([
                'status' => 'false',
                'message' => 'code已过期或不正确',
            ], 401);
        }

        //找到 openid 对应的用户
        $user = User::where('weapp_openid', $data['openid'])->first();
        //把session_key
        $attributes['weixin_session_key'] = $data['session_key'];

        // 未找到对应用户则新建用户
        if (!$user) {
            // 如果未提交用户名密码，403 错误提示
            $title = $request->title;
            $phone = $request->phone;
            $avatar = $request->avatar;


            $is_phone = User::where('phone', $phone)->first();
            if ($is_phone) {
                return response()->json([
                    'status' => 'false',
                    'message' => '手机号已存在',
                ], 403);
            }
            $is_shop = Shop::where('title', $title)->first();
            if ($is_shop) {
                return response()->json([
                    'status' => 'false',
                    'message' => '店铺名不能重复',
                ], 403);
            }
            User::create([
                'weapp_openid' => $data['openid'],
                'weixin_session_key' => $data['session_key'],
                'phone' => $phone,
                'avatar_url' => $avatar,
            ]);
            $userid = User::where('phone', $phone)->first()->id;
            $summary = $request->summary;
            $address = $request->address;
            $longitude = $request->longitude;
            $latitude = $request->latitude;
            Shop::create([
                'user_id' => $userid,
                'title' => $title,
                'summary' => $summary,
                'avatar' => $avatar,
                'address' => $address,
                'longitude' => $longitude,
                'latitude' => $latitude,
            ]);

            // 获取对应的用户
            $user = User::where('weapp_openid',$data['openid'])->first();
            $attributes['weapp_openid'] = $data['openid'];
        }

        // 更新用户数据
        $user->update($attributes);

        // 为对应用户创建 JWT
        // $token = Auth::guard('api')->fromUser($user);

        // 直接创建token并设置有效期
        $createToken = $user->createToken($user->weapp_openid);
        $createToken->token->expires_at = Carbon::now()->addDays(15);
        $createToken->token->save();
        $token = $createToken->accessToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => "Bearer",
            'expires_in' => '21600',
        ], 200);

//        return response()->respondWithToken($token)->setStatusCode(201);
    }

    public function update()
    {
        $token = Auth::guard('api')->refresh();
        return $this->respondWithToken($token);
    }

    public function destroy()
    {
        Auth::guard('api')->logout();
        return $this->response->noContent();
    }

    protected function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }
}
