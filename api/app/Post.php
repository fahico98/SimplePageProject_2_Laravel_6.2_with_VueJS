<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class Post extends Model{

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      "user_id",
      "post_permission_id",
      "title",
      "content",
      "likes",
      "dislikes"
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [
      "user_id",
      "post_permission_id",
      "deleted_at",
      "created_at",
      "updated_at"
   ];

   /**
    * The accessors to append to the model's array form.
    *
    * @var array
    */
   protected $appends = [
      "i_like",
      "i_dislike"
   ];

   /**
    * The relationships that should always be loaded.
    *
    * @var array
    */
   protected $with = [
      "user",
      "post_permission",
      "images"
   ];

   /**
    * Return true if the authenticated user likes the post.
    *
    * @return Boolean
    */
   public function getILikeAttribute(){
      return Like::where("post_id", $this->attributes["id"])
         ->where("user_id", Auth::user()->id)
         ->exists();
   }

   /**
    * Return true if the authenticated user dislikes the post.
    *
    * @return Boolean
    */
   public function getIDislikeAttribute(){
      return Dislike::where("post_id", $this->attributes["id"])
         ->where("user_id", Auth::user()->id)
         ->exists();
   }

   public function scopePostsByUser($query, $page, $username){

      $user = User::select("id")->where("username", $username)->first();

      if($user){
         if($user->id == Auth::user()->id){
            return Post::where("user_id", $user->id)
               ->orderBy("created_at", "desc")
               ->offset(5 * ($page - 1))
               ->limit(5);;
         }else{
            $id = $user->following ? 3 : 1;
            $sign = $user->following ? "<>" : "=";
            return Post::where("user_id", $user->id)
               ->where("post_permission_id", $sign, $id)
               ->orderBy("created_at", "desc")
               ->offset(5 * ($page - 1))
               ->limit(5);
         }
      }

      return false;
   }

   public function scopeAllPosts($query, $page){

      $followedPosts = Post::whereIn('user_id', Auth::user()->followed->pluck('id'))
         ->where("user_id", "<>", Auth::user()->id)
         ->where("post_permission_id", "<>", 3);

      return Post::where("user_id", Auth::user()->id)
         ->where("post_permission_id", 1)
         ->union($followedPosts)
         ->orderBy("created_at", "desc")
         ->offset(5 * ($page - 1))
         ->limit(5);
   }

   public function user(){
      return $this->belongsTo(User::class)
         ->select(["id", 'username', 'name', 'lastname'])
         ->with("profile_picture");
   }

   public function usersWhoLike(){
      return $this->belongsToMany(User::class, "user_like_post");
   }

   public function usersWhoDislike(){
      return $this->belongsToMany(User::class, "user_dislike_post");
   }

   public function post_permission(){
      return $this->belongsTo(PostPermission::class);
   }

   public function images(){
      return $this->hasMany(PostImage::class);
   }
}
