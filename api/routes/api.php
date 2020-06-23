<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth', "namespace" => "Auth"], function(){
   Route::post('login', 'AuthController@login');
   Route::post('logout', 'AuthController@logout');
   Route::post('refresh', 'AuthController@refresh');
   Route::post('me', 'AuthController@me');
   Route::post("register", "RegisterController@create");
});

Route::group(["prefix" => "posts"], function(){
   Route::post("index/{username?}", "PostsController@index");
   Route::post("check_like/{id}/{username}", "PostsController@checkLike");
   Route::post("check_dislike/{id}/{username}", "PostsController@checkDislike");
   Route::post("like/{id}/{username}", "PostsController@like");
   Route::post("dislike/{id}/{username}", "PostsController@dislike");
});
