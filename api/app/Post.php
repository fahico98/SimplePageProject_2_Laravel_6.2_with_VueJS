<?php

namespace App;

use App\User;
use App\Post;
use App\PostImage;
use Illuminate\Database\Eloquent\Model;

class Post extends Model{

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      "id",
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
      "deleted_at",
      "created_at",
      "updated_at"
   ];

   public function scopePostsByUser($query, $page, $username){
      $user = User::select("id")->where("username", $username)->first();
      return empty($user)
         ? false
         : Post::where("user_id", $user->id)
            ->with("user", "images")
            ->orderBy("created_at", "desc")
            ->offset(5 * ($page - 1))
            ->limit(5);
   }

   public function scopeAllPosts($query, $page){
      return Post::with("user")
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
