<?php

namespace App\Http\Controllers\bigcode;

use App\BigUser;
use App\Config;
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
//        $code = $request->code;
//        // 根据 code 获取微信 openid 和 session_key
//        $appid = "wx0990a74fd2d3f8ef";
//        $appsecret = "25c552f0bc87ec60740fa52105e9f3b0";
//
//        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".
//            $appsecret."&code=".$code."&grant_type=authorization_code";
//        $weixin=file_get_contents($url);//通过code换取网页授权access_token
//        $jsondecode=json_decode($weixin); //对JSON格式的字符串进行编码
//        $array = get_object_vars($jsondecode);//转换成数组
//        return $array;
//        $weappOpenid =  $array['openid'];//输出openid
//        $weixinSessionKey = $array['session_key'];
        $nickname = $request->nickname;
        $avatar = $request->avatar;
        $country = $request->country;
        $province = $request->province;
        $city = $request->city;
        $gender = $request->gender;
        //找到 openid 对应的用户
        $user = BigUser::where('nickname', $nickname)->first();
        //把session_key
//        $attributes['weixin_session_key'] = $weixinSessionKey;

//        if($nickname){
//            $attributes['nickname'] = $nickname;
//        }
        if (!$user) {
            BigUser::create([
//                'weapp_openid' => $weappOpenid,
//                'weixin_session_key' => $weixinSessionKey,
                'avatar' => $avatar,
                'nickname' => $nickname,
                'country' => $country,
                'province' => $province,
                'city' => $city,
                'gender' => $gender,
            ]);
            // 获取对应的用户
            $user = BigUser::where('nickname', $nickname)->first();
//            $attributes['weapp_openid'] = $weappOpenid;
        }
        // 更新用户数据
//        $user->update($attributes);
        // 直接创建token并设置有效期
//        $createToken = $user->createToken($user->id);
//        $createToken->token->expires_at = Carbon::now()->addDays(15);
//        $createToken->token->save();
//        $token = $createToken->accessToken;

        return response()->json([
//            'access_token' => $token,
//            'token_type' => "Bearer",
//            'expires_in' => '21600',
            'data'=>$user
        ], 200);
    }
    public function shopEdit(Request $request)
    {
        $config = Config::find('5');
        if($request->title){
            $attributes['title'] = $request->title;
        }
        if($request->slogan){
            $attributes['slogan'] = $request->slogan;
        }
        if($request->newsTitle){
            $attributes['newsTitle'] = $request->newsTitle;
        }
        if($request->newsSlogan){
            $attributes['newsSlogan'] = $request->newsSlogan;
        }
        if($request->notice){
            $attributes['notice'] = $request->notice;
        }
        if($request->admission){
            $attributes['admission'] = $request->admission;
        }
        if($request->header_circular){
            $attributes['header_circular'] = $request->header_circular;
        }
        if($request->shop_indicator_dots){
            $attributes['shop_indicator_dots'] = $request->shop_indicator_dots;
        }
        $attributes['updated_at'] = now();
        $success = $config->update($attributes);
        if ($success) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = $config->id . '更新成功';
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['msg'] = '系统繁忙，请售后再试';
            return json_encode($data);
        }
    }
}
