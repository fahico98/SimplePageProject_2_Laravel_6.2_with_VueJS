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

      $talks = Talk::where("sender_id", Auth::user()->id)
         ->orWhere("recipient_id", Auth::user()->id)
         ->get();

      $sortedTalks = $talks->sortBy("latest_message_created_at")->toArray();

      return response()->json(array_slice($sortedTalks, 20 * ($page - 1), 20));
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
    * Remove the specified resource from storage.
    *
    * @param Request $request
    * @return \Illuminate\Http\Response
    */
   public function destroy(Request $request){
      return response()->json(
         Message::where("id", $request->message_id)
            ->delete()
      );
   }
}
