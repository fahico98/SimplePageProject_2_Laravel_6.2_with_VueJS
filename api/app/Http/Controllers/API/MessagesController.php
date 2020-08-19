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
      return response()->json(
         Talk::where("sender_id", Auth::user()->id)
            ->orWhere("recipient_id", Auth::user()->id)
            ->orderBy("updated_at", "desc")
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
      return response()->json(
         DB::table("talks")->insert([
            "sender_id" => Auth::user()->id,
            "recipient_id" => $request->recipient_id
         ])
      );
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
