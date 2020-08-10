<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\UserProfilePicture;
use App\User;

class UserController extends Controller{

   /**
    * Get an User instance with its role data by username.
    *
    * @param string $username
    * @return \Illuminate\Http\JsonResponse
    */
   public function publicUserData($username){

      $user = User::where("username", $username)->with("profile_picture")->first();
      return $user ? response()->json($user) : response()->json(false);

      // if($user){
      //    if(!$user->profile_picture){
      //       $user->setRelation("profile_picture", UserProfilePicture::find(1));
      //    }
      //    return response()->json($user);
      // }
      // return response()->json(false);
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

         if($user->profile_picture){
            UserProfilePicture::where("user_id", $user->id)->delete();
            Storage::delete($user->profile_picture->url);
         }

         $profilePicture = new UserProfilePicture;
         $profilePicture->user_id = $user->id;
         $profilePicture->url = Storage::putFile("public/avatars", $request->file('image'));
         $profilePicture->size = Storage::size($profilePicture->url);
         $profilePicture->save();
      }

      return response()->json($profilePicture);
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

   /**
    * Get the followers to an User instance.
    *
    * @param User $user
    * @param int $page
    * @return \Illuminate\Http\JsonResponse
    */
   public function followers(User $user, $page){

      $user->load([
         "followers.profile_picture" => function($query){
            global $page;
            return $query->offset(20 * ($page - 1))->limit(20);
         }
      ]);

      return response()->json(
         $user->followers
            ->makeHidden([
               "id",
               "country",
               "city",
               "phone_number",
               "email",
               "biography",
               "pivot"
            ])
      );
   }

   /**
    * Get the users followed by an User instance.
    *
    * @param User $user
    * @param int $page
    * @return \Illuminate\Http\JsonResponse
    */
   public function following(User $user, $page){

      $user->load([
         "following.profile_picture" => function($query){
            global $page;
            return $query->offset(20 * ($page - 1))->limit(20);
         }
      ]);

      return response()->json(
         $user->following
            ->makeHidden([
               "id",
               "country",
               "city",
               "phone_number",
               "email",
               "biography",
               "pivot"
            ])
      );
   }

   /**
    * Set an User instance to follow other.
    *
    * @param String $username
    * @return \Illuminate\Http\JsonResponse
    */
   public function follow($username){

      $user = User::select("id")
         ->where("username", $username)
         ->first();

      return response()->json(
         DB::table("follower_followed")->insert([
            "follower_id" => Auth::user()->id,
            "followed_id" => $user->id
         ])
      );
   }

   /**
    * Unset an User instance following other.
    *
    * @param String $username
    * @return \Illuminate\Http\JsonResponse
    */
    public function unfollow($username){

      $user = User::select("id")
         ->where("username", $username)
         ->first();

      return response()->json(
         DB::table("follower_followed")
            ->where("follower_id", Auth::user()->id)
            ->where("followed_id", $user->id)
            ->delete()
      );
   }
}
