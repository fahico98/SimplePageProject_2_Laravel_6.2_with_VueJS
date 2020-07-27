<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Storage;
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

   /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function imageValidator(array $data){
      return Validator::make($data, [
         "image" => ["required", "file", "image", "max:2000"]
      ]);
   }

   /**
    * Store an user profile picture.
    *
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response
    */
   public function storeProfilePicture(Request $request){
      $user = Auth::user();

      if($request->hasFile("image")){
         if($user->profile_picture !== "public/avatars/defaultUserPhoto.jpg"){
            Storage::delete($user->profile_picture);
         }
         $path = Storage::putFile("public/avatars", $request->file('image'));
         $user->update(["profile_picture" => $path]);
      }

      return response()->json($user->profile_picture);
   }

   /**
    * Checks if username exist.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function usernameExists($username = ""){
      return $username == ""
         ? response()->json(false)
         : response()->json(User::where("username", $username)->exists());
   }

   /**
    * Checks if email exist.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function emailExists($email = ""){
      return $email == ""
         ? response()->json(false)
         : response()->json(User::where("email", $email)->exists());
   }
}
