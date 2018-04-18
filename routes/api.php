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

Route::post('/register','Auth\RegisterController@register');
Route::post('/login','Auth\LoginController@login');
Route::post('/logout','Auth\LoginController@logout');
Route::post('/token/refresh','Auth\LoginController@refresh');

Route::post('/user/profile/update','UsersController@update')->middleware('auth:api');
Route::post('/user/password/update','PasswordController@update')->middleware('auth:api');
Route::post('/user/shop/update','ShopsController@update')->middleware('auth:api');

Route::group(['prefix'=>'/v1','middleware' => 'cors'],function(){
    Route::resource('/users','UsersController');
    Route::resource('/shops','ShopsController');
    Route::resource('/dynamics','DynamicsController');
    Route::post('/shop/avatar','ShopsController@changeAvatar')->middleware('auth:api');

});
