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
    Route::resource('/messages', 'MessagesController')->middleware('auth:api');
    //users用户查询
    Route::resource('/users', 'UsersController')->middleware('auth:api');
    //shops店铺查询
    Route::resource('/shops', 'ShopsController');
    Route::post('/shop/distance', 'ShopsController@distance');
    //shop店铺新增
    Route::resource('/shop', 'ShopsController')->middleware('auth:api');
    Route::post('/shop/avatar', 'ShopsController@changeAvatar')->middleware('auth:api');
    //dynamics动态查询
    Route::resource('/dynamics', 'DynamicsController');
    Route::post('/dynamic/distance', 'DynamicsController@distance');
    //dynamics新增动态
    Route::get('/dynamics-user', 'DynamicsController@user')->middleware('auth:api');
    Route::get('/dynamics-lists', 'DynamicsController@lists')->middleware('auth:api');
    Route::post('/news/images', 'DynamicsController@images')->middleware('auth:api');
    Route::post('/news/image', 'DynamicsController@image')->middleware('auth:api');

    Route::resource('/answers', 'AnswersController');
    //albums相册查询
    Route::resource('/albums', 'AlbumsController');
    //sorts分类查询
    Route::resource('/sorts', 'SortsController');
    Route::get('/sort/all', 'SortsController@sorts');
    Route::get('/sort/we-index', 'SortsController@weIndex');
    //orders订单查询
    Route::resource('/orders', 'OrdersController')->middleware('auth:api');
    Route::get('/orders-lists', 'OrdersController@lists')->middleware('auth:api');
    Route::post('/orders-list-size', 'OrdersController@listSize')->middleware('auth:api');
    Route::post('/orders-list-query', 'OrdersController@queryList')->middleware('auth:api');
    Route::get('/orders-query-phone', 'OrdersController@queryPhone')->middleware('auth:api');
    Route::get('/orders-query-address', 'OrdersController@queryAddress')->middleware('auth:api');
    Route::post('/orders-list-result', 'OrdersController@queryResult')->middleware('auth:api');
    Route::get('/buyerList', 'OrdersController@buyerList')->middleware('auth:api');
    Route::post('/orders/pastList', 'OrdersController@pastList')->middleware('auth:api');
    Route::post('/orders/weBuyerList', 'OrdersController@weBuyerList')->middleware('auth:api');
    Route::post('/orders/buyerCreate', 'OrdersController@buyerCreate')->middleware('auth:api');
    Route::post('/orders/sellerCreate', 'OrdersController@sellerCreate')->middleware('auth:api');
    Route::post('/orders/weStore', 'OrdersController@weStore')->middleware('auth:api');
    Route::post('/orders/weOrderUpdate', 'OrdersController@weOrderUpdate')->middleware('auth:api');
    Route::post('/orders/buyerConfirm', 'OrdersController@buyerConfirm')->middleware('auth:api');
    Route::post('/orders/sellerTransport', 'OrdersController@sellerTransport')->middleware('auth:api');
    Route::post('/orders/updateState', 'OrdersController@updateState')->middleware('auth:api');
    Route::post('/orders/updatePayment', 'OrdersController@updatePayment')->middleware('auth:api');
    Route::post('/orders/updateOrder', 'OrdersController@updateOrder')->middleware('auth:api');
    Route::post('/orders/updateLocation', 'OrdersController@updateLocation')->middleware('auth:api');
    Route::post('/orders/weDestroy', 'OrdersController@weDestroy')->middleware('auth:api');

    Route::get('/order/listSeller', 'OrdersController@listSeller')->middleware('auth:api');
    Route::get('/order/listState', 'OrdersController@listState')->middleware('auth:api');
    Route::get('/order/listPayment', 'OrdersController@listPayment')->middleware('auth:api');

    //prods商品分类查询
    Route::resource('/prods', 'ProdsController')->middleware('auth:api');
    Route::get('/prod/prodSeller/{id}', 'ProdsController@prodSeller')->middleware('auth:api');
    Route::post('/prod/uploadImage', 'ProdsController@uploadImage')->middleware('auth:api');
    Route::post('/prod/createProduct', 'ProdsController@createProduct')->middleware('auth:api');
    //tags商品标签查询
    Route::resource('/tags', 'TagsController')->middleware('auth:api');
    Route::post('/tag/search', 'TagsController@search')->middleware('auth:api');
    //seeds种子商家查询
    Route::resource('/seeds', 'SeedsController')->middleware('auth:api');

    //统计
    Route::get('/count','CountController@count')->middleware('auth:api');
    Route::get('/countOrder','CountController@countOrder')->middleware('auth:api');
    Route::get('/moneyOrder/{id}','CountController@moneyOrder')->middleware('auth:api');
    Route::get('/weCharts/{id}','CountController@weCharts')->middleware('auth:api');

    Route::get('weapp/code','WeChatController@index');

    //苗场收藏
    Route::resource('/favorite', 'Api\FavoritesController')->middleware('auth:api');

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
        $api->post('v2/getQrcode', 'WxxcxController@getQrcode')->middleware('auth:api');
        $api->post('v2/ManualQrcode', 'WxxcxController@ManualQrcode')->middleware('auth:api');

        $api->get('v2/shop', 'ShopsController@weShow')->middleware('auth:api');
        $api->get('v2/shopList', 'ShopsController@shopList')->middleware('auth:api');
        $api->post('v2/shop', 'ShopsController@weUpdate')->middleware('auth:api');
        $api->post('v2/weShopAvatar', 'ShopsController@weShopAvatar')->middleware('auth:api');

        $api->post('v2/user', 'UsersController@weUpdate')->middleware('auth:api');
        $api->post('v2/userPasswordUpdate', 'UsersController@userPasswordUpdate')->middleware('auth:api');
        $api->post('v2/userPasswordUpdateAdmin', 'UsersController@userPasswordUpdateAdmin')->middleware('auth:api');


        $api->post('v2/dynamic/index', 'DynamicsController@weIndex');
        $api->post('v2/dynamic/upload', 'DynamicsController@uploadImage')->middleware('auth:api');
        $api->post('v2/dynamic/weUploadImages', 'DynamicsController@weUploadImages')->middleware('auth:api');
        $api->post('v2/dynamic/create', 'DynamicsController@weCreate')->middleware('auth:api');
        $api->post('v2/dynamic/upfile', 'DynamicsController@upFile')->middleware('auth:api');
        $api->post('v2/dynamic/adminCreate', 'DynamicsController@adminCreate')->middleware('auth:api');
        $api->post('v2/dynamic/followDynamic', 'DynamicFollowController@follow')->middleware('auth:api');
        //模板消息
        $api->post('v2/send', 'TemplateController@send')->middleware('auth:api');

        //种好地
        $api->get('v2/planting', 'PlantingController@index');
        //蓝睛
        $api->get('v2/blueEye', 'blueEyeController@index');
    });
});
