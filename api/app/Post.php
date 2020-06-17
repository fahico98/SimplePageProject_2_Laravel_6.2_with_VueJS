<?php

namespace App;

use App\User;
use App\Post;
use Illuminate\Database\Eloquent\Model;

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
      "id",
      "deleted_at",
      "created_at",
      "updated_at"
   ];

   public function scopePostsByUser($query, $username){
      $user = User::select("id")->where("username", $username)->get();
      return empty($user) ? false : Post::where("user_id", $user[0]->id)->orderBy("created_at", "desc");
   }

   public function scopeAllPosts($query){
      return Post::all()->orderBy("created_at", "desc");
   }
}
