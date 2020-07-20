<?php

namespace App;

use App\User;
use App\ServerMessage;
use Illuminate\Database\Eloquent\Model;

class ServerMessage extends Model{

   public function scopeRandomTestimonials($query){
      return ServerMessage::inRandomOrder()->take(3)->with("user");
   }

   public function user(){
      return $this->belongsTo(User::class);
   }
}
