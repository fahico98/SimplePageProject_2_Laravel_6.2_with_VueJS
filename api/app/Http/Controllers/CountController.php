<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class CountController extends Controller{

   /**
    * Display a list with the amount of database records.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(){

      $usersCount = User::count();
      $postsCount = Post::count();

      return response()->json(compact("userCount", "postsCount"));
   }

}
