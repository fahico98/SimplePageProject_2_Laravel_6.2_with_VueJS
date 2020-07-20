<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

   /**
    * Return a random testimonial server message.
    *
    * @return \Illuminate\Http\Response
    */
   public function testimonials(){
      return response()->json(ServerMessage::randomTestimonials()->get());
   }
}
