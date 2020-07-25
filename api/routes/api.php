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

   Route::get("public_user_data/{username}", "UserController@publicUserData");
   Route::post("store_bio", "UserController@storeBio");

   Route::group(["prefix" => "posts"], function(){

      Route::get("index/{page}/{username?}", "PostController@index");

      Route::get("check_like/{post_id}/{user_id}", "PostController@checkLike");
      Route::get("check_dislike/{post_id}/{user_id}", "PostController@checkDislike");

      Route::post("like/{post_id}/{dislike}", "PostController@like");
      Route::post("dislike/{post_id}/{like}", "PostController@dislike");

      Route::post("undo_like/{post_id}", "PostController@undoLike");
      Route::post("undo_dislike/{post_id}", "PostController@undoDislike");
   });
});
