<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller{

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index($page, $username = null){

      return $username
         ? response()->json(Post::postsByUser($page, $username)->get())
         : response()->json(Post::allPosts($page)->get());

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
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request){
      $post = new Post;
      $post->title = $request->title;
      $post->content = $request->content;
      $post->post_permission_id = $request->privacy;
      $post->user_id = Auth::user()->id;
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
      return response()->json(
         DB::table("user_like_post")
            ->where("user_id", $user_id)
            ->where("post_id", $post_id)
            ->exists()
      );
   }

   /**
    * Check if user doesn't like the post.
    *
    * @param int $post_id
    * @param int $user_id
    * @return \Illuminate\Http\Response
    */
   public function checkDislike($post_id, $user_id){
      return response()->json(
         DB::table("user_dislike_post")
            ->where("user_id", $user_id)
            ->where("post_id", $post_id)
            ->exists()
      );
   }

   /**
    * Insert a new record in user_like_post table.
    *
    * @param int $post_id
    * @param boolean $dislike
    * @return \Illuminate\Http\Response
    */
   public function like($post_id, $dislike){
      if($dislike){
         DB::table("user_dislike_post")->where([
               "user_id" => Auth::user()->id,
               "post_id" => $post_id
            ])
            ->delete();
      }
      return response()->json([
         "data" => DB::table("user_like_post")->insert([
            "user_id" => Auth::user()->id,
            "post_id" => $post_id
         ])
      ]);
   }

   /**
    * Insert a new record in user_dislike_post table.
    *
    * @param int $post_id
    * @param boolean $like
    * @return \Illuminate\Http\Response
    */
   public function dislike($post_id, $like){
      if($like){
         DB::table("user_like_post")->where([
               "user_id" => Auth::user()->id,
               "post_id" => $post_id
            ])
            ->delete();
      }
      return response()->json([
         "data" => DB::table("user_dislike_post")->insert([
            "user_id" => Auth::user()->id,
            "post_id" => $post_id
         ])
      ]);
   }

   /**
    * Remove a record from user_like_post table.
    *
    * @param int $post_id
    * @return \Illuminate\Http\Response
    */
   public function undoLike($post_id){
      return response()->json([
         "data" => DB::table("user_like_post")->where([
            "user_id" => Auth::user()->id,
            "post_id" => $post_id
         ])
         ->delete()
      ]);
   }

   /**
    * Remove a record from user_dislike_post table.
    *
    * @param int $post_id
    * @return \Illuminate\Http\Response
    */
   public function undoDislike($post_id){
      return response()->json([
         "data" => DB::table("user_dislike_post")->where([
            "user_id" => Auth::user()->id,
            "post_id" => $post_id
         ])
         ->delete()
      ]);
   }
}
