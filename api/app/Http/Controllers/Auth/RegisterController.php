<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller{

   /*
   |--------------------------------------------------------------------------
   | Register Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles the registration of new users as well as their
   | validation and creation. By default this controller uses a trait to
   | provide this functionality without requiring any additional code.
   |
   */

   use RegistersUsers;

   /**
    * Where to redirect users after registration.
    *
    * @var string
    */
   protected $redirectTo = RouteServiceProvider::HOME;

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct(){
      $this->middleware('guest');
   }

   /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator(array $data){
      return Validator::make($data, [
         "name"            => ["required", "string", "max:25"],
         "lastname"        => ["required", "string", "max:25"],
         "contry"          => ["string", "max:25"],
         "city"            => ["string", "max:25"],
         "phone_number"    => ["numeric", "max:15"],
         "email"           => ["required", "string", "email", "max:35", "unique:users"],
         "username"        => ["required", "string", "max:15", "unique:users"],
         "password"        => ["required", "string", "min:8", "max:35", "confirmed"]
      ]);
   }

   /**
    * Create a new user instance after a valid registration.
    *
    * @return \App\User
    */
   protected function create(){

      // request()->validate([
      //    "name"            => ["required", "string", "max:25"],
      //    "lastname"        => ["required", "string", "max:25"],
      //    "contry"          => ["string", "nullable", "max:25"],
      //    "city"            => ["string", "nullable", "max:25"],
      //    "phone_number"    => ["numeric", "nullable", "max:15"],
      //    "email"           => ["required", "string", "email", "max:35", "unique:users"],
      //    "username"        => ["required", "string", "max:15", "unique:users"],
      //    "password"        => ["required", "string", "min:8", "max:35", "confirmed"]
      // ]);

      $requestData = request()->all();
      $requestData["password"] = Hash::make($requestData["password"]);
      User::create($requestData);

      $credentials = request(['username', 'password']);

      if(!$token = auth()->attempt($credentials)){
         return response()->json(['error' => 'Unauthorized'], 401);
      }
      return $this->respondWithToken($token);
   }

   /**
    * Get the token array structure.
    *
    * @param  string $token
    *
    * @return \Illuminate\Http\JsonResponse
    */
   protected function respondWithToken($token){
      return response()->json([
         'access_token' => $token,
         'token_type' => 'bearer',
         'expires_in' => auth()->factory()->getTTL() * 60
      ]);
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
