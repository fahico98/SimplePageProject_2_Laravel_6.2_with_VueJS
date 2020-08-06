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
    * Return true if the authenticated user likes the post.
    *
    * @return bool
    */
   public function getILikeAttribute(){
      return Like::where("post_id", $this->attributes["id"])
         ->where("user_id", Auth::user()->id)
         ->exists();
   }

   /**
    * Return true if the authenticated user dislikes the post.
    *
    * @return bool
    */
   public function getIDislikeAttribute(){
      return Dislike::where("post_id", $this->attributes["id"])
         ->where("user_id", Auth::user()->id)
         ->exists();
   }

   public function scopePostsByUser($query, $page, $username){
      $user = User::select("id")->where("username", $username)->first();
      return !$user
         ? false
         : Post::with(["user.profile_picture", "images", "postPermission"])
            ->where("user_id", $user->id)
            ->orderBy("created_at", "desc")
            ->offset(5 * ($page - 1))
            ->limit(5);
   }

   public function scopeAllPosts($query, $page){
      return Post::with(["user.profile_picture", "images", "postPermission"])
         ->orderBy("created_at", "desc")
         ->offset(5 * ($page - 1))
         ->limit(5);
   }

   public function user(){
      return $this->belongsTo(User::class);
   }

   public function usersWhoLike(){
      return $this->belongsToMany(User::class, "user_like_post");
   }

   public function usersWhoDislike(){
      return $this->belongsToMany(User::class, "user_dislike_post");
   }

   public function postPermission(){
      return $this->belongsTo(PostPermission::class);
   }

   public function images(){
      return $this->hasMany(PostImage::class);
   }
}
