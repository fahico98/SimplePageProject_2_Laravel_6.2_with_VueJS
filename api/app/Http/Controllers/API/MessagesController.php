<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Message;
use App\Talk;

class MessagesController extends Controller{

   /**
    * Return all messages of a Talk instance using pagination.
    *
    * @param Integer $id
    * @param Integer $page
    * @return \Illuminate\Http\Response
    */
   public function index($id, $page){
      return response()->json(
         Message::where("talk_id", $id)
            ->orderBy("created_at", "desc")
            ->offset(20 * ($page - 1))
            ->limit(20)
            ->get()
      );
   }

   /**
    * Get every Talk instances in which authenticated user is involved.
    *
    * @param Integer $page
    * @return \Illuminate\Http\Response
    */
   public function talks($page){

      $sendedTalks = Talk::where("sender_id", Auth::user()->id)
         ->where("deleted_by_sender", 0);

      return response()->json(
         Talk::where("recipient_id", Auth::user()->id)
            ->where("messages_number", ">", 0)
            ->where("deleted_by_recipient", 0)
            ->union($sendedTalks)
            ->orderByDesc(Message::select("created_at")
               ->where("talk_id", "talk.id")
               ->orderBy("created_at", "desc")
               ->limit(1)
            )
            ->offset(20 * ($page - 1))
            ->limit(20)
            ->get()
      );
   }

   /**
    * Store a newly created Talk instance in database.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function newTalk(Request $request){
      $talk = new Talk;
      $talk->sender_id = Auth::user()->id;
      $talk->recipient_id = $request->recipient_id;
      $talk->save();
      $talk->refresh();
      $talk->load("sender", "recipient");
      return response()->json($talk);
   }

   /**
    * Store a new Message instance.
    *
    * @param Request $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request){

      Talk::find($request->talk_id)->increment("messages_number");

      $message = new Message;
      $message->content = $request->content;
      $message->talk_id = $request->talk_id;
      $message->sender_id = Auth::user()->id;

      $message->save();
      $message->refresh();

      return response()->json($message);
   }

   /**
    * The authorized user has seen unread messages.
    *
    * @param Talk $talk
    * @return \Illuminate\Http\Response
    */
   public function readMessages(Talk $talk){
      $talk->unread_messages->each(function($message, $key){
         $message->readed = 1;
         $message->save();
      });
      return response()->json(true);
   }

   /**
    * Remove a message by its id.
    *
    * @param Request $request
    * @return \Illuminate\Http\Response
    */
   public function destroyMessage(Request $request){

      $talk = Message::find($request->message_id)->talk;
      $talk->decrement("messages_number");

      return response()->json(Message::destroy($request->message_id));
   }

   /**
    * Remove a talk by its id.
    *
    * @param Request $request
    * @return \Illuminate\Http\Response
    */
   public function destroyTalk(Request $request){

      $talk = Talk::find($request->talk_id);

      if($talk->sender_id == Auth::user()->id){
         $talk->deleted_by_sender = 1;
      }else{
         $talk->deleted_by_recipient = 1;
      }

      $talk->save();
      $talk->refresh();

      if($talk->deleted_by_sender == 1 && $talk->deleted_by_recipient == 1){
         $talk->delete();
      }

      return response()->json(true);
   }
}
