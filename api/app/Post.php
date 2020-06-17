<?php

namespace App;

use App\User;
use App\Post;
use Illuminate\Database\Eloquent\Model;

class Post extends Model{

   public function scopePostsByUser($query, $username){
      $user = User::select("id")->where("username", $username)->get();
      return Post::where("user_id", $user->id)->orderBy("created_at", "desc");
   }

   public function scopeAllPosts($query){
      return Post::all()->orderBy("created_at", "desc");
   }
}
