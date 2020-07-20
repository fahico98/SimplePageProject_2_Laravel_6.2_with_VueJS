<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller{

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index($username = null){

      return $username ?
         response()->json(Post::postsByUser($username)->get()) :
         response()->json(Post::allPosts());

      // dd($posts);

      // if($post->isPublished() || auth()->check()){
      //    if(request()->wantsJson()){
      //       return $post->load("owner", "category", "tags", "photos");
      //    }else{
      //       abort(404);
      //    }
      // }
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create(){
      //
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request){
      //
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id){
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id){
      //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id){
      //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id){
      //
   }

   /**
    * Check if user like the post.
    *
    * @param int $post_id
    * @param int $user_id
    * @return \Illuminate\Http\Response
    */
   public function checkLike($post_id, $user_id){
      return DB::table("user_like_post")
         ->where("user_id", $user_id)
         ->where("post_id", $post_id)
         ->exists();
   }

   /**
    * Check if user doesn't like the post.
    *
    * @param int $post_id
    * @param int $user_id
    * @return \Illuminate\Http\Response
    */
   public function checkDislike($post_id, $user_id){
      return DB::table("user_dislike_post")
         ->where("user_id", $user_id)
         ->where("post_id", $post_id)
         ->exists();
   }

   /**
    * Insert a new record in user_like_post table.
    *
    * @param int $post_id
    * @param int $user_id
    * @return \Illuminate\Http\Response
    */
   public function like($post_id, $user_id){
      return DB::table("user_like_post")->insert([
         "user_id" => $user->id,
         "post_id" => $post->id
      ]);
   }

   /**
    * Check if user doesn't like the post.
    *
    * @param int $post_id
    * @param int $user_id
    * @return \Illuminate\Http\Response
    */
   public function dislike($post_id, $user_id){
      return DB::table("user_dislike_post")->insert([
         "user_id" => $user->id,
         "post_id" => $post->id
      ]);
   }
}
