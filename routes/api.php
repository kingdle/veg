<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    $user = $request->user();
    return new \App\Http\Resources\User($user);
});
Route::middleware('auth:api')->get('/shop', function (Request $request) {
    $user = $request->user();
    $shop = \App\Shop::where('user_id', $user->id)->get();
    return $shop[0];
});

Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->middleware('auth:api');
Route::post('/token/refresh', 'Auth\LoginController@refresh');

Route::post('/user/profile/update', 'UsersController@update')->middleware('auth:api');
Route::post('/user/password/update', 'PasswordController@update')->middleware('auth:api');
Route::post('/user/shop/update', 'ShopsController@update')->middleware('auth:api');
Route::post('/user/seed/update', 'SeedsController@update')->middleware('auth:api');

//passport部分
Route::group(['prefix' => '/v1', 'middleware' => 'cors'], function () {
    //users用户查询
    Route::resource('/users', 'UsersController')->middleware('auth:api');
    //shops店铺查询
    Route::resource('/shops', 'ShopsController');
    //shop店铺新增
    Route::resource('/shop', 'ShopsController')->middleware('auth:api');
    Route::post('/shop/avatar', 'ShopsController@changeAvatar')->middleware('auth:api');
    //dynamics动态查询
    Route::resource('/dynamics', 'DynamicsController');
    //dynamics新增动态
    Route::get('/dynamics-user', 'DynamicsController@user')->middleware('auth:api');
    Route::post('/news/images', 'DynamicsController@images')->middleware('auth:api');
    Route::post('/news/image', 'DynamicsController@image')->middleware('auth:api');
    //albums相册查询
    Route::resource('/albums', 'AlbumsController')->middleware('auth:api');
    //sorts分类查询
    Route::resource('/sorts', 'SortsController')->middleware('auth:api');
    //orders订单查询
    Route::resource('/orders', 'OrdersController')->middleware('auth:api');
    //prods商品分类查询
    Route::resource('/prods', 'ProdsController')->middleware('auth:api');

    //seeds种子商家查询
    Route::resource('/seeds', 'SeedsController')->middleware('auth:api');

//    //第三方登录(微信)
//    Route::post('socials/{social_type}/authorizations','AuthorizationsController@socialStore');
//    Route::post('authorizations','AuthorizationsController@store');
//    // 小程序登录
//    Route::post('weapp/authorizations', 'AuthorizationsController@weappStore');
//    // 小程序注册
//    Route::post('weapp/users', 'UsersController@weappStore');
//    // 刷新token
//    Route::put('authorizations/current', 'AuthorizationsController@update');
//    // 删除token
//    Route::delete('authorizations/current', 'AuthorizationsController@destroy');

});

//dingo部分
$api = app('Dingo\Api\Routing\Router');

$api->version('v2', [
    'namespace' => 'App\Http\Controllers\Api'
], function ($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function ($api) {
        $api->post('v2/weappLogin', 'AuthorizationsController@weappLogin');
        $api->post('v2/weappRegister', 'AuthorizationsController@weappRegister');
        $api->post('v2/weappShopRegister', 'AuthorizationsController@weappShopRegister');
        $api->post('v2/logout', 'AuthorizationsController@destroy');
        $api->post('v2/token/refresh', 'AuthorizationsController@update');

        $api->post('v2/getwxuserinfo', 'WxxcxController@getWxUserInfo');

        $api->get('v2/shop', 'ShopsController@weshow')->middleware('auth:api');
        $api->post('v2/shop', 'ShopsController@weupdate')->middleware('auth:api');

        $api->post('v2/user', 'UsersController@weupdate')->middleware('auth:api');
    });
});
