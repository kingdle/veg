<?php

namespace App\Http\Controllers\bigcode;

use App\BigUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class usersController extends Controller
{
    public function https_request($url,$data = null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
    public function login(Request $request)
    {
        $code = $request->code;
        // 根据 code 获取微信 openid 和 session_key
        $appid = "wx0990a74fd2d3f8ef";
        $appsecret = "25c552f0bc87ec60740fa52105e9f3b0";
        //获取openid
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";

        $result = $this->https_request($url);

        $jsoninfo = json_decode($result, true);
return $jsoninfo;
        $weappOpenid =  $jsoninfo["openid"];
        $nickname = $request->nickname;
        $avatar = $request->avatar;
        if($request->country){
            $country = $request->country;
            $attributes['country'] = $country;
        }
        if($request->province){
            $province = $request->province;
            $attributes['province'] = $province;
        }
        if($request->city){
            $city = $request->city;
            $attributes['city'] = $city;
        }
        if($request->gender){
            $gender = $request->gender;
            $attributes['gender'] = $gender;
        }
        //找到 openid 对应的用户
        $user = BigUser::where('weapp_openid', $weappOpenid)->first();
        //把session_key
        $attributes['weixin_session_key'] = $weixinSessionKey;

        if($nickname){
            $attributes['nickname'] = $nickname;
        }
        if (!$user) {
            BigUser::create([
                'weapp_openid' => $weappOpenid,
                'weixin_session_key' => $weixinSessionKey,
                'is_active' => 0,
                'avatar_url' => $avatar,
                'nickname' => $nickname,
                'country' => $country,
                'province' => $province,
                'city' => $city,
                'gender' => $gender,
            ]);
            // 获取对应的用户
            $user = BigUser::where('weapp_openid', $weappOpenid)->first();
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
            'data'=>$user
        ], 200);
    }

}
