<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class WeChatController extends Controller
{
    public function serve()
    {

        $app = app('wechat.official_account.mini_program');
        $app->server->push(function($message){
            return "欢迎关注 overtrue！";
        });

        return $app->server->serve();
    }
    public function index(){
        $app = app('wechat.mini_program.default');
        $result = $app->app_code->get('foo', 6 * 24 * 3600);
        return $result->toArray();

    }
}
