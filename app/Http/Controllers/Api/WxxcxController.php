<?php

namespace App\Http\Controllers\Api;

use App\Shop;
use App\User;
use Illuminate\Support\Facades\Storage;
use Iwanli\Wxxcx\Wxxcx;
use Illuminate\Http\Request;
use Auth;

class WxxcxController extends Controller
{
    protected $wxxcx;

    function __construct(Wxxcx $wxxcx)
    {
        $this->wxxcx = $wxxcx;
    }

    /**
     * 小程序登录获取用户信息
     *
     * @author 晚黎
     * @date   2017-05-27T14:37:08+0800
     * @return [type]                   [description]
     */
    public function getWxUserInfo()
    {

//        $weixinSessionKey = Auth::guard('api')->user()->weixin_session_key;
        //code 在小程序端使用 wx.login 获取
        $code = request('code', '');
        //encryptedData 和 iv 在小程序端使用 wx.getUserInfo 获取
        $encryptedData = request('encryptedData', '');
        $iv = request('iv', '');


        //根据 code 获取用户 session_key 等信息, 返回用户openid 和 session_key
        $userInfo = $this->wxxcx->getLoginInfo($code);

        //获取解密后的用户信息
        $wxinfo=$this->wxxcx->getUserInfo($encryptedData, $iv);

//        $userid = Auth::guard('api')->user()->id;
//        $user = User::find($userid);
//        $attributes['phone'] = $wxinfo['phoneNumber'];
//        // 更新用户数据
//        $user->update($attributes);

        return $wxinfo;
    }
    public function get_access_token(){
        $url =  config('wxxcx.qrcode_url');
        return $data = $this->curl_get($url);
    }

    //获得二维码
    public function getQrcode() {
//        header('content-type:image/gif');
        header('content-type:image/png');//格式自选，不同格式貌似加载速度略有不同，想加载更快可选择jpg
        //header('content-type:image/jpg');
        $shopId = Auth::guard('api')->user()->shop->id;
        $access = json_decode($this->get_access_token(),true);
        $access_token= $access['access_token'];
        $url = config('wxxcx.getwxacodeunlimit_url') . $access_token;
        $data='{"width":"430","auto_color":true,"path":"pages/detail/detail?id='.$shopId.'"}';
        $da = $this->api_notice_increment($url,$data);
        if (!$da) {
            return response()->json([
                'status' => 'false',
                'message' => '二维码生成失败',
            ], 403);
        }
        $filename = 'qrcode/'.$shopId.'MG'.uniqid().'.png';
        Storage::disk('upyun')->write($filename, $da);
        $shopCode=config('filesystems.disks.upyun.protocol').'://'.config('filesystems.disks.upyun.domain').'/'.$filename;

        $shop=Shop::find($shopId);
        $attributes['code'] = $shopCode;
        $shop->update($attributes);

        return response()->json([
            'status' => 'true',
            'message' => '小程序码生成成功',
            'code'=>$shopCode
        ], 200);
        //这里强调显示二维码可以直接写该访问路径，同时也可以使用curl保存到本地，详细用法可以加群或者加我扣扣
    }
    function api_notice_increment($url, $data){
        $ch = curl_init();
        $header = "Accept-Charset: utf-8";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        //     var_dump($tmpInfo);
        //    exit;
        if (curl_errno($ch)) {
            return false;
        }else{
            // var_dump($tmpInfo);
            return $tmpInfo;
        }
    }

    public function curl_get($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $data;
    }
}
