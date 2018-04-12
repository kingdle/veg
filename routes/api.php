<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register','Auth\RegisterController@register');
Route::post('/login','Auth\LoginController@login');
Route::post('/logout','Auth\LoginController@logout');
Route::post('/token/refresh','Auth\LoginController@refresh');

Route::post('/user/profile/update','UsersController@update')->middleware('auth:api');
Route::post('/user/password/update','PasswordController@update')->middleware('auth:api');
Route::post('/user/shop/update','ShopsController@update')->middleware('auth:api');

Route::group(['prefix'=>'/v1'],function(){
    Route::resource('/users','UsersController');
    Route::resource('/shops','ShopsController');
});
