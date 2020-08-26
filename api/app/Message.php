<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use App\User;

class Message extends Model{

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      "user_id",
      "talk_id",
      "sender_id",
      "content",
      "readed"
   ];

   /**
    * The accessors to append to the model's array form.
    *
    * @var array
    */
   protected $appends = [
      "created_at_for_humans"
   ];

   /**
    * The relationships that should always be loaded.
    *
    * @var array
    */
   protected $with = [
      "sender"
   ];

   /**
    * Return true if the authenticated user dislikes the post.
    *
    * @return Boolean
    */
   public function getCreatedAtForHumansAttribute(){
      return Carbon::parse($this->attributes["created_at"])->diffForHumans();
   }

   public function talk(){
      return $this->belongsTo(Talk::class);
   }

   public function sender(){
      return $this->belongsTo(User::class)
         ->select(["id", 'username', 'name', 'lastname'])
         ->with("profile_picture");
   }
}
