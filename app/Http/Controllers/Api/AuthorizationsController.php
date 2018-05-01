<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\User;
use App\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\Api\WeappAuthorizationRequest;
use Illuminate\Support\Facades\Storage;

class AuthorizationsController extends Controller
{
    public function weapplogin(Request $request)
    {
        $code = $request->code;
        // 根据 code 获取微信 openid 和 session_key
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);

        if (isset($data['errcode'])) {
            return $this->response->errorUnauthorized('code已过期或不正确');
        }
        $weappOpenid = $data['openid'];
        $weixinSessionKey = $data['session_key'];

        //找到 openid 对应的用户
        $user = User::where('weapp_openid', $weappOpenid)->first();
        //把session_key
        $attributes['weixin_session_key'] = $weixinSessionKey;
        if (!$user) {
            $nickname = $request->nickname;
            $avatar = $request->avatar;
            User::create([
                'weapp_openid' => $weappOpenid,
                'weixin_session_key' => $weixinSessionKey,
                'is_active' => 0,
                'avatar_url' => $avatar,
                'nickname' => $nickname,
            ]);
            // 获取对应的用户
            $user = User::where('weapp_openid', $weappOpenid)->first();
            $attributes['weapp_openid'] = $weappOpenid;
        }
        // 更新用户数据
        $user->update($attributes);
        // 直接创建token并设置有效期
        $createToken = $user->createToken($user->weapp_openid);
        $createToken->token->expires_at = Carbon::now()->addDays(15);
        $createToken->token->save();
        $token = $createToken->accessToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => "Bearer",
            'expires_in' => '21600',
            'is_active'=>$user->is_active
        ], 200);
    }

    public function weappShopRegister(Request $request){
        $userid = Auth::guard('api')->user()->id;
        $avatar = Auth::guard('api')->user()->avatar_url;
        if($userid){
            $title = $request->title;
            $phone = $request->phone;
            $summary = $request->summary;
            $cityInfo = $request->cityInfo;
            $address = $request->address;
            $longitude = $request->longitude;
            $latitude = $request->latitude;

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
                    'message' => '店铺名已存在',
                ], 403);
            }
            $user = User::find($userid);
            $attributes['phone'] = $phone;
            $attributes['is_active'] = '1';
            // 更新用户数据
            $user->update($attributes);

            $avatarfile = file_get_contents($avatar);
//            $file_extension = strtolower(substr(strrchr('http://veg.name/images-pc/mg-code-mp.jpg',"."),1));
            $filename = 'avatars/'.$userid.'MG'.uniqid().'.png';
            Storage::disk('upyun')->write($filename, $avatarfile);
            $shopavatar=config('filesystems.disks.upyun.protocol').'://'.config('filesystems.disks.upyun.domain').'/'.$filename;

            Shop::create([
                'user_id' => $userid,
                'title' => $title,
                'summary' => $summary,
                'avatar' => $shopavatar,
                'cityInfo' => $cityInfo,
                'address' => $address,
                'longitude' => $longitude,
                'latitude' => $latitude,
            ]);
            return response()->json([
                'status' => 'true',
                'message' => '成功入驻',
                'is_active'=>'1'
            ], 200);
        }
        return $this->response->errorUnauthorized('请重新打开苗果小程序授权后再申请入驻');
    }
    public function weappRegister(Request $request)
    {
        $code = $request->code;

        // 根据 code 获取微信 openid 和 session_key
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);

        // 如果结果错误，说明 code 已过期或不正确，返回 401 错误
        if (isset($data['errcode'])) {
            return $this->response->errorUnauthorized('code已过期或不正确');
//            return response()->json([
//                'status' => 'false',
//                'message' => 'code已过期或不正确',
//            ], 401);
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
            $nickname = $request->nickname;

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
                'nickname' => $nickname,
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
            $user = User::where('weapp_openid', $data['openid'])->first();
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
        $user = Auth::guard('api')->user();
        $createToken = $user->createToken($user->weapp_openid);

        $createToken->token->expires_at = Carbon::now()->addDays(15);
        $createToken->token->save();

        $token = $createToken->accessToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => "Bearer",
            'expires_in' => '21600',
        ]);
    }

    public function destroy()
    {
        if (Auth::guard('api')->check()) {
            Auth::guard('api')->user()->token()->revoke();

        }
        return response()->json([
            'status' => 'true',
            'message' => '退出成功',
        ], 204);
    }
}
