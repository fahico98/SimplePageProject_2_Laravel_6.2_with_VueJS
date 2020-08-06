<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PostImage;
use App\Post;

use App\Dislike;
use App\Like;

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
      $post->save();
      $post->refresh();

      if($request->hasFile("images")){
         foreach($request->file('images') as $image){
            $postImage = new PostImage;
            $postImage->post_id = $post->id;
            $postImage->url = Storage::putFile("public/posts", $image);
            $postImage->size = Storage::size($postImage->url);
            $postImage->save();
         }
      }

      return response()->json($post->with(["user.profile_picture", "images", "postPermission"]));
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
    * Insert a new record in user_like_post table.
    *
    * @param int $post_id
    * @param boolean $dislike
    * @return \Illuminate\Http\Response
    */
   public function like($post_id, $dislike){
      if($dislike == "true"){
         Post::find($post_id)->decrement("dislikes");
         Dislike::where([
            "user_id" => Auth::user()->id,
            "post_id" => $post_id
         ])
         ->delete();
      }
      Post::find($post_id)->increment("likes");
      return response()->json([
         "data" => Like::insert([
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
      if($like == "true"){
         Post::find($post_id)->decrement("likes");
         Like::where([
            "user_id" => Auth::user()->id,
            "post_id" => $post_id
         ])
         ->delete();
      }
      Post::find($post_id)->increment("dislikes");
      return response()->json([
         "data" => Dislike::insert([
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
      Post::find($post_id)->decrement("likes");
      return response()->json([
         "data" => Like::where([
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
      Post::find($post_id)->decrement("dislikes");
      return response()->json([
         "data" => Dislike::where([
            "user_id" => Auth::user()->id,
            "post_id" => $post_id
         ])
         ->delete()
      ]);
   }
}
