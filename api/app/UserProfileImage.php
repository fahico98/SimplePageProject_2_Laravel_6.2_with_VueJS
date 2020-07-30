<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserProfileImage extends Model{

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      "user_id",
      "url",
      "size"
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = ["id"];

   public function user(){
      return $this->belongsTo(User::class);
   }
}
