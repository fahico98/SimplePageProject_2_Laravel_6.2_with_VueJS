<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

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

   /**
    * The accessors to append to the model's array form.
    *
    * @var array
    */
   protected $appends = [
      "unread_messages",
      "unread_messages_count"
   ];

   /**
    * The relationships that should always be loaded.
    *
    * @var array
    */
   protected $with = [
      "sender",
      "recipient"
   ];

   /**
    * Return the count of unread messages of this talk.
    *
    * @return Integer
    */
   public function getUnreadMessagesCountAttribute(){
      return Message::select("id")
         ->where("talk_id", $this->attributes["id"])
         ->where("sender_id", "<>", Auth::user()->id)
         ->where("readed", 0)
         ->count();
   }

   /**
    * Return the set of unread messages of this talk.
    *
    * @return Integer
    */
   public function getUnreadMessagesAttribute(){
      return Message::where("talk_id", $this->attributes["id"])
         ->where("sender_id", "<>", Auth::user()->id)
         ->where("readed", 0);
   }

   public function messages(){
      return $this->hasMany(Message::class);
   }

   public function sender(){
      return $this->belongsTo(User::class, "sender_id")
         ->select(["id", 'username', 'name', 'lastname'])
         ->with("profile_picture");
   }

   public function recipient(){
      return $this->belongsTo(User::class, "recipient_id")
         ->select(["id", 'username', 'name', 'lastname'])
         ->with("profile_picture");
   }
}
