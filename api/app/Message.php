<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model{

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      "user_id",
      "talk_id",
      "content",
      "deleted_by_sender",
      "deleted_by_recipient"
   ];

   public function talk(){
      return $this->belongsTo(Talk::class);
   }
}
