<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller{

   /**
    * Get an User instance with its role data by username.
    *
    * @param string $username
    * @return \Illuminate\Http\JsonResponse
    */
   public function publicUserData($username){
      $user = User::where("username", $username)->first();
      return $user ? response()->json($user) : response()->json(false);
   }

   /**
    * Save an User biography.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function storeBio(){
      $user = Auth::user();
      $user->fill(["biography" => request()->bio]);
      return response()->json($user->save());
   }
}
