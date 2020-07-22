<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller{

   /**
    * Create a new AuthController instance.
    *
    * @return void
    */
   public function __construct(){
      $this->middleware('auth:api', ['except' => ['login', 'publicUserData']]);
   }

   /**
    * Get a JWT via given credentials.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function login(){

      $credentials = request(['username', 'password']);

      // attepmt() method: Attempt to authenticate a user via some credentials.
      // This methods are available on the Auth guard instance.

      if(!$token = auth()->attempt($credentials)){
         return response()->json(['error' => 'Unauthorized'], 401);
      }
      return $this->respondWithToken($token);
   }

   /**
    * Get the authenticated User.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function me(){
      return response()->json(Auth::user());
   }

   /**
    * Get an User instance by username.
    *
    * @param App\User $user
    * @return \Illuminate\Http\JsonResponse
    */
   public function publicUserData(User $user){
      return response()->json([
         "username" => $user->username,
         "name" => $user->name,
         "lastname" => $user->lastname,
         "occupation" => $user->occupation,
         "biography" => $user->biography,
         "profile_photo" => $user->profile_photo
      ]);
   }

   /**
    * Log the user out (Invalidate the token).
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function logout(){
      auth()->logout();
      return response()->json(['message' => 'Successfully logged out']);
   }

   /**
    * Refresh a token.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function refresh(){
      return $this->respondWithToken(auth()->refresh());
   }

   /**
    * Get the token array structure.
    *
    * @param  string $token
    * @return \Illuminate\Http\JsonResponse
    */
   protected function respondWithToken($token){
      return response()->json([
         'access_token' => $token,
         'token_type' => 'bearer',
         'expires_in' => auth()->factory()->getTTL() * 60
      ]);
   }
}
