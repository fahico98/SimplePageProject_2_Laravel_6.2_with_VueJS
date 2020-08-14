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
   Route::post('refresh', 'AuthController@refresh');
   Route::get('logout', 'AuthController@logout');
   Route::get('me', 'AuthController@me');

   Route::post("register", "RegisterController@create");

});

Route::group(["namespace" => "API"], function(){

   Route::get("public_user_data/{username}", "UserController@publicUserData");
   Route::post("store_bio", "UserController@storeBio");
   Route::post("store_profile_picture", "UserController@storeProfilePicture");

   Route::get("username_exists/{username?}", "UserController@usernameExists");
   Route::get("email_exists/{email?}", "UserController@emailExists");

   Route::get("followers_followed/{user}/{users}/{page}", "UserController@followersFollowed");

   Route::post("follow/{username}", "UserController@follow");
   Route::delete("unfollow/{username}", "UserController@unfollow");

   Route::get("server_messages", "ServerMessageController@index");
   Route::get("testimonials", "ServerMessageController@testimonials");


   Route::group(["prefix" => "posts"], function(){

      Route::post("store", "PostController@store");
      Route::post("update", "PostController@update");
      Route::delete("delete/{post}", "PostController@destroy");
      Route::get("index/{page}/{username?}", "PostController@index");

      Route::post("like/{post_id}/{dislike}", "PostController@like");
      Route::post("dislike/{post_id}/{like}", "PostController@dislike");

      Route::post("undo_like/{post_id}", "PostController@undoLike");
      Route::post("undo_dislike/{post_id}", "PostController@undoDislike");

      Route::get("liked_posts/{user}/{page}", "PostController@likedPosts");
   });

   Route::group(["prefix" => "messages"], function(){

      Route::get("index", "MessagesController@index");
   });
});
