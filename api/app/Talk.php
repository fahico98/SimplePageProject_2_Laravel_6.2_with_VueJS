<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talk extends Model{

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      "sender_id",
      "recipient_id",
      "messages_number"
   ];

   public function messages(){
      return $this->hasMany(Message::class);
   }

   public function recipient(){
      return $this->belongsTo(User::class, "recipient_id");
   }

   public function sender(){
      return $this->belongsTo(User::class, "sender_id");
   }
}
