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

   // /**
   //  * Return all users followed by the authenticated user using the like statement.
   //  *
   //  * @param String $username
   //  * @return \Illuminate\Http\JsonResponse
   //  */
   // public function searchFollowed($username){

   //    $user = Auth::user();

   //    $user->load([
   //       "followed" => function($query) use ($username){
   //          $query->where("username", "like", "%$username%");
   //       }
   //    ]);

   //    return response()->json($user->followed);
   // }

   /**
    * Get the followers or followed users of an User instance returning 20 user per page.
    *
    * @param User $user
    * @param String $users
    * @param int $page
    * @return \Illuminate\Http\JsonResponse
    */
   public function followersFollowed(User $user, $users, $page){

      $user->load([
         $users => function($query){
            global $page;
            return $query->offset(20 * ($page - 1))->limit(20);
         }
      ]);

      $toHide = [
         "id",
         "country",
         "city",
         "phone_number",
         "email",
         "biography",
         "pivot"
      ];

      return $users == "followers"
         ? response()->json($user->followers->makeHidden($toHide))
         : response()->json($user->followed->makeHidden($toHide));
   }

   /**
    * Get all the follower or followed users of the authenticated user.
    *
    * @param String $users
    * @return \Illuminate\Http\JsonResponse
    */
   public function allFollowersFollowed($users){

      $toHide = [
         "country",
         "city",
         "phone_number",
         "email",
         "biography",
         "pivot"
      ];

      $user = Auth::user();

      return $users == "followers"
         ? response()->json($user->followers->makeHidden($toHide))
         : response()->json($user->followed->makeHidden($toHide));
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
