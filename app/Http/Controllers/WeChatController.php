<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class WeChatController extends Controller
{
    public function serve()
    {

        $app = app('wechat.official_account');
        $app->server->push(function($message){
            return "欢迎关注 overtrue！";
        });

        return $app->server->serve();
    }
    public function index(){
        $app = \EasyWeChat::miniProgram(); // 小程序
        $response = $app->app_code->get('/public', [
            'width' => 600,
            //...
        ]);
        $filename = $response->saveAs('/public', 'appcode.png');
        return $filename;
    }
}
