<?php

namespace App\Http\Controllers\API\Auth;

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

      $requestData = request()->all();
      $validated = $this->validator($requestData);

      if($validated->fails()) {
         return response()->json(['errors' => $validated->errors()], 422);
      }

      $requestData["password"] = Hash::make($requestData["password"]);
      return User::create($requestData);
   }
}
