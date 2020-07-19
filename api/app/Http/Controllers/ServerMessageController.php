<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServerMessage;

class ServerMessageController extends Controller{

   /**
    * Display a listing with all messages sended to server.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(){
      return response()->json(ServerMessage::all());
   }

}
