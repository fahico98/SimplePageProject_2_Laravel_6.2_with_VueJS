<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerMessage extends Model{

   public function scopeRandomTestimonials($query){
      return ServerMessage::inRandomOrder()->take(3)->with("user.profile_picture");
   }

   public function user(){
      return $this->belongsTo(User::class);
   }
}
