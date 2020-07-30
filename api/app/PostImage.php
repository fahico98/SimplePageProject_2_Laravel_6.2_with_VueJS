<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class PostImage extends Model{

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      "post_id",
      "url",
      "size"
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = ["id"];

   public function post(){
      return $this->belongsTo(Post::class);
   }
}
