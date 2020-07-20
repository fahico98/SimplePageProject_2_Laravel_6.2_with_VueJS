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

Route::group(['prefix' => 'auth', "namespace" => "API\Auth"], function(){
   Route::post('login', 'AuthController@login');
   Route::get('logout', 'AuthController@logout');
   Route::get('me', 'AuthController@me');
   Route::post('refresh', 'AuthController@refresh');
   Route::post("register", "RegisterController@create");
   Route::get("username_exists/{username?}", "RegisterController@usernameExists");
   Route::get("email_exists/{email?}", "RegisterController@emailExists");
});

Route::group(["namespace" => "API"], function(){

   Route::get("server_messages", "ServerMessageController@index");
   Route::get("testimonials", "ServerMessageController@testimonials");

   Route::group(["prefix" => "posts"], function(){
      Route::post("index/{username?}", "PostController@index");
      Route::post("check_like/{post_id}/{user_id}", "PostController@checkLike");
      Route::post("check_dislike/{post_id}/{user_id}", "PostController@checkDislike");
      Route::post("like/{post_id}/{user_id}", "PostController@like");
      Route::post("dislike/{post_id}/{user_id}", "PostController@dislike");
   });
});
